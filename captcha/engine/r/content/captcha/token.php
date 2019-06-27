<?php

if (!isset($hash)) {
    $hash = Guard::hash();
} else if (is_callable($hash)) {
    $hash = call_user_func($hash, Guard::hash());
}

Captcha::set($id, $hash);

return $hash;