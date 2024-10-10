<?php

namespace Tests\Feature\Http\Controllers\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Enums\TargetType;
use App\Models\Bookbinding;
use App\Models\AppraisalApply;
use App\Models\AppraisalClaim;
use App\Library\GetGeocoding;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\AdminCoupon;
use App\Models\Family;
use Tests\Data\UserData;
use Tests\Data\AppraisalApplyData;
use Tests\Data\FamilyData;
use Tests\Data\AppraisalClaimData;
use Tests\Data\BookbindingUserApplyData;
use App\Models\RegisterCoupon;

class OfferAppraisalControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        \Artisan::call('migrate:fresh --seed');
    }

    // -------------ここからは、自身の鑑定のテスト----------------------------------
    public function testApply_自分製本希望クレジット(): void
    {
        // POST時に419エラーが発生するのでCSRFミドルウェアを無効にする
        $this->withoutMiddleware([VerifyCsrfToken::class]);

        //リクエストデータの作成。
        $requestData = array_merge(UserData::data(), AppraisalApplyData::data(), BookbindingUserApplyData::data(), AppraisalClaimData::dataForCredit());
        $requestData['is_bookbinding'] = true;
        $requestData['target_type'] = TargetType::USER->value;
        // リクエストデータを元に、リクエストを作成
        $response = $this->post('/user/offer_appraisals/apply', $requestData);
        // レスポンスのステータスコードが302（リダイレクト）であることを確認
        $response->assertStatus(302);

        // データベースに期待するデータが存在することを確認
        $geocodingData = GetGeocoding::GetGeocodingData($requestData['birthday_prefectures'] . $requestData['birthday_city']);

        // ユーザー情報を登録する
        $this->assertDatabaseHas('users', [
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'kana1' => $requestData['kana1'],
            'kana2' => $requestData['kana2'],
            'email' => $requestData['email'],
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);

        //このユーザーでログイン
        $user = User::where('email', $requestData['email'])->first();
        $this->actingAs($user, 'user');

        //appraisal_appliesにデータが存在することを確認し、そのデータを取得
        $this->assertDatabaseHas('appraisal_applies', [
            'reference_type' => User::class,
            'reference_id' => $user->id,
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);
        $appraisalApply = AppraisalApply::where('reference_type', User::class)->where('reference_id', $user->id)->first();

        //bookbinding_user_appliesにデータが存在することを確認
        $this->assertDatabaseHas('bookbinding_user_applies', [
            'appraisal_apply_id' => $appraisalApply->id,
            'post_number'        => $requestData['zip'],
            'address'            => $requestData['address'] . $requestData['building'],
            'name'               => $requestData['building_name'],
            'tel'                => $requestData['tel'],
        ]);

        //appraisal_claimsにデータが存在することを確認
        $this->assertDatabaseHas('appraisal_claims', [
            'user_id'           => $user->id,
            'appraisal_apply_id' => $appraisalApply->id,
            // 'payment_intent_id'  => 'pi_00000000000000',
            'price'              => $requestData['total_amount'],
            'coupon_code'        => $requestData['coupon_code'],
            'discount_price'     => $requestData['discount_price'],
            'purchase_date'      => today()->format('Y-m-d'),
            'payment_type'       => AppraisalClaim::CREDIT,
            'content_type'       => AppraisalClaim::PERSONAL_BOOKING,
            'is_paid'            => true,
            'paid_at'            => today()->format('Y-m-d'),
        ]);

        // リダイレクト先が正しいことを確認
        $targetType = TargetType::USER->value;
        $redirectUrl = "/user/offer_appraisals/complete/{$appraisalApply->id}?target_type={$targetType}";
        $response->assertRedirect($redirectUrl);
        $redirect = $this->get($redirectUrl);
        $redirect->assertViewIs('user.offer_appraisals.complete');

        $redirect->assertSee('個人鑑定結果はこちら');
        $redirect->assertSee("/user/appraisals/{$appraisalApply->id}");
    }

    public function testApply_自分製本希望銀行振込(): void
    {
        // POST時に419エラーが発生するのでCSRFミドルウェアを無効にする
        $this->withoutMiddleware([VerifyCsrfToken::class]);

        //リクエストデータの作成
        $requestData = array_merge(UserData::data(), AppraisalApplyData::data(), BookbindingUserApplyData::data(), AppraisalClaimData::dataForBank());
        $requestData['is_bookbinding'] = true;
        $requestData['target_type'] = TargetType::USER->value;

        // リクエストデータを元に、リクエストを作成
        $response = $this->post('/user/offer_appraisals/apply', $requestData);
        // レスポンスのステータスコードが302（リダイレクト）であることを確認
        $response->assertStatus(302);

        // データベースに期待するデータが存在することを確認
        $geocodingData = GetGeocoding::GetGeocodingData($requestData['birthday_prefectures'] . $requestData['birthday_city']);

        // ユーザー情報を登録する
        $this->assertDatabaseHas('users', [
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'kana1' => $requestData['kana1'],
            'kana2' => $requestData['kana2'],
            'email' => $requestData['email'],
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);

        //このユーザーでログイン
        $user = User::where('email', $requestData['email'])->first();
        $this->actingAs($user, 'user');

        //appraisal_appliesにデータが存在することを確認し、そのデータを取得
        $this->assertDatabaseHas('appraisal_applies', [
            'reference_type' => User::class,
            'reference_id' => $user->id,
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);
        $appraisalApply = AppraisalApply::where('reference_type', User::class)->where('reference_id', $user->id)->first();

        //bookbinding_user_appliesにデータが存在することを確認
        $this->assertDatabaseHas('bookbinding_user_applies', [
            'appraisal_apply_id' => $appraisalApply->id,
            'post_number'        => $requestData['zip'],
            'address'            => $requestData['address'] . $requestData['building'],
            'name'               => $requestData['building_name'],
            'tel'                => $requestData['tel'],
        ]);

        //appraisal_claimsにデータが存在することを確認
        $this->assertDatabaseHas('appraisal_claims', [
            'user_id'            => $user->id,
            'appraisal_apply_id' => $appraisalApply->id,
            'price'              => $requestData['total_amount'],
            'coupon_code'        => $requestData['coupon_code'],
            'discount_price'     => $requestData['discount_price'],
            'purchase_date'      => today()->format('Y-m-d'),
            'payment_type'       => AppraisalClaim::BANK,
            'content_type'       => AppraisalClaim::PERSONAL_BOOKING,
            'is_paid'            => false,
        ]);

        // リダイレクト先が正しいことを確認
        $targetType = TargetType::USER->value;
        $redirectUrl = "/user/offer_appraisals/complete/{$appraisalApply->id}?target_type={$targetType}";
        $response->assertRedirect($redirectUrl);
        $redirect = $this->get($redirectUrl);
        $redirect->assertViewIs('user.offer_appraisals.complete');
        $redirect->assertSee('会員様のメールアドレスへ振込先のご案内をお送りしておりますのでご確認ください。');
    }

    public function testApply_自分製本なしクレジット(): void
    {
        // POST時に419エラーが発生するのでCSRFミドルウェアを無効にする
        $this->withoutMiddleware([VerifyCsrfToken::class]);

        //リクエストデータの作成。
        $requestData = array_merge(UserData::data(), AppraisalApplyData::data(), AppraisalClaimData::dataForCredit());
        $requestData['is_bookbinding'] = false;
        $requestData['target_type'] = TargetType::USER->value;
        // リクエストデータを元に、リクエストを作成
        $response = $this->post('/user/offer_appraisals/apply', $requestData);
        // レスポンスのステータスコードが302（リダイレクト）であることを確認
        $response->assertStatus(302);

        // データベースに期待するデータが存在することを確認
        $geocodingData = GetGeocoding::GetGeocodingData($requestData['birthday_prefectures'] . $requestData['birthday_city']);

        // ユーザー情報を登録する
        $this->assertDatabaseHas('users', [
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'kana1' => $requestData['kana1'],
            'kana2' => $requestData['kana2'],
            'email' => $requestData['email'],
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);

        //このユーザーでログイン
        $user = User::where('email', $requestData['email'])->first();
        $this->actingAs($user, 'user');

        //appraisal_appliesにデータが存在することを確認し、そのデータを取得
        $this->assertDatabaseHas('appraisal_applies', [
            'reference_type' => User::class,
            'reference_id' => $user->id,
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);
        $appraisalApply = AppraisalApply::where('reference_type', User::class)->where('reference_id', $user->id)->first();

        //appraisal_claimsにデータが存在することを確認
        $this->assertDatabaseHas('appraisal_claims', [
            'user_id'           => $user->id,
            'appraisal_apply_id' => $appraisalApply->id,
            // 'payment_intent_id'  => 'pi_00000000000000',
            'price'              => $requestData['total_amount'],
            'coupon_code'        => $requestData['coupon_code'],
            'discount_price'     => $requestData['discount_price'],
            'purchase_date'      => today()->format('Y-m-d'),
            'payment_type'       => AppraisalClaim::CREDIT,
            'content_type'       => AppraisalClaim::PERSONAL,
            'is_paid'            => true,
            'paid_at'            => today()->format('Y-m-d'),
        ]);

        // リダイレクト先が正しいことを確認
        $targetType = TargetType::USER->value;
        $redirectUrl = "/user/offer_appraisals/complete/{$appraisalApply->id}?target_type={$targetType}";
        $response->assertRedirect($redirectUrl);
        $redirect = $this->get($redirectUrl);
        $redirect->assertViewIs('user.offer_appraisals.complete');

        $redirect->assertSee('個人鑑定結果はこちら');
        $redirect->assertSee("/user/appraisals/{$appraisalApply->id}");
    }

    public function testApply_自分製本なし銀行振込(): void
    {
        // POST時に419エラーが発生するのでCSRFミドルウェアを無効にする
        $this->withoutMiddleware([VerifyCsrfToken::class]);

        //リクエストデータの作成
        $requestData = array_merge(UserData::data(), AppraisalApplyData::data(), AppraisalClaimData::dataForBank());
        $requestData['is_bookbinding'] = false;
        $requestData['target_type'] = TargetType::USER->value;

        // リクエストデータを元に、リクエストを作成
        $response = $this->post('/user/offer_appraisals/apply', $requestData);
        // レスポンスのステータスコードが302（リダイレクト）であることを確認
        $response->assertStatus(302);

        // データベースに期待するデータが存在することを確認
        $geocodingData = GetGeocoding::GetGeocodingData($requestData['birthday_prefectures'] . $requestData['birthday_city']);

        // ユーザー情報を登録する
        $this->assertDatabaseHas('users', [
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'kana1' => $requestData['kana1'],
            'kana2' => $requestData['kana2'],
            'email' => $requestData['email'],
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);

        //このユーザーでログイン
        $user = User::where('email', $requestData['email'])->first();
        $this->actingAs($user, 'user');

        //appraisal_appliesにデータが存在することを確認し、そのデータを取得
        $this->assertDatabaseHas('appraisal_applies', [
            'reference_type' => User::class,
            'reference_id' => $user->id,
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);
        $appraisalApply = AppraisalApply::where('reference_type', User::class)->where('reference_id', $user->id)->first();

        //appraisal_claimsにデータが存在することを確認
        $this->assertDatabaseHas('appraisal_claims', [
            'user_id'            => $user->id,
            'appraisal_apply_id' => $appraisalApply->id,
            'price'              => $requestData['total_amount'],
            'coupon_code'        => $requestData['coupon_code'],
            'discount_price'     => $requestData['discount_price'],
            'purchase_date'      => today()->format('Y-m-d'),
            'payment_type'       => AppraisalClaim::BANK,
            'content_type'       => AppraisalClaim::PERSONAL,
            'is_paid'            => false,
        ]);

        // リダイレクト先が正しいことを確認
        $targetType = TargetType::USER->value;
        $redirectUrl = "/user/offer_appraisals/complete/{$appraisalApply->id}?target_type={$targetType}";
        $response->assertRedirect($redirectUrl);
        $redirect = $this->get($redirectUrl);
        $redirect->assertViewIs('user.offer_appraisals.complete');
        $redirect->assertSee('会員様のメールアドレスへ振込先のご案内をお送りしておりますのでご確認ください。');
    }

    // -------------ここまで、自身の鑑定のテスト----------------------------------

    // -------------ここからは、家族の鑑定のテスト----------------------------------
    public function testApply_家族製本希望クレジット(): void
    {
        // POST時に419エラーが発生するのでCSRFミドルウェアを無効にする
        $this->withoutMiddleware([VerifyCsrfToken::class]);

        //リクエストデータの作成。
        $requestData = array_merge(UserData::data(), FamilyData::data(), AppraisalApplyData::data(), BookbindingUserApplyData::data(), AppraisalClaimData::dataForCredit());
        $requestData['is_bookbinding'] = true;
        $requestData['target_type'] = TargetType::FAMILY->value;
        // リクエストデータを元に、リクエストを作成
        $response = $this->post('/user/offer_appraisals/apply', $requestData);
        // レスポンスのステータスコードが302（リダイレクト）であることを確認
        $response->assertStatus(302);

        $geocodingData = GetGeocoding::GetGeocodingData($requestData['birthday_prefectures'] . $requestData['birthday_city']);

        // ユーザー情報を登録する
        $this->assertDatabaseHas('users', [
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'kana1' => $requestData['kana1'],
            'kana2' => $requestData['kana2'],
            'email' => $requestData['email'],
        ]);

        //このユーザーでログイン
        $user = User::where('email', $requestData['email'])->first();
        $this->actingAs($user, 'user');

        // 家族情報を登録する
        $this->assertDatabaseHas('families', [
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'relationship' => $requestData['relationship'],
            'user_id' => $user->id,
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);

        //この家族情報を取得
        $family = Family::where([
            'user_id' => $user->id,
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'relationship' => $requestData['relationship'],
        ])->first();

        //appraisal_appliesにデータが存在することを確認し、そのデータを取得
        $this->assertDatabaseHas('appraisal_applies', [
            'reference_type' => Family::class,
            'reference_id' => $family->id,
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);
        $appraisalApply = AppraisalApply::where('reference_type', Family::class)->where('reference_id', $family->id)->first();

        //bookbinding_user_appliesにデータが存在することを確認
        $this->assertDatabaseHas('bookbinding_user_applies', [
            'appraisal_apply_id' => $appraisalApply->id,
            'post_number'        => $requestData['zip'],
            'address'            => $requestData['address'] . $requestData['building'],
            'name'               => $requestData['building_name'],
            'tel'                => $requestData['tel'],
        ]);

        //appraisal_claimsにデータが存在することを確認
        $this->assertDatabaseHas('appraisal_claims', [
            'user_id'           => $user->id,
            'appraisal_apply_id' => $appraisalApply->id,
            // 'payment_intent_id'  => 'pi_00000000000000',
            'price'              => $requestData['total_amount'],
            'coupon_code'        => $requestData['coupon_code'],
            'discount_price'     => $requestData['discount_price'],
            'purchase_date'      => today()->format('Y-m-d'),
            'payment_type'       => AppraisalClaim::CREDIT,
            'content_type'       => AppraisalClaim::FAMILY_BOOKING,
            'is_paid'            => true,
            'paid_at'            => today()->format('Y-m-d'),
        ]);

        // リダイレクト先が正しいことを確認
        $targetType = TargetType::FAMILY->value;
        $redirectUrl = "/user/offer_appraisals/complete/{$appraisalApply->id}?target_type={$targetType}";
        $response->assertRedirect($redirectUrl);
        $redirect = $this->get($redirectUrl);
        $redirect->assertViewIs('user.offer_appraisals.complete');

        $redirect->assertSee('家族の個人鑑定結果はこちら');
        $redirect->assertSee("/user/family_appraisals/{$appraisalApply->id}");
    }

    public function testApply_家族製本希望銀行振込(): void
    {
        // POST時に419エラーが発生するのでCSRFミドルウェアを無効にする
        $this->withoutMiddleware([VerifyCsrfToken::class]);

        //リクエストデータの作成。
        $requestData = array_merge(UserData::data(), FamilyData::data(), AppraisalApplyData::data(), BookbindingUserApplyData::data(), AppraisalClaimData::dataForBank());
        $requestData['is_bookbinding'] = true;
        $requestData['target_type'] = TargetType::FAMILY->value;
        // リクエストデータを元に、リクエストを作成
        $response = $this->post('/user/offer_appraisals/apply', $requestData);
        // レスポンスのステータスコードが302（リダイレクト）であることを確認
        $response->assertStatus(302);

        $geocodingData = GetGeocoding::GetGeocodingData($requestData['birthday_prefectures'] . $requestData['birthday_city']);

        // ユーザー情報を登録する
        $this->assertDatabaseHas('users', [
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'kana1' => $requestData['kana1'],
            'kana2' => $requestData['kana2'],
            'email' => $requestData['email'],
        ]);

        //このユーザーでログイン
        $user = User::where('email', $requestData['email'])->first();
        $this->actingAs($user, 'user');

        // 家族情報を登録する
        $this->assertDatabaseHas('families', [
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'relationship' => $requestData['relationship'],
            'user_id' => $user->id,
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);

        //この家族情報を取得
        $family = Family::where([
            'user_id' => $user->id,
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'relationship' => $requestData['relationship'],
        ])->first();

        //appraisal_appliesにデータが存在することを確認し、そのデータを取得
        $this->assertDatabaseHas('appraisal_applies', [
            'reference_type' => Family::class,
            'reference_id' => $family->id,
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);
        $appraisalApply = AppraisalApply::where('reference_type', Family::class)->where('reference_id', $family->id)->first();

        //bookbinding_user_appliesにデータが存在することを確認
        $this->assertDatabaseHas('bookbinding_user_applies', [
            'appraisal_apply_id' => $appraisalApply->id,
            'post_number'        => $requestData['zip'],
            'address'            => $requestData['address'] . $requestData['building'],
            'name'               => $requestData['building_name'],
            'tel'                => $requestData['tel'],
        ]);

        //appraisal_claimsにデータが存在することを確認
        $this->assertDatabaseHas('appraisal_claims', [
            'user_id'           => $user->id,
            'appraisal_apply_id' => $appraisalApply->id,
            'price'              => $requestData['total_amount'],
            'coupon_code'        => $requestData['coupon_code'],
            'discount_price'     => $requestData['discount_price'],
            'purchase_date'      => today()->format('Y-m-d'),
            'payment_type'       => AppraisalClaim::BANK,
            'content_type'       => AppraisalClaim::FAMILY_BOOKING,
            'is_paid'            => false,
        ]);

        // リダイレクト先が正しいことを確認
        $targetType = TargetType::FAMILY->value;
        $redirectUrl = "/user/offer_appraisals/complete/{$appraisalApply->id}?target_type={$targetType}";
        $response->assertRedirect($redirectUrl);
        $redirect = $this->get($redirectUrl);
        $redirect->assertViewIs('user.offer_appraisals.complete');
        $redirect->assertSee('会員様のメールアドレスへ振込先のご案内をお送りしておりますのでご確認ください。');
    }

    public function testApply_家族製本なしクレジット(): void
    {
        // POST時に419エラーが発生するのでCSRFミドルウェアを無効にする
        $this->withoutMiddleware([VerifyCsrfToken::class]);

        //リクエストデータの作成。
        $requestData = array_merge(UserData::data(), FamilyData::data(), AppraisalApplyData::data(), AppraisalClaimData::dataForCredit());
        $requestData['is_bookbinding'] = false;
        $requestData['target_type'] = TargetType::FAMILY->value;
        // リクエストデータを元に、リクエストを作成
        $response = $this->post('/user/offer_appraisals/apply', $requestData);
        // レスポンスのステータスコードが302（リダイレクト）であることを確認
        $response->assertStatus(302);

        $geocodingData = GetGeocoding::GetGeocodingData($requestData['birthday_prefectures'] . $requestData['birthday_city']);

        // ユーザー情報を登録する
        $this->assertDatabaseHas('users', [
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'kana1' => $requestData['kana1'],
            'kana2' => $requestData['kana2'],
            'email' => $requestData['email'],
        ]);

        //このユーザーでログイン
        $user = User::where('email', $requestData['email'])->first();
        $this->actingAs($user, 'user');

        // 家族情報を登録する
        $this->assertDatabaseHas('families', [
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'relationship' => $requestData['relationship'],
            'user_id' => $user->id,
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);

        //この家族情報を取得
        $family = Family::where([
            'user_id' => $user->id,
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'relationship' => $requestData['relationship'],
        ])->first();

        //appraisal_appliesにデータが存在することを確認し、そのデータを取得
        $this->assertDatabaseHas('appraisal_applies', [
            'reference_type' => Family::class,
            'reference_id' => $family->id,
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);
        $appraisalApply = AppraisalApply::where('reference_type', Family::class)->where('reference_id', $family->id)->first();

        //appraisal_claimsにデータが存在することを確認
        $this->assertDatabaseHas('appraisal_claims', [
            'user_id'           => $user->id,
            'appraisal_apply_id' => $appraisalApply->id,
            // 'payment_intent_id'  => 'pi_00000000000000',
            'price'              => $requestData['total_amount'],
            'coupon_code'        => $requestData['coupon_code'],
            'discount_price'     => $requestData['discount_price'],
            'purchase_date'      => today()->format('Y-m-d'),
            'payment_type'       => AppraisalClaim::CREDIT,
            'content_type'       => AppraisalClaim::FAMILY,
            'is_paid'            => true,
            'paid_at'            => today()->format('Y-m-d'),
        ]);

        // リダイレクト先が正しいことを確認
        $targetType = TargetType::FAMILY->value;
        $redirectUrl = "/user/offer_appraisals/complete/{$appraisalApply->id}?target_type={$targetType}";
        $response->assertRedirect($redirectUrl);
        $redirect = $this->get($redirectUrl);
        $redirect->assertViewIs('user.offer_appraisals.complete');

        $redirect->assertSee('家族の個人鑑定結果はこちら');
        $redirect->assertSee("/user/family_appraisals/{$appraisalApply->id}");
    }

    public function testApply_家族製本なし銀行振込(): void
    {
        // POST時に419エラーが発生するのでCSRFミドルウェアを無効にする
        $this->withoutMiddleware([VerifyCsrfToken::class]);

        //リクエストデータの作成。
        $requestData = array_merge(UserData::data(), FamilyData::data(), AppraisalApplyData::data(), AppraisalClaimData::dataForBank());
        $requestData['is_bookbinding'] = false;
        $requestData['target_type'] = TargetType::FAMILY->value;
        // リクエストデータを元に、リクエストを作成
        $response = $this->post('/user/offer_appraisals/apply', $requestData);
        // レスポンスのステータスコードが302（リダイレクト）であることを確認
        $response->assertStatus(302);

        $geocodingData = GetGeocoding::GetGeocodingData($requestData['birthday_prefectures'] . $requestData['birthday_city']);

        // ユーザー情報を登録する
        $this->assertDatabaseHas('users', [
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'kana1' => $requestData['kana1'],
            'kana2' => $requestData['kana2'],
            'email' => $requestData['email'],
        ]);

        //このユーザーでログイン
        $user = User::where('email', $requestData['email'])->first();
        $this->actingAs($user, 'user');

        // 家族情報を登録する
        $this->assertDatabaseHas('families', [
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'relationship' => $requestData['relationship'],
            'user_id' => $user->id,
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);

        //この家族情報を取得
        $family = Family::where([
            'user_id' => $user->id,
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'relationship' => $requestData['relationship'],
        ])->first();

        //appraisal_appliesにデータが存在することを確認し、そのデータを取得
        $this->assertDatabaseHas('appraisal_applies', [
            'reference_type' => Family::class,
            'reference_id' => $family->id,
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);
        $appraisalApply = AppraisalApply::where('reference_type', Family::class)->where('reference_id', $family->id)->first();

        //appraisal_claimsにデータが存在することを確認
        $this->assertDatabaseHas('appraisal_claims', [
            'user_id'           => $user->id,
            'appraisal_apply_id' => $appraisalApply->id,
            'price'              => $requestData['total_amount'],
            'coupon_code'        => $requestData['coupon_code'],
            'discount_price'     => $requestData['discount_price'],
            'purchase_date'      => today()->format('Y-m-d'),
            'payment_type'       => AppraisalClaim::BANK,
            'content_type'       => AppraisalClaim::FAMILY,
            'is_paid'            => false,
        ]);

        // リダイレクト先が正しいことを確認
        $targetType = TargetType::FAMILY->value;
        $redirectUrl = "/user/offer_appraisals/complete/{$appraisalApply->id}?target_type={$targetType}";
        $response->assertRedirect($redirectUrl);
        $redirect = $this->get($redirectUrl);
        $redirect->assertViewIs('user.offer_appraisals.complete');
        $redirect->assertSee('会員様のメールアドレスへ振込先のご案内をお送りしておりますのでご確認ください。');
    }

    // -------------ここまで、家族の鑑定のテスト----------------------------------

    public function testApply_招待クーポン使用(): void
    {
        // POST時に419エラーが発生するのでCSRFミドルウェアを無効にする
        $this->withoutMiddleware([VerifyCsrfToken::class]);

        //リクエストデータの作成
        $requestData = array_merge(UserData::data(), AppraisalApplyData::data(), AppraisalClaimData::dataForBankAndUsingRegisterCouponCode());
        $requestData['is_bookbinding'] = false;
        $requestData['target_type'] = TargetType::USER->value;

        // リクエストデータを元に、リクエストを作成
        $response = $this->post('/user/offer_appraisals/apply', $requestData);
        // レスポンスのステータスコードが302（リダイレクト）であることを確認
        $response->assertStatus(302);

        // データベースに期待するデータが存在することを確認
        $geocodingData = GetGeocoding::GetGeocodingData($requestData['birthday_prefectures'] . $requestData['birthday_city']);

        // ユーザー情報を登録する
        $this->assertDatabaseHas('users', [
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'kana1' => $requestData['kana1'],
            'kana2' => $requestData['kana2'],
            'email' => $requestData['email'],
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);

        //このユーザーでログイン
        $user = User::where('email', $requestData['email'])->first();
        $this->actingAs($user, 'user');

        //appraisal_appliesにデータが存在することを確認し、そのデータを取得
        $this->assertDatabaseHas('appraisal_applies', [
            'reference_type' => User::class,
            'reference_id' => $user->id,
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);
        $appraisalApply = AppraisalApply::where('reference_type', User::class)->where('reference_id', $user->id)->first();

        //appraisal_claimsにデータが存在することを確認
        $this->assertDatabaseHas('appraisal_claims', [
            'user_id'            => $user->id,
            'appraisal_apply_id' => $appraisalApply->id,
            'price'              => $requestData['total_amount'],
            'coupon_code'        => $requestData['coupon_code'],
            'discount_price'     => $requestData['discount_price'],
            'purchase_date'      => today()->format('Y-m-d'),
            'payment_type'       => AppraisalClaim::BANK,
            'content_type'       => AppraisalClaim::PERSONAL,
            'is_paid'            => false,
        ]);

        // 招待クーポンを使用した場合、使用されたユーザーにバックポイントが付与されることを確認
        $this->assertDatabaseHas('users', [
            'id'        => User::find(1)->id,
            'point_sum' => User::find(1)->point_sum,
        ]);

        // リダイレクト先が正しいことを確認
        $targetType = TargetType::USER->value;
        $redirectUrl = "/user/offer_appraisals/complete/{$appraisalApply->id}?target_type={$targetType}";
        $response->assertRedirect($redirectUrl);
        $redirect = $this->get($redirectUrl);
        $redirect->assertViewIs('user.offer_appraisals.complete');
        $redirect->assertSee('会員様のメールアドレスへ振込先のご案内をお送りしておりますのでご確認ください。');
    }

    public function testApply_管理者クーポン使用(): void
    {
        // POST時に419エラーが発生するのでCSRFミドルウェアを無効にする
        $this->withoutMiddleware([VerifyCsrfToken::class]);

        //リクエストデータの作成
        $requestData = array_merge(UserData::data(), AppraisalApplyData::data(), AppraisalClaimData::dataForBankAndAdminCouponCode());
        $requestData['is_bookbinding'] = false;
        $requestData['target_type'] = TargetType::USER->value;

        // リクエストデータを元に、リクエストを作成
        $response = $this->post('/user/offer_appraisals/apply', $requestData);
        // レスポンスのステータスコードが302（リダイレクト）であることを確認
        $response->assertStatus(302);

        // データベースに期待するデータが存在することを確認
        $geocodingData = GetGeocoding::GetGeocodingData($requestData['birthday_prefectures'] . $requestData['birthday_city']);

        // ユーザー情報を登録する
        $this->assertDatabaseHas('users', [
            'name1' => $requestData['name1'],
            'name2' => $requestData['name2'],
            'kana1' => $requestData['kana1'],
            'kana2' => $requestData['kana2'],
            'email' => $requestData['email'],
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);

        //このユーザーでログイン
        $user = User::where('email', $requestData['email'])->first();
        $this->actingAs($user, 'user');

        //appraisal_appliesにデータが存在することを確認し、そのデータを取得
        $this->assertDatabaseHas('appraisal_applies', [
            'reference_type' => User::class,
            'reference_id' => $user->id,
            'birthday' => $requestData['birthday'],
            'birthday_time' => $requestData['birthday_time'],
            'birthday_prefectures' => $requestData['birthday_prefectures'],
            'birthday_city' => $requestData['birthday_city'],
            'longitude' => $geocodingData['longitude'],
            'latitude' => $geocodingData['latitude'],
            'timezome' => 9, //海外展開時にはここが変更できるようにする。現在は日本のみ
        ]);
        $appraisalApply = AppraisalApply::where('reference_type', User::class)->where('reference_id', $user->id)->first();

        //appraisal_claimsにデータが存在することを確認
        $this->assertDatabaseHas('appraisal_claims', [
            'user_id'            => $user->id,
            'appraisal_apply_id' => $appraisalApply->id,
            'price'              => $requestData['total_amount'],
            'coupon_code'        => $requestData['coupon_code'],
            'discount_price'     => $requestData['discount_price'],
            'purchase_date'      => today()->format('Y-m-d'),
            'payment_type'       => AppraisalClaim::BANK,
            'content_type'       => AppraisalClaim::PERSONAL,
            'is_paid'            => false,
        ]);

        //管理者クーポンの所有者を取得
        $inviter = AdminCoupon::where('coupon_code', $requestData['coupon_code'])->first()->user;

        // 招待クーポンを使用した場合、使用されたユーザーにバックポイントが付与されることを確認
        $this->assertDatabaseHas('users', [
            'id'        => $inviter->id,
            'point_sum' => $inviter->point_sum,
        ]);

        // リダイレクト先が正しいことを確認
        $targetType = TargetType::USER->value;
        $redirectUrl = "/user/offer_appraisals/complete/{$appraisalApply->id}?target_type={$targetType}";
        $response->assertRedirect($redirectUrl);
        $redirect = $this->get($redirectUrl);
        $redirect->assertViewIs('user.offer_appraisals.complete');
        $redirect->assertSee('会員様のメールアドレスへ振込先のご案内をお送りしておりますのでご確認ください。');
    }
}
