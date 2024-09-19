<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Collection;
use Illuminate\Notifications\Notifiable;
use App\Notifications\User\CustomVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Notifications\User\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;

class User extends Authenticatable implements MustVerifyEmail
{
    use Billable;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthday' => 'date',
        'birthday_time' => 'datetime',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'solar_date'=>'int',
    ];

    public const DEMY_USER = 1;

    public const INFLUENCER = 20;

    public const GENERAL = 10;

    public const ALL = 99;

    public const TYPE = [
        self::GENERAL => '一般',
        self::INFLUENCER => 'インフルエンサー',
    ];

    /**
     * パスワードリセット
     *
     * @param $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    // メール確認マルチオースカスタム
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail());
    }

    // フルネームを取得する
    public function getFullNameAttribute(): string
    {
        return $this->name1 . $this->name2;
    }

    // 出生時間を取得
    public function getFullBirthdayTimeAttribute(): string
    {
        return $this->birthday_time->format('H:i');
    }

    // 出生地を取得
    public function getFullBirthdayPlaceAttribute(): string
    {
        return $this->birthday_prefectures . $this->birthday_city;
    }

    // クーポンコードの自動作成
    public static function generateUniqueWelcomeCode(): string
    {
        do {
            $welcomeCode = substr(str_shuffle('012345789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);
        } while (self::where('welcome_code', $welcomeCode)->exists());

        return $welcomeCode;
    }

    // クーポンの使用履歴を取得
    public function getUsedCouponLogs(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $adminCouponCodes = AdminCoupon::where('user_id', $this->id)->pluck('coupon_code');
        // admin_couponsのクーポンコードを使用しているappraisalClaimsを取得する
        $appraisalClaims = AppraisalClaim::whereIn('coupon_code', $adminCouponCodes)->get();

        // 月毎にグループ化
        $everyMonthAppraisalClaims = $appraisalClaims->groupBy(static function ($appraisalClaim) {
            return $appraisalClaim->purchase_date->format('Y年m月');
        });

        // 月毎に誰がいつ使用したかをまとめる
        $usedCouponLogs = $everyMonthAppraisalClaims->map(static function ($appraisalClaims) {
            return $appraisalClaims->map(static function ($appraisalClaim) {
                return [
                    'user_name' => $appraisalClaim->user->full_name,
                    'purchase_date' => $appraisalClaim->purchase_date->format('Y年m月d日'),
                ];
            });
        });

        // ページネーションに変換
        $usedCouponLogs = new \Illuminate\Pagination\LengthAwarePaginator(
            $usedCouponLogs->forPage(request()->page, 3),
            $usedCouponLogs->count(),
            3,
            request()->page,
            ['path' => request()->url()]
        );

        return $usedCouponLogs;
    }

    ////// リレーションエリア ////////

    // emailでメンバーを取得
    public function member(): HasOne
    {
        return $this->hasOne(Member::class, 'email');
    }

    public function families(): HasMany
    {
        return $this->hasMany(Family::class);
    }

    // Userの鑑定申し込み
    public function appraisalApplies(): MorphMany
    {
        return $this->morphMany('App\Models\AppraisalApply', 'reference');
    }

    public function appraisalClaims(): HasMany
    {
        return $this->hasMany(AppraisalClaim::class);
    }

    //Myホロスコープチャートをすでにもっているかどうか
    public function isHasMyHoroscope(): bool
    {
        if ($this->birthday && $this->birthday_time && $this->birthday_prefectures) {
            return true;
        }
        return false;
    }

    public function hasPaidForMyHoroscope(): bool
    {
        return $this->appraisalClaims()
            ->where('is_paid', true)
            ->exists();
    }

    // 製本の申し込みをしているかどうか
    public function isHasBookbinding(): bool
    {
        if ($this->appraisalApplies()->whereHas('bookbindingUserApplies')->exists()) {
            return true;
        }
        return false;
    }

    // 管理者クーポンの使用回数を集計する
    public function countUsedAdminCoupon(string $couponCode): int
    {
        return AppraisalClaim::where('user_id', $this->id)
            ->where('coupon_code', $couponCode)
            ->count();
    }

    // 登録クーポンの使用回数を集計する
    public function countUsedRegisterCoupon(): int
    {
        $allRegisterCouponCodes = self::pluck('welcome_code');
        \Log::debug([
            'user_id' => $this->id,
        ]);
        $appraisalClaims = AppraisalClaim::where('user_id', $this->id)->get();
        $usedRegisterCouponCount = $appraisalClaims->whereIn('coupon_code', $allRegisterCouponCodes)->count();

        return $usedRegisterCouponCount;
    }

    // クーポンの使用期限外かどうかを判定
    public function isCouponTimeLimitOver(): bool
    {
        $timeLimit = RegisterCoupon::first()->time_limit;
        $createdAt = $this->created_at;
        $timeLimitDay = $createdAt->addDays($timeLimit);
        // 99は無期限とする
        if ($timeLimit === 99) {
            return false;
        }

        // 例）time_limit_dayが2021-01-01の場合、2021-01-01まで使える
        if ($timeLimitDay > today()->format('Y-m-d')) {
            return false;
        }
        return true;
    }

    // 復活可能かどうかを判定
    public function canRestore(): bool
    {
        // 現行のユーザーの中に同じメールアドレスが存在する場合は復活できない
        if (self::where('email', $this->email)->exists()) {
            return false;
        }

        return true;
    }

    public function familiesWithAppraisalApplies()
    {
        return $this->families()->whereHas('appraisalApplies', static function ($query) {
            $query->where('solar_return','!=',0);
        })->get();
    }
}
