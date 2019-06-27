<?php

foreach (g(__DIR__ . DS . 'content' . DS . 'captcha', 'php') as $v) {
    Content::set('captcha/' . Path::N($v), $v);
}

Content::set('captcha', __DIR__ . DS . 'content' . DS . 'captcha.php');