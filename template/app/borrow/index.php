<h1>Borrows</h1>

<a class="add_btn" href="<?php echo $view->path('add-borrow')?>"> + Ajouter</a>
<?php


//echo $view->dump($expiry);

?>


<section id="borrow" class="borrows">
    <div class="wrap_borrow">
        <div class="borrows_left">
            <h1>Last Borrows in progress</h1>
            <?php for ($i = 0;$i < count($borrows);$i++){ ?>
            <div class="borrows_left_one">
                <div class="borrows_left_one_infos">
                <h3>Name :  <?php echo $borrows[$i]->lname?></h3>
                <p>Product :  <?php echo $borrows[$i]->title?></p>
                <p>Reference :  <?php echo $borrows[$i]->reference?></p>
                </div>

                <div class="borrows_left_one_date">
                    <div class="date">
                    <p>Date start : <?php echo $borrows[$i]->date_start?></p>
                    <p>Date end :      <?php echo $borrows[$i]->date_end?></p>
                </div>
                    <div class="btn">
                    <a class="edit_btn" href="<?php echo $view->path('edit-borrow',array($borrows[$i]->id)) ?>">Modifier</a>
                    <a class="delete_btn" href="<?php ?>">-Supprimer</a>
                </div>
                </div>
<div class="subline"></div>

            </div>
            <?php } ?>
        </div>
        <div class="borrows_right">
            <h1>Expired Borrows</h1>
            <?php for ($i = 0; $i < count($expiry);$i++){ ?>
            <div class="borrows_right_one">
                <div class="borrows_right_one_infos">
                    <h3>Name : <?php echo $expiry[$i]->lname ?></h3>
                    <p>Product : <?php echo $expiry[$i]->title ?></p>
                    <p>Reference : <?php echo $expiry[$i]->reference ?></p>
                    <p>Old date end : <?php echo date_create_from_format('Y/m/d',$expiry[$i]->date_end) ?></p>
                </div>
                <div class="btn">
                    <a class="edit_btn" href="<?php echo $view->path('add-borrow') ?>">Modifier</a>
                    <a class="delete_btn" href="<?php ?>">-Supprimer</a>
                </div>
                <div class="subline"></div>
            </div>
            <?php } ?>





        </div>
    </div>
</section>