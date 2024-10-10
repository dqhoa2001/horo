<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BookbindingUserApply;
use App\Services\AppraisalApplyService;
use App\Services\AppraisalClaimService;

class ShippingBook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ShippingBook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '製本発注を行うコマンド';

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
            ->whereNull('bulk_binding_key')
            ->whereNull('bulk_binding_count')
            ->whereNotNull('is_design')
            ->whereHas('appraisalClaim', static function ($query) {
                $query->where('is_paid', true)
                    ->whereNotNull('bookbinding_user_apply_id');
            })
            ->get();

        if ($bookbindingUserApplies->isEmpty()) {
            return;
        }

        foreach ($bookbindingUserApplies as $bookbindingUserApply) {
            // 発注処理
            $response = $this->appraisalClaimService->bookbindingDelivery($bookbindingUserApply);

            if ($response === 'success') {
                // 一括発送済みに更新
                $bookbindingUserApply->update([
                    'is_delivery' => true,
                ]);
                
                \Log::info('バッチ処理による発送が完了しました',[
                    'bookbindingUserApplyId' => $bookbindingUserApply->id,
                ]);
            } else {
                \Log::error('バッチ処理による発送に失敗しました。', [
                    'response' => $response,
                    'bookbindingUserApplyId' => $bookbindingUserApply->id,
                ]);
            }
        }

        \Log::info('バッチ処理による単発の製本発注処理が完了しました');

    }
}
