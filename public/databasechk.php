<?php
$string = file_get_contents($_SERVER['DOCUMENT_ROOT']."/setting.json");
$json = json_decode($string, true);
$con = mysqli_connect($json['database']["database_host"],$json['database']["database_username"],$json['database']["database_password"],$json['database']["database_name"]);
$sql = "INSERT INTO user (emailid)
VALUES ('john@example.com')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>