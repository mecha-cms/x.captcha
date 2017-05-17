<?php

// `Captcha::text($id = null, $background = false, $color = '000', $size = 16, $width = 6, $height = 2, $text = 7, $font = '0')`
list($id, $background, $color, $size, $width, $height, $text, $font) = array_replace([null, false, '000', 16, 6, 2, 7, '0'], $lot);

// `em` unit relative to `$size`
$width *= $size;
$height *= $size;

Captcha::set($id, substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $text));
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
    'classes' => ['captcha', 'captcha-text'],
    'id' => 'captcha:' . $id,
    'width' => $width,
    'height' => $height
]);