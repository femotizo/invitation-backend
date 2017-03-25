<?php

    class Database {
        function __construct($config) {
            $this->config = $config;
        }

        public function call() {
            $db = array(
                'host'      => $this->config->get()['db']['host'],
                'username'  => $this->config->get()['db']['username'],
                'password'  => $this->config->get()['db']['password']
            );

            $mysqli = new mysqli($db['host'], $db['username'], $db['password']);

            if($mysqli->connect_error) {
                die("Connection to database failed: " . $mysqli->connect_error);
            }

            $mysqli->select_db('invitation');

            return $mysqli;
        }
    }