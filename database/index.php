<?php
$host     = "localhost";
$username = "root";
$password = "";
$database = "aplikasi ticketing pesawat dan kereta api";

$koneksi = new mysqli($host, $username, $password, $database);
if($koneksi){
echo "database konek";
}else{
    echo "database tidak konek";
}
?>