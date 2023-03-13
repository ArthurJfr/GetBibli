<?php

namespace Core\Kernel;

use Core\Helper\Debugger;
use Core\Service\FlashService;
use Core\Service\Log;

/**
 *
 */
abstract class AbstractController
{
    /**
     * @param string $viewer
     * @param array $variable
     * @param string $layout
     * @return void
     */
    protected function render(string $viewer, array $variable = [], string  $layout = 'base')
    {
        $view = new View();
        ob_start();
        extract($variable);
        require $this->getViewPath().str_replace('.','/',$viewer).'.php';
        $content = ob_get_clean();
        require $this->getViewPath().'layout/'.$layout.'.php';
        die();
    }

    /**
     * @param string $viewer
     * @param array $variable
     * @return false|string
     */
    protected function renderView(string $viewer, array $variable = [])
    {
        $view = new View();
        ob_start();
        extract($variable);
        require $this->getViewPath().str_replace('.','/',$viewer).'.php';
        $content = ob_get_clean();
        return $content;
    }

    /**
     * @return string
     */
    private function getViewPath() : string
    {
        return __DIR__ . '/../../template/';
    }

    /**
     * @return void
     */
    protected function Abort403()
    {
        header('HTTP/1.0 403 Forbidden');
        $this->redirect('403');
    }

    /**
     * @return void
     */
    protected function Abort404()
    {
        header('HTTP/1.0 404 Not Found');
        $this->redirect('404');
    }

    /**
     * print_r coké
     * @param  mixed $var La variable a déboger
     */
    protected function dump($var)
    {
        Debugger::debug($var);
    }

    /**
     * Retourne une réponse JSON au client
     * @param mixed $data Les données à retourner
     * @return les données au format json
     */
    protected function showJson(array $data)
    {
        header('Content-type: application/json');
        $json = json_encode($data, JSON_PRETTY_PRINT);
        if($json){
            die($json);
        }
        else {
            die('Error in json encoding');
        }
    }

    /**
     * @param array $post
     * @return array
     */
    protected function cleanXss(array $post) : array {
        foreach($post as $k=>$v) {
            $post[$k] = trim(strip_tags($v)); //protection 1 XSS
        }
        return $post;
    }

    /**
     * @param $url
     * @param $args
     * @return void
     */
    protected function redirect($url, $args = array())
    {
        $view = new View();
        if(!empty($args)) {
            $realurl = $view->path($url,$args);
        } else {
            $realurl = $view->path($url);
        }
        header('Location: '.$realurl);
        die();
    }

    /**
     * @param string $type
     * @param string $message
     * @return void
     */
    protected function addFlash(string $type, string $message) : void
    {
        $flash = new FlashService();
        $flash->setFlash($type, $message);
    }

    /**
     * @param string $message
     * @return void
     */
    protected function addLog(string $message) : void {
        $logger = new Log();
        $logger->logWrite($message);
    }
}
