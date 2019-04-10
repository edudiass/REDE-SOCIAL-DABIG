<?php
ob_start();//liga o output buffering
//session_start();


$con = mysqli_connect("localhost", "root", "", "social");
mysqli_set_charset($con, "utf8");

if (mysqli_connect_errno()) {
	echo "Failed to connect: " . mysqli_connect_errno();
}