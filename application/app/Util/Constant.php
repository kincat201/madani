<?php

namespace App\Util;

class Constant {

    const USER_ROLE_USER = 'USER';
    const USER_ROLE_ADMIN = 'ADMIN';

    const USER_ROLES = [
        self::USER_ROLE_USER => 'Pengguna',
        self::USER_ROLE_ADMIN => 'Super Admin',
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
    const NOTIFICATION_TYPE_RESERVATION = 'RESERVATION';

    const NOTIFICATION_TYPE = [
        self::NOTIFICATION_TYPE_OTHER => 'Lainnya',
        self::NOTIFICATION_TYPE_RESERVATION => 'Reservasi',
    ];

    const NOTIFICATION_ICON = [
        self::NOTIFICATION_TYPE_OTHER => 'tags',
        self::NOTIFICATION_TYPE_RESERVATION => 'list',
    ];

    const NOTIFICATION_LINK = [
        self::NOTIFICATION_TYPE_OTHER => 'settings',
        self::NOTIFICATION_TYPE_RESERVATION => 'admin.reservations',
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

    const RESERVATION_STATUS_NEW = 'NEW';
    const RESERVATION_STATUS_APPROVED = 'APPROVED';
    const RESERVATION_STATUS_REJECTED = 'REJECTED';

    const RESERVATION_STATUS_LIST = [
        self::RESERVATION_STATUS_NEW => 'Baru',
        self::RESERVATION_STATUS_APPROVED => 'Disetujui',
        self::RESERVATION_STATUS_REJECTED => 'Ditolak',
    ];

    const RESERVATION_STATUS_LABEL_LIST = [
        self::RESERVATION_STATUS_NEW => 'primary',
        self::RESERVATION_STATUS_APPROVED => 'success',
        self::RESERVATION_STATUS_REJECTED => 'danger',
    ];

    const ROOM_BIG = 'BIG';
    const ROOM_SMALL = 'SMALL';
    const ROOM_SYNERGY = 'SYNERGY';
    const ROOM_MIND = 'MIND';
    const ROOM_PASSIONATE = 'PASSIONATE';
    const ROOM_RESPECT = 'RESPECT';
    const ROOM_PERFORMANCE = 'PERFORMANCE';

    const ROOM_LIST = [
        self::ROOM_BIG => 'Ruangan Meeting Besar',
        self::ROOM_SMALL => 'Ruangan Meeting Kecil',
        self::ROOM_SYNERGY => 'Ruang Meeting Synergy',
        self::ROOM_MIND => 'Ruang Meeting Open Mind',
        self::ROOM_PASSIONATE => 'Ruang Dealing Passionate',
        self::ROOM_RESPECT => 'Ruang Dealing Respect',
        self::ROOM_PERFORMANCE => 'Ruang Dealing Performance',
    ];

    const FOOD_NO = 'NO';
    const FOOD_YES = 'YES';

    const FOOD_LIST = [
        self::FOOD_NO => 'Tidak Ada',
        self::FOOD_YES => 'Snack / Makan',
    ];

    const FOOD_LABEL_LIST = [
        self::FOOD_YES => 'primary',
        self::FOOD_NO => 'danger',
    ];

}
