<?php //echo $view->dump($_POST)?>
<h1>Add a Borrow</h1>
<a class="goback" href="<?php echo $view->path('home-borrow')?>"><i class="fa-solid fa-arrow-left"></i></a>
<div class="add">

    <div class="add__right">
<?php $textButton = 'Ajouter'; include('formBorrow.php'); ?>
    </div>

</div>