<?php

declare(strict_types=1);

namespace App\Application\Constants;

class CS
{
    const CID = 1;
    const APP_KEY = '74BwSBdUgM9hESPNGopHLXvODApNbA5zC4qsMoP8r7M=';
    const REGISTRATION_DISABLED = true;
    const RSA = 'HS256';
    const CONN = 'mysql:host=localhost;user=root;password=root;dbname=hbn;charset=utf8';
    const IMG_TYPES = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml', 'image/webp'];
    const PATH_MIME = 'resource/mime.json';
    const STORAGE_PATH = "/../../../storage/";
    const MEDIA_PATH = "/../../../../public/images/";
    const ROLES = [1, 2, 3];
    const ROLE_ADMIN = ['admin'];
    const ROLE_SUPERVISOR = ['supervisor'];
    const ROLE_USER = ['user'];
    const ROLE_SUPERVISORS = ['supervisor', 'admin'];
    const ADMIN_AUTH = 'admin/auth.html';
    const ERROR_PAGE = 'error.html';
    const PAGE = 'page.html';
    const SIDES = ['top' => '', 'header' => '', 'bottom' => '','sidebarLeft' => '',
        'sidebarRight' => '', 'contentTop' => '', 'contentBottom' => ''];
    const ADMIN_NODES = ['users', 'company', 'mime', 'page', 'article', 'block', 'media',
        'banner', 'slide', 'jsondata', 'department', 'location', 'mail', 'config'
    ];
}
