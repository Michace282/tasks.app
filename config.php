<?
$mysqli = new mysqli('127.0.0.1', 'root', '', 'tasks');
if ($mysqli->connect_errno) {
    echo "Ошибка: Не удалась создать соединение с базой MySQL и вот почему: \n";
    echo "Номер ошибки: " . $mysqli->connect_errno . "\n";
    echo "Ошибка: " . $mysqli->connect_error . "\n";
    exit;
}

?>