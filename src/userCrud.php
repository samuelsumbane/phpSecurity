<?php

include "dbConfig.php";
// // Exemplo de uso da classe
// $databaseHandler = $databaseCreator;
// $dbFilePath = '../src/arquivo.db';
$databaseHandler = new DatabaseCreator();


if(isset($_POST['username']) && isset($_POST['password'])){
    // $name = $_POST['name'];
    // $uname = $_POST['username'];
    // $pass = $_POST['password'];

    $data = [
        "name" => $_POST['name'],
        "uname" => $_POST['username'],
        "pass" => $_POST['password']
    ];

    $databaseHandler->insert("users", $data);
    header("location:../index.php");


}



// // To update
// $idToUpdate = 1;
// $dataToUpdate = [
//     "nome" => "Maria",
//     "email" => "maria@example.com"
// ];
// $databaseHandler->update("users", $idToUpdate, $dataToUpdate);


// // To delete
// $idToDelete = 2;
// $databaseHandler->delete("users", $idToDelete);


