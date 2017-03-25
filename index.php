<?php

    require 'vendor/autoload.php';
    $app    = new \Slim\App();

    require_once 'app/config/db.php';
    require_once 'app/config/config.php';

    require 'app/class/token.php';

    require 'app/controller/index.php';
    require 'app/controller/auth.php';
    require 'app/controller/confirm.php';

    $app->run();