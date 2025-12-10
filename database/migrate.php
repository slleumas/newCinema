<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$sqlFile = 'schema.sql';

//create a new pdo connection

echo "Connecting to the database server...\n";



try {
    //create connection not specifying the database name
    $pdo = new PDO('mysql:host=', $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "Connected successfully.\n";
    echo "Do you wnat to create the database ande tables? (y/n): ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    if (trim($line) === 'y') {
        //READ SQL FILE
        $sql = file_get_contents($sqlFile);
        echo "Creating database and tables...";
        //execute the sql file
        $pdo->exec($sql);
        echo "database and table created sucessfully.";
        exit;
    } else {
        echo "Operation cancelled.\n";
        exit;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
