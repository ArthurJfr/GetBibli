<?php

namespace App\Service;


use App\Model\UserModel;
use Core\App;
use Core\Kernel\AbstractController;
use Core\Kernel\View;

class Security
{

    // si islog false => redirection


    public function getUser(){
        if (!empty($_SESSION)){
            if (!empty($_SESSION['id']))
            $data= UserModel::findByColumn('id',$_SESSION['id']);


            return $data;

        }else return 'nobody connected';

    }
    private function redirection($page){
        $directory = '/';
        $data =  'http://'.$_SERVER['HTTP_HOST'] .$directory;
        return header('Location:'.$data.$page );
    }
public function isLog(){
        if (!empty($_SESSION)){
            return true;
        }else{
            return false;
        }
}

    public  function addSecurePage($curentPageMethod,$keyrole = 'role'){


        require ('../../../mvcExo1/mvc6/config/secure-pages.php');

        for ($i = 0; $i < count($page);$i++){
            $curPage = $page[$i][0] ;
            if (!empty($_SESSION)){

                    $role = $page[$i][1];
                    $pagetoR = $page[$i][2];
                    if ($curPage == $curentPageMethod){
                        if (!empty($_SESSION[$keyrole])){
                            if ($_SESSION[$keyrole] == $role){
                                $this->redirection($pagetoR);
                            }
                        }
                    }
                }
            elseif ($page[$i][1] == 'all' && $curPage == $curentPageMethod){

                 $this->redirection('home');
            }
        }
    }
}