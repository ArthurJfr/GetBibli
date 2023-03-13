<?php
namespace Core\Kernel;
/**
 * SINGLETON permet de récupere une instance sur l'ensemble de l'application est une seule fois
 * m'envoie tjrs la meme instance
 */
class Config
{
    /**
     * @var mixed
     */
    private $settings = array();

    /**
     * @var
     */
    private static $_instance;

    /**
     *
     */
    public function __construct()
    {
        $this->settings = require dirname(__DIR__) . '/../config/config.php';
    }

    /**
     * @return Config
     */
    public static function getInstance()
    {
        if(is_null(self::$_instance)) {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        if(!isset($this->settings[$key])){
            return null;
        }
        return $this->settings[$key];
    }
}
