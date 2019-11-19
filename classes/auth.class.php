<?
    class Auth_sess {
        private $_login = "admin"; 
        private $_password = "123";
        public function maybe() {
            if (isset($_SESSION["auth"])) {
                return $_SESSION["auth"]; 
            }
            else return false;
        }

        public function auth($login, $password) {
            if ($login == $this->_login && $password == $this->_password) {
                $_SESSION["auth"] = true;
                $_SESSION["login"] = $login;
                return true;
            }
            else { 
                $_SESSION["auth"] = false;
                return false;
            }
        }

        public function give_login() {
            if ($this->maybe()) { 
                return $_SESSION["login"];
            }
        }
        
        public function _exit() {
            $_SESSION = array(); 
            session_destroy(); 
        }
    }

?>
