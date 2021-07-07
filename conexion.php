<?php
$link = "mysql:host=localhost;dbname=proyecto";
$usuario = "root";
$pass = "";

try {
    $pdo = new PDO($link, $usuario, $pass);
    /*echo "CONECTADO A LA BASE DE DATOS";
    foreach ($pdo->query('SELECT * FROM `accounts`') as $row) {
        print_r($row);
    }*/
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}