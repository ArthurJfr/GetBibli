<form class="addsub_form" action="" method="post" novalidate>
    <div class="email">
        <?php echo $form->label('email'); ?>
        <?php echo $form->input('email','email') ?>
        <?php echo $form->error('email'); ?>
    </div>
    <div class="password">
        <?php echo $form->label('password'); ?>
        <?php echo $form->input('password','password') ?>
        <?php echo $form->error('password'); ?>
    </div>
    <div class="password2">
        <?php echo $form->label('confirm password'); ?>
        <?php echo $form->input('password2','password') ?>
        <?php echo $form->error('password2'); ?>
    </div>


    <div class="submit">
        <?php echo $form->submit('submitted', $textButton); ?>
    </div>
</form>