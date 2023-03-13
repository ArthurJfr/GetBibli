<?php
$textButton = 'Edit Product';
//echo $view->dump($product);
?>
<h1>Edit a Product</h1>
<a class="goback" href="<?php echo $view->path('home-products')?>"><i class="fa-solid fa-arrow-left"></i></a>

<div class="showit">
    <div class="showit_left">
        <h1 class="showit_left_lname"><?php echo $product->title ?></h1>
        <h3 class="showit_left_fname"><?php echo $product->reference ?></h3>
    </div>
    <div class="showit_right">
        <h3>Description</h3>
        <p> <?php echo $product->descri ?></p>
    </div>
</div>
<div class="editform">
 <?php include ('formProducts.php'); ?>
</div>
