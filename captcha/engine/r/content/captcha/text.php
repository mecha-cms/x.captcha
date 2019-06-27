<?php

// `Captcha::text($id = null, $background = false, $color = '000', $size = 16, $width = 6, $height = 2, $text = 7, $font = '0')`
list($id, $background, $color, $size, $width, $height, $text, $font) = alter([null, false, '000', 16, 6, 2, 7, '0'], $lot, false);

// `em` unit relative to `$size`
$width *= $size;
$height *= $size;

// $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$chars = '23456789abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ'; // kill `0`, `1`, `I`, and `O` character as they may confuse the user

Captcha::set($id, substr(str_shuffle($chars), 0, $text));
Captcha::set($id . '_', json_encode([
    'b' => $background,
    'c' => $color,
    's' => $size,
    'w' => $width,
    'h' => $height,
    't' => $text,
    'f' => $font
]));

return HTML::img($url . '/captcha.png' . HTTP::query([
    'id' => $id,
    'v' => time() // disable cache
]), $id, [
    'class[]' => ['captcha', 'captcha-text'],
    'id' => 'captcha:' . $id,
    'width' => $width,
    'height' => $height
]);