
<?php 
class ConexaoBD {
    private $serverName = "localhost"; 
    private $userName = "root"; 
    private $password = "admin";   // sua senha do MySQL
    private $dbName = "projeto_final";
    private $port = 3308;          // porta correta do seu MySQL

    public function conectar() {
        $conn = new mysqli(
            $this->serverName, 
            $this->userName, 
            $this->password, 
            $this->dbName, 
            $this->port
        );

        // Verificar se houve erro na conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        return $conn;
    }
}
?>