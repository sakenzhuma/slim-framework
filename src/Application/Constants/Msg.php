<?php

declare(strict_types=1);

namespace App\Application\Constants;

class Msg
{
    public const WELCOME = ', Добро пожаловать!';
    public const SUCCESS = 'Успешно выполнено!';
    public const INVALID = 'Форма недействительна.';
    public const NOT_IN_REQUEST = 'Ваш запрос не может быть обработан.';
    public const UPLOAD_NOT_ALLOWED = 'Запрещено загружать в другие папки.';
    public const GOOD_MISSING = 'Сначала выберите продукт.';
    public const FAILED = 'Не удалось выполнить действие.';
    public const FAILED_TO_UPLOAD = 'Не удалось загрузить.';
    public const FAILED_TO_DELETE = 'Не удалось удалить.';
    public const INVALID_FILETYPE = 'Запрещено; недопустимый тип файла.';
    public const UPLOAD_SUCCESS = 'Файлы успешно загружены!';
    public const INVALID_PASSWORD = 'Неверный пароль.';
    public const INVALID_PIN = 'Неверный пин-код.';
    public const INVALID_PASSWORD_OR_LOGIN = 'Неверный логин или пароль.';
    public const USER_EXIST = 'Пользователь с данным адресом электронной почты уже существует.';
    public const USER_NOT_EXIST = 'Пользователь с данным адресом электронной почты не существует или не активен.';
    public const COMPANY_EXIST = 'Такая компания уже существует.';
    public const COMPANY_NOT_EXIST = 'Такая компания не существует или не активен.';
    public const FORBIDDEN = 'Возможно, это действие не разрешено для вашей учетной записи.';
    public const SERVICE_DISABLED = 'Это действие отключено.';
    public const FILE_EXIST = 'Этот файл уже существует в системе.';
    public const FILE_NOT_EXIST = 'Этот файл не существует в системе.';
    public const AUTHORIZATION_REQUIRED = 'Требуется авторизация!';
    public const NO_DATA = 'Нет данных.';
    public const IMAGE_ONLY = 'Принимаются только файлы изображений!';
    public const DELETE_DISABLED = 'Опция удаления отключена!';
    public const EDIT_NOT_DELETE = 'Редактировать вместо удаления!';
    public const SEALED = 'Статус запечатан, никакие изменения не принимаются!';
    public const PIN_EMAILED = 'Пин-код отправлен на вашу почту!';
    public const PASSWORD_EMAILED = 'Пожалуйста, проверьте свою электронную почту на наличие нового пароля.';
    public const REGISTRATION_DISABLED = 'Прямая регистрация отключена';
    public const ACCESS_DENIED = 'Отказано в доступе';
    public const EXPIRED = 'Срок действия вашей учетной записи истек.';
}
