<?php
$textButton = 'Edit Subscriber';
//echo $view->dump($subscriber);
?>
<h1>Edit a Subscriber</h1>
<a class="goback" href="<?php echo $view->path('home-sub')?>" ><i class="fa-solid fa-arrow-left"></i></a>

<div class="showit">
    <div class="showit_left">
        <h2 class="showit_left_lname"><?php echo $subscriber->lname ?></h2>
        <h3 class="showit_left_fname"><?php echo $subscriber->fname ?></h3>
    </div>
    <div class="showit_right">
        <p>Email : <?php echo $subscriber->email ?></p>
        <p>Age : <?php echo $subscriber->age ?></p>
    </div>
</div>

<div class="editform">
    <form class="addsub_form" action="" method="post">
        <div class="lname">
            <?php echo $form->label('Nom'); ?>
            <?php echo $form->input('lname','text', $subscriber->lname) ?>
            <?php echo $form->error('lname'); ?>
        </div>
        <div class="fname">
            <?php echo $form->label('Prénom'); ?>
            <?php echo $form->input('fname','text',$subscriber->fname) ?>
            <?php echo $form->error('fname'); ?>
        </div>
        <div class="email">
            <?php echo $form->label('email'); ?>
            <?php echo $form->input('email',$subscriber->email); ?>
            <?php echo $form->error('email'); ?>
        </div>
        <div class="age">
            <?php echo $form->label('Age'); ?>
            <?php echo $form->input('age','number',$subscriber->age); ?>
            <?php echo $form->error('age'); ?>
        </div>

        <div class="submit">
            <?php echo $form->submit('submitted', $textButton); ?>
        </div>
    </form>
 </div>
