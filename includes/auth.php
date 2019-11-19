<?
require ("./classes/auth.class.php");
$auth = new Auth_sess(); 
if (isset($_GET["exit"]) && $_GET["exit"] == 1) { 
    header("Location: ?exit=0");
    $auth->_exit(); 
}
if (isset($_POST["login"]) && isset($_POST["password"])) { 
 if (!$auth->auth($_POST["login"], $_POST["password"])) {
        echo '<div class="alert alert-danger" role="alert">
                Неправильный пароль или логин!</div>
              <div class="alert alert-info" role="alert">
              Пожалуйста введите корректно логин и пароль!</div>';
 }
}
?>