<?php

namespace App\Console\Commands;

use Illuminate\Http\File;
use Illuminate\Console\Command;
use App\Models\BookbindingUserApply;
use App\Services\AppraisalApplyService;
use App\Services\AppraisalClaimService;
use App\Services\BookbindingUserApplyService;

class BulkShippingBooks extends Command
{   
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:BulkShippingBooks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '製本の一括発送を行うコマンド';

    public function __construct(
        protected AppraisalClaimService $appraisalClaimService,
        protected AppraisalApplyService $appraisalApplyService,
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $bookbindingUserApplies = BookbindingUserApply::with(['appraisalClaim'])
            ->where('is_delivery', false)
            ->whereNotNull('bulk_binding_key')
            ->whereNotNull('bulk_binding_count')
            ->whereNotNull('is_design')
            ->whereHas('appraisalClaim', static function ($query) {
                $query->where('is_paid', true)
                    ->whereNotNull('bookbinding_user_apply_id');
            })
            // id95を抜く
            ->where('id', '!=', 95)
            ->get();
            
        if ($bookbindingUserApplies->isEmpty()) {
            return;
        }

        // bulk_binding_keyでグループ化
        \Log::info('製本の一括発送を行います');
        $groupedBookbindingUserApplies = $bookbindingUserApplies->groupBy('bulk_binding_key');

        foreach($groupedBookbindingUserApplies as $bulkBindingKey => $bookbindingUserApplies) {
            $firstBookbindingUserApply = $bookbindingUserApplies->first();
            // 製本の数が揃っているか確認
            $bulkBindingCount = $firstBookbindingUserApply->bulk_binding_count;
            if ($bulkBindingCount !== $bookbindingUserApplies->count()) {
                continue;
            }

            $shippingData = [
                'addr01' => $firstBookbindingUserApply->address,
                'addr02' => $firstBookbindingUserApply->building,
                'zip01' => substr($firstBookbindingUserApply->post_number, 0, 3),
                'zip02' => substr($firstBookbindingUserApply->post_number, 3, 4),
                'pref_num' => $firstBookbindingUserApply->pref_num,
                'name' => $firstBookbindingUserApply->name,
                'tel' => $firstBookbindingUserApply->tel,
                'email' => $firstBookbindingUserApply->appraisalClaim->user->email,
            ];

            $bulkShippingFileData = [];

            foreach($bookbindingUserApplies as $bookbindingUserApply) {
                // 製本の作成
                $pdfData = $this->appraisalApplyService->makeBook($bookbindingUserApply);
                // ftpサーバーにアップロード
                $file = new File($pdfData['pdfFilePath']);
                $fileName = $pdfData['fileName'];
                $dirName = config('services.seichoku.ftp_dir');
                \Storage::disk('ftp')->putFileAs($dirName, $file, $fileName);
                
                // ファイル名を更新
                $bookbindingUserApply->update([
                    'file_name' => $fileName,
                ]);
        
                // bulkShippingFileDataにデータを追加
                $ftpDirName = config('services.seichoku.api_ftp_dir');
                $bulkShippingFileData[] = [
                    'fileName' => $fileName,
                    'dirName' => $ftpDirName,
                ];
            }

            $response = BookbindingUserApplyService::bulkShippingBook($bulkShippingFileData, $shippingData);

            if ($response === 'success') {
                // 一括発送済みに更新
                $bookbindingUserApplies->each(static function ($bookbindingUserApply) {
                    $bookbindingUserApply->update([
                        'is_delivery' => true,
                    ]);
                });

                \Log::info('バッチ処理による一括発送が完了しました', [
                    'bulk_binding_key' => $bulkBindingKey,
                ]);
            } else {
                \Log::error('バッチ処理による一括発送に失敗しました。', [
                    'response' => $response,
                    'bulk_binding_key' => $bulkBindingKey,
                ]);
            }
        }
        
    }
}
