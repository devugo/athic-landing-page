<?php

    $GLOBALS['config'] = array(
        'mysql' => array(
            'host' => '127.0.0.1',
            'username' => 'root',
            'password' => '',
            'db' => 'athic_landing_page'
        )
    );

    spl_autoload_register(function($class) {
        require_once 'classes/' . $class . '.php';
    });

    require_once 'functions/sanitize.php';