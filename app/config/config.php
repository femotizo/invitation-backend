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
                    'host'      => 'localhost',
                    'username'  => 'root',
                    'password'  => ''
                ]
            );

            return $config;
        }
    }