<?php

$servername = "localhost";
$username = "test";
$password = "1234";
$dbname = "test_bd";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
