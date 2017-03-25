<?php

    class Config {
        function __construct() {
            // Nothing
        }

        public function get() {
            $config = array(
                'contentType'   => 'application/json',
                'frontend'      => '*',
                'db'            => [
                    'name'      => 'undangan',
                    'host'      => 'localhost',
                    'username'  => 'admin',
                    'password'  => ''
                ]
            );

            return $config;
        }
    }