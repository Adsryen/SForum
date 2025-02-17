<?php

declare(strict_types=1);
/**
 * This file is part of zhuchunshu.
 * @link     https://github.com/zhuchunshu
 * @document https://github.com/zhuchunshu/SForum
 * @contact  laravel@88.com
 * @license  https://github.com/zhuchunshu/SForum/blob/master/LICENSE
 */
use App\Plugins\User\src\Models\UsersSetting;
use Hyperf\Utils\ApplicationContext;
use Qbhy\HyperfAuth\AuthManager;

if (! function_exists('auth')) {
    function auth(): App\Plugins\User\src\Auth
    {
        return new \App\Plugins\User\src\Auth();
    }
}

if (! function_exists('authManager')) {
    function authManager(?string $guard = null)
    {
        $auth = ApplicationContext::getContainer()->get(AuthManager::class);
        if (is_null($guard)) {
            return $auth;
        }
        return $auth->guard($guard);
    }
}

if (! function_exists('user_avatar')) {
    function user_avatar($email, $avatar = null)
    {
        if ($avatar) {
            return $avatar;
        }
        return get_options('theme_common_gavatar', 'https://cn.gravatar.com/avatar/') . md5($email);
    }
}

if (! function_exists('user_notice')) {
    function user_notice(): App\Plugins\User\src\Lib\UserNotice
    {
        return new \App\Plugins\User\src\Lib\UserNotice();
    }
}

if (! function_exists('user_DeCheckClass')) {
    function user_DeCheckClass($topic_tag, $userClassId): bool
    {
        if (! $topic_tag->userClass) {
            return false;
        }
        $data = json_decode($topic_tag->userClass, true, 512, JSON_THROW_ON_ERROR);
        return in_array($userClassId, $data, true);
    }
}

if (! function_exists('user_TopicTagQuanxianCheck')) {
    function user_TopicTagQuanxianCheck($topic_tag, $userClassId): bool
    {
        if (! @$topic_tag->userClass) {
            return true;
        }
        $data = json_decode($topic_tag->userClass, true, 512, JSON_THROW_ON_ERROR);
        return in_array($userClassId, $data, true);
    }
}

if (! function_exists('file_suffix')) {
    function file_suffix(string $path): string
    {
        $path = substr($path, strrpos($path, '/') + 1);
        return \Hyperf\Utils\Str::after($path, '.');
    }
}

if (! function_exists('path_file_name')) {
    function path_file_name(string $path): string
    {
        return substr($path, strrpos($path, '/') + 1);
    }
}

if (! function_exists('get_user_options')) {
    function get_user_options($user_id): App\Plugins\User\src\Models\UsersOption|\Hyperf\Database\Model\Collection|\Hyperf\Database\Model\Model|bool|array
    {
        $options = \App\Plugins\User\src\Models\UsersOption::find($user_id);
        if (! $options) {
            return false;
        }
        return $options;
    }
}

if (! function_exists('get_user_settings')) {
    /**
     * @param int|string $user_id 用户id
     * @param string $name name
     * @param string $default 默认值
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @return null|mixed
     */
    function get_user_settings(int | string $user_id, string $name, string $default = '')
    {
        if (! cache()->has('user.settings.' . $user_id . '.' . $name)) {
            cache()->set('user.settings.' . $user_id . '.' . $name, @\App\Plugins\User\src\Models\UsersSetting::query()->where(['user_id' => $user_id, 'name' => $name])->first()->value);
        }
        return core_default(cache()->get('user.settings.' . $user_id . '.' . $name), $default);
    }
}

if (! function_exists('user_settings_clear')) {
    function user_settings_clear($user_id)
    {
        foreach (\App\Plugins\User\src\Models\UsersSetting::query()->where('user_id', $user_id)->get() as $value) {
            cache()->delete('user.settings.' . $user_id . '.' . $value->name);
        }
    }
}

if (! function_exists('set_user_settings')) {
    function set_user_settings(int $user_id, array $data)
    {
        if (! is_array($data)) {
            return;
        }

        foreach ($data as $key => $value) {
            if (UsersSetting::query()->where(['user_id' => $user_id, 'name' => $key])->exists()) {
                UsersSetting::query()->where(['user_id' => $user_id, 'name' => $key])->update(['value' => $value]);
            } else {
                UsersSetting::query()->create(['user_id' => $user_id, 'name' => $key, 'value' => $value]);
            }
        }
        user_settings_clear($user_id);
    }
}
