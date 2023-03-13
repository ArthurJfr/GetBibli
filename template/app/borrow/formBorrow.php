<form action="" class="addsub_form" method="post">
<?php //echo $view->dump($allprod);?>
<?php //echo $view->dump($allsub);?>

<?php echo $form->label('Product') ?>
<?php echo $form->selectEntity('product',$allprod,'title')?>

<?php echo $form->label('Subscriber') ?>
<?php echo $form->selectEntity('subscriber',$allsub,'lname')?>



<?php echo $form->label('Date End') ?>
<?php echo $form->input('date_end','date')?>
<?php echo $form->error('date_end')?>


        <?php echo $form->submit('submitted', $textButton); ?>
</form>