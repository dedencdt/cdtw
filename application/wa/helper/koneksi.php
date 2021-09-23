<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "wa_anto";

$koneksi = mysqli_connect($host, $username, $password, $db) or die("GAGAL");

$base_url = "http://localhost/wa_anto/";
date_default_timezone_set('Asia/Jakarta');
