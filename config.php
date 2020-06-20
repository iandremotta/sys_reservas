<?php

try {
    $pdo = new PDO("mysql:dbname=db_reservas", "root", "root");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
