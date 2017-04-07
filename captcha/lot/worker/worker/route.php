<?php

function fn_captcha_text_color($hex) {
    if (is_string($hex) && preg_match('#[a-f\d]{3,6}#i', $hex, $m)) {
        $color = $m[0];
        if (strlen($color) !== 3 && strlen($color) !== 6) {
            return [];
        } else if (strlen($color) === 3) {
            $color = preg_replace('#(.)#', '$1$1', $color);
        }
        $s = str_split($color, 2);
        return [(int) hexdec($s[0]), (int) hexdec($s[1]), (int) hexdec($s[2]), (float) 1];
    }
    return [];
}

Route::set('captcha.png', function() {
    HTTP::mime('image/png')->header([
        'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
        'Cache-Control' => 'post-check=0, pre-check=0',
        'Pragma' => 'no-cache'
    ]);
    $id = Request::get('id');
    extract(json_decode(Captcha::get($id . '_'), true));
    $text = Captcha::get($id);
    $image = imagecreatetruecolor($w, $h);
    $b = fn_captcha_text_color($b) ?: [255, 255, 255, 0];
    $c = fn_captcha_text_color($c) ?: [0, 0, 0, 1];
    $f = Path::D(__DIR__, 2) . DS . 'asset' . DS . 'ttf' . DS . $f . '.ttf';
    imagefill($image, 0, 0, 0x7fff0000);
    imagealphablending($image, true);
    imagesavealpha($image, true);
    $b = imagecolorallocatealpha($image, $b[0], $b[1], $b[2], 127 - ($b[3] * 127));
    $c = imagecolorallocatealpha($image, $c[0], $c[1], $c[2], 127 - ($c[3] * 127));
    imagefilledrectangle($image, 0, 0, $w, $h, $b);
    // center the image text…
    $xi = imagesx($image);
    $yi = imagesy($image);
    $box = imagettfbbox($s, 0, $f, $text);
    $xr = abs(max($box[2], $box[4]));
    $yr = abs(max($box[5], $box[7]));
    $x = intval(($xi - $xr) / 2);
    $y = intval(($yi + $yr) / 2);
    imagettftext($image, $s, 0, $x, $y, $c, $f, $text);
    imagepng($image);
    imagedestroy($image);
    exit;
});