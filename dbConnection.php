<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "otss_db";
$db_port = 3306;

// Bağlantı oluşturma
$conn = new mysqli($db_host, $db_user, $db_password, $db_name, $db_port);

// Bağlantı kontrolü
if($conn->connect_error) {
 die("connection failed");
}
?>