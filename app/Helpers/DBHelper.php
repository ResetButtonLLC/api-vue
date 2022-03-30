<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class DBHelper
{
    public static function getName($client, $profile)
    {
        return 'gym_' . Str::slug($client, '') . '_' . Str::slug($profile, '');
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

    public static function migrate($client, $profile, $isFresh)
    {
        try {
            $clientProfile = self::getName($client, $profile);

            self::setProfileDB($clientProfile);
            DB::statement('CREATE DATABASE IF NOT EXISTS `' . $clientProfile . '`');

            Artisan::call($isFresh ? 'migrate:fresh' : 'migrate', [
                '--database' => 'profile',
                '--path' => 'database/migrations/profile',
                '--force' => true
            ]);
        } catch (\Exception $e) {
            LogHelper::error('Не удалось выполнить инициализацию БД для: ' . $client . ' - ' . $profile);

            return false;
        }

        return true;
    }

    public static function init($client, $profile)
    {
        return self::migrate($client, $profile, false);
    }

    public static function fresh($client, $profile)
    {
        return self::migrate($client, $profile, true);
    }
}
