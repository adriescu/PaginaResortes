<?php

    // $server = 'localhost:3306';
    // $username = 'root';
    // $password = '';
    // $database = 'php_login_database';

    // try {
    //     $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    // } catch (PDOException $e) {
    //     die('Connection Failed: ' . $e->getMessage());
    // }
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "php_login_database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

?>