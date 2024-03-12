
<?php
class DatabaseCreator {
    private $dbFile;

    // Método construtor
    public function __construct() {
    // public function __construct($dbFilePath) { to informe database file
        // in this case i wont use.
        $minpath = $_SERVER['DOCUMENT_ROOT'];
        // $path = "$minpath/phpSecurityApp/src";

        $this->dbFile = "$minpath/phpSecurityApp/arquivo.db";
        // echo $this->dbFile;
        $this->createDatabase();
    }

    // Método para criar o banco de dados
    private function createDatabase() {
        // Verifica se o arquivo do banco de dados já existe
        if (file_exists($this->dbFile)) {
            // echo "O banco de dados já existe.";
            return;
        }

        // Cria o banco de dados SQLite
        $conn = new SQLite3($this->dbFile);

        // Verifica se ocorreu algum erro na criação
        if (!$conn) {
            die("Erro ao criar o banco de dados: " . $SQLite3->lastErrorMsg());
        } else {
            // echo "Banco de dados criado com sucesso.";
        }

        // Fecha a conexão após a criação do banco de dados
        $conn->close();
    }

    public function createTable($tableName, $columns) {
        $conn = new SQLite3($this->dbFile);

        // Verifica se ocorreu algum erro na conexão
        if (!$conn) {
            die("Erro ao conectar ao banco de dados: " . $SQLite3->lastErrorMsg());
        }

        // Monta a consulta SQL para criar a tabela
        $sql = "CREATE TABLE IF NOT EXISTS $tableName (";
        foreach ($columns as $columnName => $columnType) {
            $sql .= "$columnName $columnType, ";
        }
        $sql = rtrim($sql, ", "); // Remove a vírgula extra no final
        $sql .= ")";

        // Executa a consulta SQL
        if ($conn->exec($sql)) {
            // echo "Tabela $tableName criada com sucesso.";
        } else {
            echo "Erro ao criar a tabela $tableName: " . $conn->lastErrorMsg();
        }

        // Fecha a conexão após criar a tabela
        $conn->close();
    }


    // Método para inserir um novo registro na tabela
    public function insert($tableName, $data) {
        $conn = new SQLite3($this->dbFile);

        // Monta a consulta SQL para inserir dados
        $sql = "INSERT INTO $tableName (";
        $sql .= implode(", ", array_keys($data));
        $sql .= ") VALUES ('";
        $sql .= implode("', '", array_values($data));
        $sql .= "')";

        // Executa a consulta SQL
        if ($conn->exec($sql)) {
            echo "Registro inserido com sucesso.";
        } else {
            echo "Erro ao inserir o registro: " . $conn->lastErrorMsg();
        }

        // Fecha a conexão após inserir o registro
        $conn->close();
    }

    // Método para recuperar todos os registros da tabela
    public function getAll($tableName) {
        $conn = new SQLite3($this->dbFile);

        // Monta a consulta SQL para recuperar todos os registros
        $sql = "SELECT * FROM $tableName";

        // Executa a consulta SQL
        $result = $conn->query($sql);

        // Prepara um array para armazenar os registros
        $records = [];

        // Verifica se a consulta retornou algum resultado
        if ($result) {
            // Percorre os resultados e os armazena no array
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $records[] = $row;
            }
        } else {
            echo "Erro ao recuperar registros: " . $conn->lastErrorMsg();
        }

        // Fecha a conexão após recuperar os registros
        $conn->close();

        return $records;
    }

    // Método para atualizar um registro na tabela
    public function update($tableName, $id, $data) {
        $conn = new SQLite3($this->dbFile);

        // Monta a consulta SQL para atualizar o registro
        $sql = "UPDATE $tableName SET ";
        foreach ($data as $columnName => $value) {
            $sql .= "$columnName = '$value', ";
        }
        $sql = rtrim($sql, ", "); // Remove a vírgula extra no final
        $sql .= " WHERE id = $id";

        // Executa a consulta SQL
        if ($conn->exec($sql)) {
            echo "Registro atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar o registro: " . $conn->lastErrorMsg();
        }

        // Fecha a conexão após atualizar o registro
        $conn->close();
    }

    // Método para excluir um registro da tabela
    public function delete($tableName, $id) {
        $conn = new SQLite3($this->dbFile);

        // Monta a consulta SQL para excluir o registro
        $sql = "DELETE FROM $tableName WHERE id = $id";

        // Executa a consulta SQL
        if ($conn->exec($sql)) {
            echo "Registro excluído com sucesso.";
        } else {
            echo "Erro ao excluir o registro: " . $conn->lastErrorMsg();
        }

        // Fecha a conexão após excluir o registro
        $conn->close();
    }

}

// Exemplo de uso da classe
$databaseCreator = new DatabaseCreator();

// Define o nome e as colunas da tabela
$tableName = "users";
$userColumns = [
    "id" => "INTEGER PRIMARY KEY",
    "name" => "TEXT",
    "uname" => "TEXT",
    "pass" => "TEXT"
];

// Cria a tabela
$databaseCreator->createTable($tableName, $userColumns);


?>
