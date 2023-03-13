<?php

namespace App\Controller;

use Core\Kernel\AbstractController;

/**
 *
 */
class DefaultController extends AbstractController
{
    public function index()
    {
        $message = '';
        //$this->dump($message);
        $this->render('app.default.home',array(
            'message' => $message,
        ),'base');
    }



    /**
     * Ne pas enlever
     */
    public function Page404()
    {
        $this->render('app.default.404',array(),'base');
    }
}
