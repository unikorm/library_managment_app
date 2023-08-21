<?php

require "config.php";

// Your database connection setup
$servername = $serverNameMy;
$username = $userNameMy;
$password = $passwordMy;
$dbname = $dbNameMy;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};

?>