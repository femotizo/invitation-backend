<?php

    class Token {
        function __construct($mysqli) {
            $this->mysqli = $mysqli;
        }

        public function validate($token) {
            if($findToken = $this->mysqli->call()->query("SELECT access_token FROM token WHERE access_token = '$token'")) {
                if($checkToken = $findToken->fetch_row() > 0) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function getTokenDetails($token) {
            $findTokenOwner     = $this->mysqli->call()->query("SELECT owner_name, owner_address, owner_language FROM token WHERE access_token = '$token'")->fetch_array(MYSQLI_ASSOC);
            $tokenOwner = array(
                'name'      => $findTokenOwner['owner_name'],
                'address'   => $findTokenOwner['owner_address'],
                'language'  => $findTokenOwner['owner_language']
            );
            return $tokenOwner;
        }

        public function updateTokenStatus($token, $status) {
            $this->mysqli->call()->query("UPDATE token SET token_status = '$status' WHERE access_token = '$token'");
        }
    }