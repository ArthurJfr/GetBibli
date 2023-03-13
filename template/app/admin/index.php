<h1>Home</h1>
<?php
//echo $view->dump($_SESSION);
 if (!empty($_SESSION)){ ?>
    <a class="login_btn" href="<?php echo $view->path('logout') ?>">Logout</a>
<?php }else{ ?>
<a class="login_btn" href="<?php echo $view->path('login') ?>">Login</a>
<a class="register_btn" href="<?php echo $view->path('register') ?>">Register</a>
<?php } ?>