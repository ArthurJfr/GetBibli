<?php

namespace App\Controller;

use App\Model\ProductsModel;
use App\Model\SubscribersModel;
use App\Service\Form;
use App\Service\Validation;
use Core\Kernel\AbstractController;


class ProductsController extends AbstractController
{
    public function index(){
        $allProd =  ProductsModel::all();
        $this->render('app.products.index',array(
            'products'=> $allProd
        ),'admin');
    }

    public function addProd(){
        $errors =  [];
        $v = new Validation();

        if (!empty($_POST['submitted'])){
            $post = $this->cleanXss($_POST);
            $errors['title'] = $v->textValid($post['title'],'Title',5,20);
            $errors['reference'] = $v->textValid($post['reference'],'Reference',5,50);
            $errors['descri'] = $v->textValid($post['descri'],'Description',10,300);

            if ($v->IsValid($errors)){
                ProductsModel::insert($post);
                $this->redirect('home-products');
            }
        }

        $form = new Form($errors);
        $this->render('app.products.addProducts',array(
            'form' => $form,
            'errors'=> $errors,
        ),'admin');
    }
    public  function deleteProd($id){
        if (!empty($id)){
            ProductsModel::delete($id);
            $this->redirect('home-products');
        }else{
            $this->redirect('404');
        }
    }
    public function editProd($id){

        $errors = array();
        $product =  ProductsModel::findById($id);

        $form = new Form($errors);
        $v = new Validation();

        if (!empty($_POST['submitted'])){
            $post = $this->cleanXss($_POST);
            $errors['title'] = $v->textValid($post['title'],'Title',3,25);
            $errors['reference'] = $v->textValid($post['reference'],'Reference',5,50);
            $errors['descri'] = $v->textValid($post['descri'],'Description',10,300);

            if ($v->IsValid($errors)){
                ProductsModel::update($id,$post);
                $this->redirect('home-products');
            }
        }

        $this->render('app.products.editProduct',array(
            'product' => $product,
            'form' => $form
        ),'admin');
    }


}