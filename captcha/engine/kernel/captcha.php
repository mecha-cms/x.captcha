<?php

class Captcha extends Genome {

    public static $config = [
        'session' => [
            'captcha' => 'mecha.captcha'
        ]
    ];

    public static function set($id, $value = null) {
        Session::set(self::$config['session']['captcha'] . '.' . $id, $id . ':' . $value);
        return true;
    }

    public static function get($id, $fail = null) {
        return e(substr(Session::get(self::$config['session']['captcha'] . '.' . $id, $fail), strlen($id) + 1));
    }

    public static function reset($id = null) {
        Session::reset(self::$config['session']['captcha'] . ($id ? '.' . $id : ""));
        return true;
    }

    public static function check($id, $input, $fail = false) {
        return self::get($id) === $input ? $input : $fail;
    }

    public static function __callStatic($kin, $lot = []) {
        if ($type = File::exist(__DIR__ . DS . '..' . DS . '..' . DS . 'lot' . DS . 'worker' . DS . $kin . '.php')) {
            extract(Lot::get(null, []));
            return require $type;
        }
        return !defined('DEBUG') || !DEBUG ? null : parent::__callStatic($kin, $lot);
    }

}