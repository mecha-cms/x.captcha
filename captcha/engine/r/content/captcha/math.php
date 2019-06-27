<?php

$range = array_replace([1, 10], $range ?? []);

$a = mt_rand(...$range);
$b = mt_rand(...$range);
$text_a = Language::get('captcha-math-.' . $a);
$text_b = Language::get('captcha-math-.' . $b);
if ($a - $b > 0) {
    Captcha::set($id, $a - $b);
    $o = Language::get('captcha-math-.-');
} else {
    Captcha::set($id, $a + $b);
    $o = Language::get('captcha-math-.+');
}

return sprintf(Language::get('captcha-math-q'), $a, $b, $o);