<?php

namespace App\Services;

use App\Models\Family;
use App\Enums\Todofuken;
use Illuminate\Http\Request;
use App\Models\AppraisalApply;
use App\Models\ToggleTestShipping;
use App\Models\BookbindingUserApply;
use App\Models\User;
use App\Repositories\HouseRepository;
use App\Repositories\PlanetRepository;
use App\Repositories\ZodiacRepository;
use App\Repositories\SabianPatternRepository;
use App\Repositories\ZodiacPatternRepository;
use Modules\Horoscope\Http\Actions\Predict\ModifyLocation;
use Modules\Horoscope\Http\Actions\GenerateHoroscopeChartAction;

class BookbindingUserApplyService
{
    public function __construct(
        protected GenerateHoroscopeChartAction $generateHoroscopeChartAction,
        protected ZodiacRepository $zodiacRepository,
        protected PlanetRepository $planetRepository,
        protected HouseRepository $houseRepository,
        protected ModifyLocation $modifyLocation,
        protected SabianPatternRepository $sabianPatternRepository,
        protected ZodiacPatternRepository $zodiacPatternRepository,
    ) {}

    //個人鑑定の登録処理
    public static function create(Request $request, AppraisalApply $appraisalApply, ?string $bulkBindingKey = null): BookbindingUserApply
    {
        $bookbindingUserApply = BookbindingUserApply::create([
            'appraisal_apply_id' => $appraisalApply->id,
            'bulk_binding_key'   => $bulkBindingKey,
            'post_number'        => $request->zip,
            'pref_num'           => $request->pref_num,
            'bookbinding_name1'   => $request->bookbinding_name1,
            'bookbinding_name2'   => $request->bookbinding_name2,
            'address'            => $request->address,
            'building'           => $request->building,
            'name'               => $request->building_name,
            'tel'                => $request->tel,
            'is_design'          => $request->is_design,
        ]);

        return $bookbindingUserApply;
    }

    //個人鑑定の登録処理
    public static function createForBookbinding(Request $request, AppraisalApply $appraisalApply, ?string $bulkBindingKey = null, ?int $bulkBindingCount = null): BookbindingUserApply
    {
        $bookbindingUserApply = BookbindingUserApply::create([
            'appraisal_apply_id' => $appraisalApply->id,
            'bulk_binding_key'   => $bulkBindingKey,
            'bulk_binding_count' => $bulkBindingCount,
            'post_number'        => $request->zip,
            'pref_num'           => $request->pref_num,
            'bookbinding_name1'   => $request->bookbinding_names1[$appraisalApply->id],
            'bookbinding_name2'   => $request->bookbinding_names2[$appraisalApply->id],
            'address'            => $request->address,
            'building'           => $request->building,
            'name'               => $request->building_name,
            'tel'                => $request->tel,
            'is_design'          => $request->pdf_types[$appraisalApply->id],
        ]);

        return $bookbindingUserApply;
    }

    public static function createForSolarBookbinding(Request $request, AppraisalApply $appraisalApply, ?string $bulkBindingKey = null, ?int $bulkBindingCount = null): BookbindingUserApply
    {
        $bookbindingUserApply = BookbindingUserApply::create([
            'appraisal_apply_id' => $appraisalApply->id,
            'bulk_binding_key'   => $bulkBindingKey,
            'bulk_binding_count' => $bulkBindingCount,
            'post_number'        => $request->zip,
            'pref_num'           => $request->pref_num,
            'bookbinding_name1'   => $request->bookbinding_names1[$appraisalApply->reference->id],
            'bookbinding_name2'   => $request->bookbinding_names2[$appraisalApply->reference->id],
            'address'            => $request->address,
            'building'           => $request->building,
            'name'               => $request->building_name,
            'tel'                => $request->tel,
            'is_design'          => $request->pdf_types[$appraisalApply->id],
        ]);

        return $bookbindingUserApply;
    }

