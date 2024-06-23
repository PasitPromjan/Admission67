<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=wattanai_ad67normal", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//, PDO::SQLSRV_ENCODING_UTF8);
	 $conn->exec("set names utf8");
//	$conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
        // echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


    try {
        $pdo = new PDO("mysql:host=$servername;dbname=wattanai_ad67normal", $username, $password);
        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//, PDO::SQLSRV_ENCODING_UTF8);
	 $pdo->exec("set names utf8");
//	$conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
        // echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


    $info = array(
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'dbname' => 'wattanai_ad67normal'
    );
    $connn = mysqli_connect($info['host'], $info['user'], $info['password'], $info['dbname']) or die('Error connection database!');
    mysqli_set_charset($connn, 'utf8');
?>