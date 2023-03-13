<?php

namespace App\Controller;


use App\Model\BorrowModel;
use App\Model\ProductsModel;
use App\Model\SubscribersModel;
use App\Service\Form;
use App\Service\Validation;
use Core\Kernel\AbstractController;


class BorrowController extends AbstractController
{
    public function index()
    {
        $tablepdt = 'products';
        $allBorrows = BorrowModel::getAll();
        $expiry = array();
        for ($i = 0; $i < count($allBorrows); $i++){
            if ($allBorrows[$i]->date_end[$i] >= time()){
                $exp[$i] = $allBorrows[$i];
                if (!empty($exp[$i])){
                    $expiry[$i] = $exp[$i];
                }
            }
        }

        $this->render('app.borrow.index', array(
            'borrows' => $allBorrows,
            'expiry' => $expiry ,

        ), 'admin');
    }
    public function addBorrow(){
        $errors =  [];
        $v = new Validation();
        $allSub = SubscribersModel::all();
        $allProd = ProductsModel::all();

        if (!empty($_POST['submitted'])){
            $post = $this->cleanXss($_POST);



            if ($v->IsValid($errors)){
                BorrowModel::insert($post);
                // $this->redirect('home-products');
            }
        }

        $form = new Form($errors);
        $this->render('app.borrow.addBorrow',array(
            'allsub' => $allSub,
            'allprod' => $allProd,
            'form' => $form,
            'errors'=> $errors,
        ),'admin');
    }
    public function editBorrow($id){
        $allSub = SubscribersModel::all();
        $allProd = ProductsModel::all();
        $errors = array();
        $form = new Form($errors);
        $borrows = BorrowModel::findById($id);
        $this->render('app.borrow.editBorrow',array(
            'borrow' => $borrows,
            'form' => $form,
            'errors'=> $errors,
             'allsub' => $allSub,
            'allprod' => $allProd
        ),'admin');
    }






    public  function deleteProd($id){
        if (!empty($id)){
            BorrowModel::delete($id);
            $this->redirect('home-products');
        }else{
            $this->redirect('404');
        }
    }
}