<?php
namespace Core\Kernel;
use \PDO;

/**
 * Class Autoloader
 * @package Tutoriel
 */
class Database {

    /**
     * @var mixed|null
     */
    private $bd_name;
    /**
     * @var mixed|string
     */
    private $bd_user;
    /**
     * @var mixed|string
     */
    private $bd_pass;
    /**
     * @var mixed|string
     */
    private $bd_host;

    /**
     * @var
     */
    private $pdo;


    /**
     * @param string $bd_name
     * @param string $bd_user
     * @param string $bd_pass
     * @param string $bd_host
     */
    public function __construct(string $bd_name, string $bd_user = 'root', string $bd_pass = 'root', string $bd_host="localhost")
    {
        if(!empty($bd_name)) {
            $this->bd_name = $bd_name;
        } else {
            $config = new Config();
            $this->bd_name = $config->get('db_name');
        }

        $this->bd_user = $bd_user;
        $this->bd_pass = $bd_pass;
        $this->bd_host = $bd_host;
    }

    /**
     * @return PDO
     */
    private function getPdo()
    {
        if($this->pdo === null) {
            try {
                $pdo = new PDO('mysql:host='.$this->bd_host.';dbname='.$this->bd_name, $this->bd_user, $this->bd_pass, array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
                ));
            }
            catch (\PDOException $e) {
                echo 'Erreur de connexion : ' . $e->getMessage();
            }
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    /**
     * @param $sql
     * @param $className
     * @return array|false
     */
    public function query($sql, $className)
    {
        $query = $this->getPdo()->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS,$className);
    }

    /**
     * @param $sql
     * @param array $bind
     * @return mixed
     */
    public function aggregation($sql, array $bind = array())
    {
        $query = $this->getPdo()->prepare($sql);
        $query->execute($bind);
        return $query->fetchColumn();
    }

    /**
     * @param $sql
     * @param $bind
     * @param $className
     * @param $one
     * @return array|false|mixed
     */
    public function prepare($sql, $bind, $className, $one = false)
    {
        $query = $this->getPdo()->prepare($sql);
        $query->execute($bind);
        $query->setFetchMode(PDO::FETCH_CLASS,$className);
        if($one) {
            return $query->fetch();
        } else {
            return $query->fetchAll();
        }
    }

    /**
     * @param $sql
     * @param $bind
     * @return void
     */
    public function prepareInsert($sql, $bind)
    {
        $query = $this->getPdo()->prepare($sql);
        $query->execute($bind);
    }
}
