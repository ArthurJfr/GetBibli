<?php

namespace Core\Kernel;

use App\Service\AbstractView;
use Core\Helper\Debugger;
use Core\Service\FlashService;

/**
 *  class View
 *  Helper pour les templates
 */
class View extends AbstractView
{
    /**
     * @var mixed|null
     */
    private $version;

    /**
     *
     */
    public function __construct()
    {
        $this->version = (new Config())->get('version');
    }
    /**
     * @param $link
     * @param $id null
     * @return $data
     */
    public function path(string $link, array $tabs = array()) : string
    {
        if(empty($tabs)) {
            $data = $this->urlBase().$link;
        } else {
            $linkarg = '';
            foreach($tabs as $tab){
                $linkarg .= $tab.'/';
            }
            $data = $this->urlBase().$link.'/'.$linkarg;
        }
        return $data;
    }

    /**
     * @return string
     */
    public function urlBase() : string
    {
        $directory = '/';
        return 'http://'.$_SERVER['HTTP_HOST'] .$directory;
    }

    /**
     * @param string $file
     * @return string
     */
    public function asset(string $file) : string
    {
        return $this->urlBase(). 'asset/'.$file;
    }

    /**
     * @param string $name
     * @return string
     */
    public function add_webpack_style(string $name) : string
    {
        return '<link rel="stylesheet" type="text/css" href="'.$this->urlBase(). 'dist/css/style-'.$name.'.bundle.css?version='.$this->version.'">';
    }

    /**
     * @param string $name
     * @return string
     */
    public function add_webpack_script(string $name) : string
    {
        return '<script src="'.$this->urlBase(). 'dist/js/'.$name.'.bundle.js?version='.$this->version.'"></script>';
    }

    /**
     * @return array
     */
    public function getFlash()
    {
        return FlashService::flash();
    }

    /**
     * @param $var
     * @return void
     */
    public function dump($var)
    {
        Debugger::debug($var);
    }

    /**
     * @param $controller
     * @param $method
     * @param $arguments
     * @return mixed|void
     */
    public function controller($controller, $method, $arguments = array())
    {
        if (class_exists($controller)) {
            $instance = new $controller();
            if (method_exists($controller, $method)) {
                if (count($arguments) == 0) {
                    return $instance->$method();
                } elseif (count($arguments) == 1) {
                    return $instance->$method($arguments[0]);
                } elseif (count($arguments) == 2) {
                    return $instance->$method($arguments[0], $arguments[1]);
                } elseif (count($arguments) == 3) {
                    return $instance->$method($arguments[0], $arguments[1], $arguments[2]);
                } elseif (count($arguments) == 4) {
                    return $instance->$method($arguments[0], $arguments[1], $arguments[2],$arguments[3]);
                } else {
                    die('Error: max 4 arguments');
                }
            }
            else {
                die('error: Method not exist');
            }
        } else {
            die('error: Controller not exist');
        }
    }
}
