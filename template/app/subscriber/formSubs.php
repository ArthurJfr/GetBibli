<form class="addsub_form" action="" method="post" novalidate>
<div class="lname">
    <?php echo $form->label('Nom'); ?>
    <?php echo $form->input('lname','text') ?>
    <?php echo $form->error('lname'); ?>
    </div>
    <div class="fname">
    <?php echo $form->label('Prénom'); ?>
    <?php echo $form->input('fname','text') ?>
    <?php echo $form->error('fname'); ?>
    </div>
    <div class="email">
    <?php echo $form->label('email'); ?>
    <?php echo $form->input('email'); ?>
    <?php echo $form->error('email'); ?>
    </div>
    <div class="age">
    <?php echo $form->label('Age'); ?>
    <?php echo $form->input('age','number'); ?>
    <?php echo $form->error('age'); ?>
    </div>

    <div class="submit">
    <?php echo $form->submit('submitted', $textButton); ?>
    </div>
</form>