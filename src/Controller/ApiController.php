<?php
 namespace App\controller;

 use Core\Kernel\AbstractController;

 class ApiController extends AbstractController{
     public function index(){
     $data=    array('michel','jean');
     return $this->showJson($data);
     }
 }