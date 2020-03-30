<?php

session_start();

require_once './vendor/autoload.php';

use Gregwar\Captcha\CaptchaBuilder;

$builder = new CaptchaBuilder;

$_SESSION['user_phrase'] = $builder->getPhrase();

header('Content-type: image/jpeg');

$builder->build();

$builder->output();

