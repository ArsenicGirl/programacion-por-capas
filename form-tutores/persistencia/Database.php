<?php
//Es el Singleton

class Database{
    private static $instance = null; //para llamarla desde cualquier parte del programa como singleton
    //pdo para la conexion
    private $pdo;

    private function __construct()
    {
        $host = 'localhost';
        $dbname = 'tallercamphouse';
        $user = 'root';
        $password = '';
        $port = 3307;//quitar especificacion del puerto en otros pc
        
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";//$dsn = "mysql:host=$host;dbname=$db;charset=utf8";
        
        try {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Falló la conexión: " . $e->getMessage();
        }
    }

   
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getPDO() {
        return $this->pdo;
    }
}
?>