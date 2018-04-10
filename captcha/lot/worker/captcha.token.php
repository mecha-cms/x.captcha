<?php

// `Captcha::token($id = null, $hash = null, $html = true)`
list($id, $hash, $html) = array_replace([null, null, true], $lot);

if ($hash === null) {
    $hash = Guardian::hash();
} else if (is_callable($hash)) {
    $hash = $hash(Guardian::hash());
}

Captcha::set($id, $hash);

return $html ? HTML::span($hash, ['class[]' => ['captcha', 'captcha-token'], 'id' => 'captcha:' . $id, 'contenteditable' => true]) : $hash;