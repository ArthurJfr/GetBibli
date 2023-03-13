<?php

namespace App\Controller;

use App\Model\SubscribersModel;
use App\Service\Form;
use App\Service\Validation;
use Core\Kernel\AbstractController;

/**
 *
 */
class SubscriberController extends AbstractController
{
    public function index(){
        $allSubs =  SubscribersModel::all();
        $this->render('app.subscriber.index',array(
            'subscribers'=> $allSubs
        ),'admin');
    }
    public function addSub(){
        $errors =  [];
        $v = new Validation();
        if (!empty($_POST['submitted'])){
            $post = $this->cleanXss($_POST);
            $errors['email'] = $v->emailValid($post['email']);
            $errors['fname'] = $v->textValid($post['fname'],'Prénom',2,20);
            $errors['lname'] = $v->textValid($post['lname'],'Nom',2,20);
            if ($post['age'] > 120){
                $errors['age'] = 'Age trop élevé';
            }
            if ($v->IsValid($errors)){
                SubscribersModel::insert($post);
                $this->redirect('home-sub');
            }

        }


        $form = new Form($errors);
        $this->render('app.subscriber.addSubs',array(
            'form' => $form,
            'errors'=> $errors,
        ),'admin');
    }
    public  function deleteSub($id){
        if (!empty($id)){
            SubscribersModel::delete($id);
            $this->redirect('home-sub');
        }else{
            $this->redirect('404');
        }
    }
    public function editSub($id){
        $errors = array();
      $subscriber =  SubscribersModel::findById($id);
      $form = new Form($errors);

        $v = new Validation();
        if (!empty($_POST['submitted'])){
            $post = $this->cleanXss($_POST);
            $errors['email'] = $v->emailValid($post['email']);
            $errors['fname'] = $v->textValid($post['fname'],'Prénom',2,20);
            $errors['lname'] = $v->textValid($post['lname'],'Nom',2,20);
            if ($post['age'] > 120){
                $errors['age'] = 'Age trop élevé';
            }
            if ($v->IsValid($errors)){

                SubscribersModel::update($id,$post);
//                $this->redirect('home-sub');
            }

        }

        $this->render('app.subscriber.editSubs',array(
            'subscriber' => $subscriber,
            'form' => $form
        ),'admin');
    }

}