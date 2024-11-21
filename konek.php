<?php

$serverName = "LAPTOP-K0OT1TN6"; 
$database = "PrakwebDB";
$username = ""; 
$password = ""; 

try {
 
    $dsn = "sqlsrv:Server=$serverName;Database=$database";
    $conn = new PDO($dsn, $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Koneksi berhasil!";
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}


?>