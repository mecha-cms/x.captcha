<?php

class Captcha extends Genome {

    const config = [
        'session' => [
            'captcha' => 'mecha.captcha'
        ]
    ];

    public static $config = self::config;

    public static function set($id, $value = null) {
        Cookie::set(self::$config['session']['captcha'] . '.' . $id, $value, [
            'expire' => 1 / 2.4,
            'http_only' => true // will not be available in `document.cookie`
        ]);
        return true;
    }

    public static function get($id, $fail = null) {
        return Cookie::get(self::$config['session']['captcha'] . '.' . $id, $fail);
    }

    public static function reset($id = null) {
        Cookie::reset(self::$config['session']['captcha'] . ($id ? '.' . $id : ""));
        return true;
    }

    public static function check($in, $id, $fail = false) {
        return self::get($id, uniqid()) === $in ? $in : $fail;
    }

    public static function __callStatic($kin, $lot = []) {
        if ($type = File::exist(__DIR__ . DS . '..' . DS . '..' . DS . 'lot' . DS . 'worker' . DS . 'captcha.' . $kin . '.php')) {
            extract(Lot::reset(['lot', 'kin', 'type'])->get(null, []));
            return require $type;
        }
        return !defined('DEBUG') || !DEBUG ? null : parent::__callStatic($kin, $lot);
    }

}