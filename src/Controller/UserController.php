<?php

namespace App\Controller;

use App\Service\Form;
use App\Service\Validation;
use Core\Kernel\AbstractController;
use App\Service\Security;
use App\Model\UserModel;
use http\Client\Curl\User;

class UserController extends AbstractController
{

    public function login(){
        $sec = new Security();
       $sec->addSecurePage('login');
        $myUser = $sec->getUser();

        $errors = array();
        $v = new Validation();
        if (!empty($_POST['submitted'])){

            $post = $this->cleanXss($_POST);
            $errors['email'] = $v->emailValid($post['email']);
            $exist =  UserModel::findByColumn('email',$post['email']);
           if (empty($exist)){
               $errors['email'] = 'Email incorrect';
           }
            $errors['password'] = $v->textValid($post['password'],'mot de passe',3,25);
           $pass = hash('md5',$post['password']);
           if (password_verify($post['password'],$exist->password)){
               $errors['password'] = 'Mot de passe incorrect';
           }



            if ($v->IsValid($errors)){
//                die('connected');
                $_SESSION['email'] = $exist->email;
                $_SESSION['id'] = $exist->id;
                $_SESSION['role'] = $exist->role;
                $_SESSION['token'] = $exist->token;
                $this->redirect('home');

            }

        }


        $form = new Form($errors);
        $this->render('app.users.login',array(
            'form' => $form,
            'sec'=>$sec,
            'user'=> $myUser
        ),'admin');
    }






    public function register(){
        $errors = array();
        $v = new Validation();
        $secu = new Security();
        $secu->addSecurePage('register');





        if (!empty($_POST['submitted'])){

            $post = $this->cleanXss($_POST);
            $errors['email'] = $v->emailValid($post['email']);
          $exist =  UserModel::findByColumn('email',$post['email']);
          if (!empty($exist)){
              $errors['email'] = 'Un compte déjà existant possède cet email';
          }

            $errors['password'] = $v->textValid($post['password'],'mot de passe',3,25);
            $errors['password2'] = $v->textValid($post['password2'],'mot de passe',3,25);
            if ($post['password'] !== $post['password2']){
                $errors['password2'] = 'Vos mots de passes de sont pas identiques';
            }
            $role = 'user';
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $token = '';
            for ($i = 0; $i < $charactersLength; $i++) {
                $token .= $characters[random_int(0, $charactersLength - 1)];
            }

            if ($v->IsValid($errors)){
                $password = hash('md5',$post['password']);
                UserModel::insert($post,$password,$token,$role);
                $this->redirect('login');
            }
        }


        $form = new Form($errors);
        $this->render('app.users.register',array(
            'form' => $form,


        ),'admin');
    }
    public function logout(){
        session_destroy();

        $this->redirect('home');
    }
}