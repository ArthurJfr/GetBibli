<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>GetBibli</title>
    <?php echo $view->add_webpack_style('admin'); ?>
</head>
<body>
<?php // $view->dump($view->getFlash()) ?>
<div class="bodywrap">
    <aside id="masthead">

        <ul class="nav">
            <li class="nav__li"><a class="nav__h" href="<?= $view->path('home'); ?>"><h1 class="nav__title">GetBibli</h1></a>
                <div class="nav__underline"></div></li>


            <li class="nav__li"><a class="nav__a" href="<?= $view->path('home'); ?>">Home</a></li>


            <li class="nav__li"><a class="nav__a"  href="<?= $view->path('home-borrow'); ?>">Borrows</a></li>



            <li class="nav__li"><a class="nav__a"  href="<?= $view->path('home-products'); ?>">Products</a></li>

            <li class="nav__li"><a class="nav__a"  href="<?= $view->path('home-sub'); ?>">Subscribers</a></li>

            <?php if (!empty($_SESSION)){ ?>

                <li class="nav__li"><a class="nav__a"  href="<?= $view->path('logout'); ?>">Log Out</a></li>


            <?php }else{ ?>
                <li class="nav__li"><a class="nav__a"  href="<?= $view->path('login'); ?>">Log In</a></li>
                <li class="nav__li"><a class="nav__a"  href="<?= $view->path('register'); ?>">Register</a></li>

            <?php }
            if (!empty($_SESSION)){
            if ($_SESSION['role'] == 'admin'){
            ?>
                <li class="nav__li"><a class="nav__a"  href="<?= $view->path('dashboard'); ?>">Dashboard</a></li>

            <?php }} ?>



        </ul>


    </aside>


    <div class="container">
        <?= $content; ?>
    </div>
</div>


<?php echo $view->add_webpack_script('admin'); ?>
<?php echo $view->add_webpack_script('main'); ?>
<?php echo $view->add_webpack_script('chart'); ?>

</body>
</html>
