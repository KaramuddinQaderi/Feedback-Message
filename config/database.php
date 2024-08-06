<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'KQ');
define('DB_PASS', 'KQ58463100@');
define('DB_NAME', 'php_dev');

// CREATE CONNECTION
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// CHECK CONNECTION
if ($conn->connect_errno) {
    die('Connection failed' . $conn->connect_error);
}