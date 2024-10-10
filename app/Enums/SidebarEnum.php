<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SidebarEnum extends Enum
{
    public const SidebarTitle = 'sidebar.menu';

    public const Menu = [
        self::User,
        self::Coupon,
        self::Pattern,
        // self::ZodiacPattern,
        // self::HousePattern,
        // self::SabianPattern,
        // self::AspectPattern,
        self::AdminMail,
    ];

    # Pattern
    public const Pattern = [
        'prefix' => 'admin/pattern',
        'title' => 'マスタ管理',
        'route_name' => 'admin.pattern.sabian-list',
        'icon' => 'compass-fill',
        'sub_menu' => [
            self::SabianPattern,
            self::HousePattern,
            self::ZodiacPattern,
            self::AspectPattern,
        ]
    ];

    # SabianPattern
    public const SabianPattern = [
        'title' => 'sidebar.sabian_pattern',
        'route_name' => 'admin.pattern.sabian-list',
    ];

    # HousePattern
    public const HousePattern = [
        'title' => 'sidebar.house_pattern',
        'route_name' => 'admin.pattern.house-list',
    ];

    # ZodiacPattern
    public const ZodiacPattern = [
        'title' => 'sidebar.zodiac_pattern',
        'route_name' => 'admin.pattern.zodiac-list',
    ];

    # AspectPattern
    public const AspectPattern = [
        'title' => 'sidebar.aspect_pattern',
        'route_name' => 'admin.pattern.aspect-list',
    ];

    # Coupon
    public const Coupon = [
        'prefix' => 'coupons',
        'title' => 'クーポン管理',
        'route_name' => 'admin.register_coupons.edit',
        'icon' => 'tag-fill',
        'sub_menu' => [
            self::RegisterCoupon,
            self::AdminCoupon,
        ]
    ];

    # RegisterCoupon
    public const RegisterCoupon = [
        'title' => '会員登録クーポン管理',
        'route_name' => 'admin.register_coupons.edit',
    ];

    # AdminCoupon
    public const AdminCoupon = [
        'title' => '管理者クーポン管理',
        'route_name' => 'admin.admin_coupons.index',
    ];

    # User
    public const User = [
        'prefix' => 'users',
        'title' => '会員管理',
        'route_name' => 'admin.users.index',
        'icon' => 'person-fill',
        'sub_menu' => [
            self::UserList,
            self::UnPaidAppraisalList,
        ]
    ];

    public const UserList = [
        'title' => '会員一覧',
        'route_name' => 'admin.users.index',
    ];

    public const UnPaidAppraisalList = [
        'title' => '未払会員一覧',
        'route_name' => 'admin.users.unpaid_appraisal_list',
    ];

    # AdminMail
    public const AdminMail = [
        'prefix' => 'admin_mails',
        'title' => '管理者メール設定',
        'route_name' => 'admin.admin_mails.index',
        'icon' => 'envelope-fill',
        'sub_menu' => [
            self::AdminMailList,
            self::AdminMailCreate,
        ]
    ];

    public const AdminMailList = [
        'title' => '管理者メール一覧',
        'route_name' => 'admin.admin_mails.index',
    ];

    public const AdminMailCreate = [
        'title' => '管理者メール登録',
        'route_name' => 'admin.admin_mails.create',
    ];
}
