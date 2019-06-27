<?php

class Captcha extends Genome {

    public static function get($id) {
        return Session::get('captcha.' . $id);
    }

    public static function let($id = null) {
        return Session::let('captcha' . ($id ? '.' . $id : ""));
    }

    public static function set($id, $value) {
        return Session::set('captcha.' . $id, $value);
    }

    public static function check($value, $id) {
        return $value && self::get($id) === $value ? $value : false;
    }

    /*
    public static function __callStatic($kin, $lot = []) {
        if ($type = File::exist(__DIR__ . DS . '..' . DS . '..' . DS . 'lot' . DS . 'worker' . DS . 'captcha.' . $kin . '.php')) {
            extract(Lot::reset(['lot', 'kin', 'type'])->get(null, []));
            return require $type;
        }
        return !defined('DEBUG') || !DEBUG ? null : parent::__callStatic($kin, $lot);
    }
    */

}