<?
    class Data {

        public function insert($email, $descr, $perfom) {
            $perf = 0;
            if ($perfom === "on")
                $perf = 1;
            else 
                $perf = 0;
            include("config.php");
            $auth = new Auth_sess(); 
            if ($auth->maybe())
                if ($mysqli->query('INSERT INTO `tasks` (`id`, `email`, `description`, `performance`) VALUES (null, "'.$email.'", "'.$descr.'", "'.$perf .'")'))
                    return true;
                else
                    return false;
        }

        public function update($id, $email, $descr, $perfom) {
            $perf = 0;
            if ($perfom === "on")
                $perf = 1;
            else 
                $perf = 0;
            include("config.php");
            $auth = new Auth_sess(); 
            if ($auth->maybe())
                if ($mysqli->query('UPDATE `tasks` SET `email`="'.$email.'", `description`="'.$descr.'", `performance`="'.$perf.'" WHERE `id`='.$id))
                    return true;
                else
                    return false;
        }

        public function delete($id) {
            include("config.php");
            $auth = new Auth_sess(); 
            if ($auth->maybe())
                if ($mysqli->query('DELETE FROM `tasks` WHERE `id`="'.$id.'"'))
                    return true;
                else
                    return false;
        }  
    }
?>
