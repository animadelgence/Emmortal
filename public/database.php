<?php 
ini_set("display_errors", "1");
error_reporting(E_ALL);
$string = file_get_contents($_SERVER['DOCUMENT_ROOT']."/setting.json");
$json = json_decode($string, true);
$link = mysqli_connect($json['database']["database_host"], $json['database']["database_username"], $json['database']["database_password"], $json['database']["database_name"]);
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;
?>
