<?php

// `Captcha::token($id = null, $hash = null, $html = true)`
list($id, $hash, $html) = extend([null, null, true], $lot, false);

if ($hash === null) {
    $hash = Guardian::hash();
} else if (is_callable($hash)) {
    $hash = call_user_func($hash, Guardian::hash());
}

Captcha::set($id, $hash);

return $html ? HTML::span($hash, ['class[]' => ['captcha', 'captcha-token'], 'id' => 'captcha:' . $id, 'contenteditable' => true]) : $hash;