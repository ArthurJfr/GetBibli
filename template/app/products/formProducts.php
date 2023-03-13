<form action="" class="addsub_form" method="post">
<div class="lname">
    <?php echo $form->label('Titre'); ?>
    <?php echo $form->input('title','text' ) ?>
    <?php echo $form->error('title'); ?>
</div>
<div class="fname">
    <?php echo $form->label('Reference'); ?>
    <?php echo $form->input('reference','text') ?>
    <?php echo $form->error('reference'); ?>
</div>
<div class="email">
    <?php echo $form->label('Description'); ?>
    <?php echo $form->textarea('descri'); ?>
    <?php echo $form->error('descri'); ?>
</div>


<div class="submit">
    <?php echo $form->submit('submitted', $textButton); ?>
</div>
</form>