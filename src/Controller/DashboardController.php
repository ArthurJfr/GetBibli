<?php

namespace App\Controller;

use Core\Kernel\AbstractController;
use App\Service\Security;

class DashboardController extends AbstractController
{
    public function index(){
       $security = new Security();
       $security->addSecurePage('dashboard');
        $this->render('app.dashboard.index',array(
'security'=>$security
        ),'admin');
    }
}