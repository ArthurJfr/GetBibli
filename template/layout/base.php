<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GetBibli</title>
    <?php echo $view->add_webpack_style('app'); ?>
</head>
<body>
<?php // $view->dump($view->getFlash()) ?>
<header id="masthead">
    <div class="wrap">


        <nav class="nav">
            <ul class="nav__left">
            <li><a class="nav__a" href="<?= $view->path(''); ?>">Home</a></li>
            </ul>
            <ul class="nav__mid">
                <li><a class="nav__a" href="<?= $view->path(''); ?>"><h1 class="nav__title">GetBibli</h1></a></li>
                <li class="nav__underline_title"></li>
            </ul>
            <ul class="nav__right">
                <li><a class="nav__a"  href="<?= $view->path(''); ?>">Borrow</a></li>
            </ul>

        </nav>

    </div>
</header>

<div class="wrap">
    <div class="container">
        <?= $content; ?>
    </div>
</div>

    <footer id="colophon">


        <div class="wrap footer">
            <div class="footer__line"></div>
            <div class="footer_content">
                <div class="footer__left">
                    <a href=""></a>
                    <a href=""></a>
                    <a href=""></a>
                </div>
                <div class="footer__mid"></div>
                <div class="footer__right"></div>
            </div>

        </div>

    </footer>

<?php echo $view->add_webpack_script('app'); ?>
</body>
</html>
