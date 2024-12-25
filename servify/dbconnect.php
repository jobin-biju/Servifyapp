<?php
$conn = mysqli_connect("localhost", "root", "", "servify");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>