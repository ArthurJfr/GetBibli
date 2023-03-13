<?php

namespace App\Controller;

use App\Service\Form;
use Core\Kernel\AbstractController;

/**
 *
 */
class AdminController extends AbstractController
{
    public function index()
    {
        $message = '';
        //$this->dump($message);
        $this->render('app.admin.index',array(
            'message' => $message,
        ),'admin');
    }
    public function addBorrow(){
        $errors = [];
        $form = new Form($errors);
        $this->render('app.admin.addBorrow',array(
            'form' => $form
        ),'admin');
    }



    /**
     * Ne pas enlever
     */
    public function Page404()
    {
        $this->render('app.default.404',array(),'admin');
    }
}
