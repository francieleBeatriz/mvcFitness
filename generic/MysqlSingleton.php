<?php
namespace generic;

use PDO;

class MysqlSingleton{
    private static $instance = null;

    private $conexao = null;

    private function __construct(){
        $host = getenv('DB_HOST') ?: 'localhost';
        $dbname = getenv('DB_NAME') ?: 'fitness';
        $usuario = getenv('DB_USER') ?: 'root';
        $senha = getenv('DB_PASS') ?: '';

        $dsn = "mysql:host=$host;dbname=$dbname";

        if($this->conexao == null){
            $this->conexao = new PDO($dsn, $usuario, $senha);
        }
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new MysqlSingleton();
        }

        return self::$instance;
    }

    public function executar($query, $param = array()) {
        if ($this->conexao) {
            $sth = $this->conexao->prepare($query);
            foreach ($param as $k => $v) {
                $sth->bindValue($k, $v);
            }
    
            $executou = $sth->execute();
    
            // Detecta se é SELECT ou outra operação
            if (stripos(trim($query), 'select') === 0) {
                return $sth->fetchAll(PDO::FETCH_ASSOC);
            }
    
            // Para INSERT/UPDATE/DELETE, retorna true se executou com sucesso
            return $executou;
        }
    
        return false;
    }
    
}