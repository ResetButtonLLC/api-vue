<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class DBHelper
{
    public static function getName($project, $profile)
    {
        return 'gym_' . Str::slug($project, '') . '_' . Str::slug($profile, '');
    }

    public static function enableDefault()
    {
        Config::set('database.default', 'mysql');
    }

    public static function enableProfile()
    {
        Config::set('database.default', 'profile');
    }

    public static function setProfileDB($name)
    {
        Config::set('database.connections.profile.database', $name);
    }

    public static function migrate($project, $profile, $isFresh)
    {
        try {
            $projectProfile = self::getName($project, $profile);

            self::setProfileDB($projectProfile);
            DB::statement('CREATE DATABASE IF NOT EXISTS `' . $projectProfile . '`');

            Artisan::call($isFresh ? 'migrate:fresh' : 'migrate', [
                '--database' => 'profile',
                '--path' => 'database/migrations/profile',
                '--force' => true
            ]);
        } catch (\Exception $e) {
            LogHelper::error('Не удалось выполнить инициализацию БД для: ' . $project . ' - ' . $profile);

            return false;
        }

        return true;
    }

    public static function init($project, $profile)
    {
        return self::migrate($project, $profile, false);
    }

    public static function fresh($project, $profile)
    {
        return self::migrate($project, $profile, true);
    }
}
