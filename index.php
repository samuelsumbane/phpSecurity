<?php

include "src/dbConfig.php";
// // Exemplo de uso da classe
// $databaseHandler = $databaseCreator;
$databaseHandler = new DatabaseCreator();


// Recuperar todos os registros
$records = $databaseHandler->getAll("users");



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Security App</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    

    <main>
        <header>
            <h2></h2>
            <!-- <button>Add User</button> --> 
            <!-- this button can be used to open the modal -->
        </header>
        <div class="">
            <table>
                <thead>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
                </thead>
                <tbody>
                    <?php
                        foreach ($records as $record) {
                            ?>
                            <tr>
                                <td><?php echo $record['name'] ?></td>
                                <td><?php echo $record['uname'] ?></td>
                                <td><?php echo $record['pass'] ?></td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>

            </table>
        </div>
    </main>

    <br/>
    <div class="modal"> <!-- you can add style -->
        <header class="modalheader">
            Add User
        </header>
        <main class="modalmain">
            <form method="post" action="src/userCrud.php" >
                <div>
                    <label for="">Name</label>
                    <input type="text" name="name" id="name">
                </div>

                <div>
                    <label for="">User Name</label>
                    <input type="text" name="username" id="username">
                </div>
                
                <div>
                    <label for="">Password</label>
                    <input type="text" name="password" id="password">
                </div>

                <input type="submit" value="Submeter">
            </form>
        </main>
    </div>


</body>
</html>