    // 製本直送APIの送信処理
    public static function shippingBook(BookbindingUserApply $bookbindingUserApply, string $dirName, string $fileName): string
    {
        // addressに含まれている都道府県名を除去する（製本の送り状で都道府県名が重複する）
        $address = $bookbindingUserApply->address;
        $prefName = '';
        foreach (Todofuken::getData() as $item) {
            if ($item['pref_num'] === $bookbindingUserApply->pref_num) {
                $prefName = $item['name_jp'];
                break;
            }
        }

        $addr01 = str_replace($prefName, '', $address);
        $zip01 = substr($bookbindingUserApply->post_number, 0, 3);
        $zip02 = substr($bookbindingUserApply->post_number, 3, 4);
        $pref = $bookbindingUserApply->pref_num;
        $addr02 = $bookbindingUserApply->building;
        $name01 = $bookbindingUserApply->name;
        $name02 = ' ';
        $tel = $bookbindingUserApply->tel;
        $email = $bookbindingUserApply->appraisalClaim->user->email;

        $mode = ToggleTestShipping::first()->is_test_mode;
        $arrData = [
            "testmode" => $mode, // 0：本番 1：テスト
            "access_key"=>config('services.seichoku.access_key'),
            "secret_key"=>config('services.seichoku.secret_key'),
            "customer_id"=>config('services.seichoku.customer_id'),
            "order_id" => '',
            'haisou' => 0, // 0：普通 1：速達 2：急行便 3：特急便
            'cre_addr' => 0, // 0：送付先を登録しない 1：送付先を登録する
            'pre_regist_addr' => 0,
            'zip01' => $zip01, // 半角数字3桁
            'zip02' => $zip02, // 半角数字4桁
            'pref' => $pref, // 半角数字固定2桁
            'addr01' => $addr01, // 送付先住所1
            'addr02' => $addr02, // 送付先住所2
            'tel' => $tel,
            'name01' => $name01, // 受取人の姓 (こちらにフルネームを入れて対応)
            'name02' => $name02, // 受取人の名
            'email' => $email, // 受取人連絡用email
            "list" => [
                // 複数原稿の入稿が可能
                [
                    'path' => $dirName,
                    'filename'=> $fileName,
                    'page_size' => 1, // A4
                    //'niniwidth' => '',
                    //'niniheight' => '',
                    'bind_type' => 2, // 無線綴じ
                    'bind_direction' => 2, // 左綴じ
                    'paper_type' => 7, // しらおい
                    'text_color_type' => 1, // カラー
                    'asobi' => 0, // 遊び紙なし
                    'nuritasi' => 1, // 塗り足しあり
                    'zenmen' => 1, // 全面
                    'rot_num' => 1,
                    'cover_paper_data' => '100,2,1', // 表紙カラー＆ラミネート加工なし
                    'cover_thick' => 0, // 無線綴じ厚め
                    'easy' => 1, // PDFの1枚目が表紙
                    'nocover' => 0,
                    'uracover' => 1, // PDFの最後のページをウラ表紙に割り当てる
                    // 'hyousi_path' => 'httpdocs/ftp_test/cover/',
                    // 'hyousi_filename' => 'book.png',
                    'bookcover_flg' => 0, // 使用しない
                    // 'bookcover_paper_data' => 0,
                    // 'bookcover_path' => 'httpdocs/ftp_test/cover/',
                    // 'bookcover_filename' => 'book_cover.png',
                ],
            ],
        ];

        $url = "https://www.seichoku.com/user_data/setDraft.php"; //API Type4用の送信先URL

        \Log::info('curlコマンド実行', ['arrData' => $arrData]);
        $json_data = json_encode($arrData);
        $encode_json = base64_encode($json_data);
        $postdata = ["param" => $encode_json];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        $response = curl_exec($ch);
        curl_close($ch);

        // レスポンス確認用
        // ここでのレスポンスは“受付レスポンス”であり“入稿結果レスポンス”ではありません。
        $objResponseJson = json_decode(base64_decode($response, true));
        \Log::info('製本直送APIのレスポンス（shippingBook）', ['response' => $objResponseJson]);
        return $objResponseJson->result;
    }

    // 一括での製本直送APIの送信処理
    public static function bulkShippingBook(array $bulkShippingFileData, array $shippingData): string
    {
        // addressに含まれている都道府県名を除去する（製本apiの送り状で都道府県名が重複するため）
        $address = $shippingData['addr01'];
        $prefName = '';
        foreach (Todofuken::getData() as $item) {
            if ($item['pref_num'] === $shippingData['pref_num']) {
                $prefName = $item['name_jp'];
                break;
            }
        }
        $addr01 = str_replace($prefName, '', $address);

        $listParam = [];
        foreach ($bulkShippingFileData as $fileData) {
            $listParam[] = [
                'path' => $fileData['dirName'],
                'filename'=> $fileData['fileName'],
                'page_size' => 1, // A4
                'bind_type' => 2, // 無線綴じ
                'bind_direction' => 2, // 左綴じ
                'paper_type' => 7, // しらおい
                'text_color_type' => 1, // カラー
                'asobi' => 0, // 遊び紙なし
                'nuritasi' => 1, // 塗り足しあり
                'zenmen' => 1, // 全面
                'rot_num' => 1,
                'cover_paper_data' => '100,2,1', // 表紙カラー＆ラミネート加工なし
                'cover_thick' => 0, // 無線綴じ厚め
                'easy' => 1, // PDFの1枚目が表紙
                'nocover' => 0,
                'uracover' => 1, // PDFの最後のページをウラ表紙に割り当てる
                'bookcover_flg' => 0, // 使用しない
            ];
        }
        $mode = ToggleTestShipping::first()->is_test_mode;
        $arrData = [
            "testmode" => $mode, // 0：本番 1：テスト
            "access_key"=>config('services.seichoku.access_key'),
            "secret_key"=>config('services.seichoku.secret_key'),
            "customer_id"=>config('services.seichoku.customer_id'),
            "order_id" => '',
            'haisou' => 0, // 0：普通 1：速達 2：急行便 3：特急便
            'cre_addr' => 0, // 0：送付先を登録しない 1：送付先を登録する
            'pre_regist_addr' => 0,
            'zip01' => $shippingData['zip01'], // 半角数字3桁
            'zip02' => $shippingData['zip02'], // 半角数字4桁
            'pref' => $shippingData['pref_num'], // 半角数字固定2桁
            'addr01' => $addr01, // 送付先住所1
            'addr02' => $shippingData['addr02'], // 送付先住所2
            'tel' => $shippingData['tel'],
            'name01' => $shippingData['name'], // 受取人の姓（こちらにフルネームを入れて対応）
            'name02' => ' ', // 受取人の名
            'email' => $shippingData['email'], // 受取人連絡用email
            "list" => $listParam,
        ];

        $url = "https://www.seichoku.com/user_data/setDraft.php"; //API Type4用の送信先URL

        $json_data = json_encode($arrData);
        $encode_json = base64_encode($json_data);
        $postdata = ["param" => $encode_json];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        $response = curl_exec($ch);
        curl_close($ch);

        // レスポンス確認用
        // ここでのレスポンスは“受付レスポンス”であり“入稿結果レスポンス”ではありません。
        $objResponseJson = json_decode(base64_decode($response, true));
        \Log::info('製本直送APIのレスポンス（bulkShippingBook）', ['response' => $objResponseJson]);
        return $objResponseJson->result;
    }
}
