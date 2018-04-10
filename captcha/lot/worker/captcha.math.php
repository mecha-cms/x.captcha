<?php

// `Captcha::math($id = null, $min = 1, $max = 10, $text = [], $format = '%{a}% %{?}% %{b}%')`
list($id, $min, $max, $text, $format) = array_replace([null, 1, 10, [], '%{a}% %{?}% %{b}%'], $lot);

$a = mt_rand($min, $max);
$b = mt_rand($min, $max);
$a_text = isset($text[$a]) ? $text[$a] : $a;
$b_text = isset($text[$b]) ? $text[$b] : $b;
if ($a - $b > 0) {
    Captcha::set($id, $a - $b);
    $o = isset($text['-']) ? $text['-'] : '&#x2212;';
} else {
    Captcha::set($id, $a + $b);
    $o = isset($text['+']) ? $text['+'] : '&#x002B;';
}

return HTML::span(__replace__($format, [
    'a' => $a_text,
    'b' => $b_text,
    '?' => $o
]), [
    'class[]' => ['captcha', 'captcha-math'],
    'id' => 'captcha:' . $id
]);