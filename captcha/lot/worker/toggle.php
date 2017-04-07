<?php

// `Captcha::toggle($id = null, $text = 'I am not a robot.')`
list($id, $text) = array_replace([null, $language->captcha_toggle, false], $lot);

$hash = Guardian::hash($id);

Captcha::set($id, $hash);

return Form::input('captcha', 'checkbox', $hash, null, ['classes' => ['captcha', 'captcha-toggle'], 'id' => 'captcha:' . $id]) . ' ' . HTML::label($text, ['for' => 'captcha:' . $id]);