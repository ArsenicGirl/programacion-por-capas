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
        $user = 'root  ';
        $password = '';
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    
        try{
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo "Falló la conexión" . $e->getMessage();
        }
    }


    // Método estático para obtener la instancia de la clase
    public static function getInstance() {
        if(self::$instance === null){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getPDO(){
        return $this->pdo;
    }
}

?>