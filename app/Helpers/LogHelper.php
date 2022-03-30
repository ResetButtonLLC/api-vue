<?php

namespace App\Helpers;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class LogHelper
{
    const TYPE_DEBUG = 'debug';
    const TYPE_INFO = 'info';
    const TYPE_WARNING = 'warning';
    const TYPE_ERROR = 'error';

    public static function write($message, $type)
    {
        Log::create([
            'user_id' => Auth::id() ?? 0,
            'message' => $message,
            'type' => $type,
            'is_readed' => false
        ]);
    }

    public static function debug($message)
    {
        self::write($message, self::TYPE_DEBUG);
    }

    public static function info($message)
    {
        self::write($message, self::TYPE_INFO);
    }

    public static function warning($message)
    {
        self::write($message, self::TYPE_WARNING);
    }

    public static function error($message)
    {
        self::write($message, self::TYPE_ERROR);
    }
}
