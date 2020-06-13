<?php

namespace App\Util;

class Constant {

    const USER_ROLE_USER = 'USER';
    const USER_ROLE_ADMIN = 'ADMIN';
    const USER_ROLE_CASHIER = 'CASHIER';
    const USER_ROLE_DESIGNER = 'DESIGNER';
    const USER_ROLE_ENGINEER = 'ENGINEER';

    const USER_ROLES = [
        self::USER_ROLE_ADMIN => 'Super Admin',
        self::USER_ROLE_USER => 'Pengguna',
        self::USER_ROLE_CASHIER => 'Kasir',
        self::USER_ROLE_DESIGNER => 'Designer',
        self::USER_ROLE_ENGINEER => 'Operator Mesin',
    ];

    const COMMON_STATUS_ACTIVE = 'ACTIVE';
    const COMMON_STATUS_INACTIVE = 'INACTIVE';

    const COMMON_STATUS_LIST = [
        self::COMMON_STATUS_ACTIVE => 'ACTIVE',
        self::COMMON_STATUS_INACTIVE => 'INACTIVE',
    ];

    const COMMON_STATUS_LABEL_LIST = [
        self::COMMON_STATUS_ACTIVE => 'info',
        self::COMMON_STATUS_INACTIVE => 'danger',
    ];

    const NOTIFICATION_STATUS_READ = 'READ';
    const NOTIFICATION_STATUS_UNREAD = 'UNREAD';

    const NOTIFICATION_STATUS = [
        self::NOTIFICATION_STATUS_READ => 'Terbaca',
        self::NOTIFICATION_STATUS_UNREAD => 'Belum Dibaca',
    ];

    const NOTIFICATION_TYPE_OTHER = 'OTHER';

    const NOTIFICATION_TYPE = [
        self::NOTIFICATION_TYPE_OTHER => 'Lainnya',
    ];

    const NOTIFICATION_ICON = [
        self::NOTIFICATION_TYPE_OTHER => 'tags',
    ];

    const NOTIFICATION_LINK = [
        self::NOTIFICATION_TYPE_OTHER => 'settings',
    ];

    const COMMON_YES = '1';
    const COMMON_NO = '0';

    const COMMON_YESNO_LIST = [
        self::COMMON_YES => 'YES',
        self::COMMON_NO => 'NO',
    ];

    const COMMON_YESNO_LABEL_LIST = [
        self::COMMON_YES => 'info',
        self::COMMON_NO => 'danger',
    ];

    const COMMON_STATUS_AVAILABLE = 'AVAILABLE';
    const COMMON_STATUS_UNAVAILABLE = 'UNAVAILABLE';

    const COMMON_STATUS_AVAILABLE_LIST = [
        self::COMMON_STATUS_AVAILABLE => 'Tersedia',
        self::COMMON_STATUS_UNAVAILABLE => 'Tidak Tersedia',
    ];

    const COMMON_STATUS_AVAILABLE_LABEL_LIST = [
        self::COMMON_STATUS_AVAILABLE => 'success',
        self::COMMON_STATUS_UNAVAILABLE => 'danger',
    ];

    const MEMBER_TYPES_GUEST = 'GUEST';
    const MEMBER_TYPES_MEMBER = 'MEMBER';

    const MEMBER_TYPES_LIST = [
        self::MEMBER_TYPES_GUEST => 'Tamu',
        self::MEMBER_TYPES_MEMBER => 'Pelanggan',
    ];

    const ORDER_STATUS_NEW = 'NEW';
    const ORDER_STATUS_REQUEST_DESIGN = 'REQUEST_DESIGN';
    const ORDER_STATUS_OFFERED_DESIGN = 'OFFERED_DESIGN';
    const ORDER_STATUS_PROGRESS = 'PROGRESS';
    const ORDER_STATUS_COMPLETED = 'COMPLETED';
    const ORDER_STATUS_CANCELLED = 'CANCELLED';

    const RESERVATION_STATUS_LIST = [
        self::ORDER_STATUS_NEW => 'Baru',
        self::ORDER_STATUS_REQUEST_DESIGN => 'Menunggu Design',
        self::ORDER_STATUS_OFFERED_DESIGN => 'Tawaran Design',
        self::ORDER_STATUS_PROGRESS => 'Diproses',
        self::ORDER_STATUS_COMPLETED => 'Selesai',
        self::ORDER_STATUS_CANCELLED => 'Dibatalkan',
    ];

    const RESERVATION_STATUS_LABEL_LIST = [
        self::ORDER_STATUS_NEW => 'primary',
        self::ORDER_STATUS_REQUEST_DESIGN => 'success',
        self::ORDER_STATUS_OFFERED_DESIGN => 'warning',
        self::ORDER_STATUS_PROGRESS => 'success',
        self::ORDER_STATUS_COMPLETED => 'info',
        self::ORDER_STATUS_CANCELLED => 'danger',
    ];

    const STATUS_PAYMENT_UNPAID = 'UNPAID';
    const STATUS_PAYMENT_HALF_PAID = 'HALF_UNPAID';
    const STATUS_PAYMENT_PAID = 'PAID';

    const STATUS_PAYMENT_LIST = [
        self::STATUS_PAYMENT_UNPAID => 'Belum Bayar',
        self::STATUS_PAYMENT_HALF_PAID => 'Bayar DP',
        self::STATUS_PAYMENT_PAID => 'Lunas',
    ];

}
