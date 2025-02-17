<?php
$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'socialmediawebsite';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
