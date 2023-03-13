<h1>Subscribers</h1>
<?php

//echo $view->dump($subscribers);
?>
<a class="add_btn" href="<?php echo $view->path('add-sub')?>"> + Ajouter</a>

<?php
for ($i = 0;$i < count($subscribers);$i++){
    ?>
    <div class="one_sub">
        <div class="one_sub_left">
            <div class="one_sub__name"><p>Prénom : <?php echo $subscribers[$i]->fname ?> </p><span>Nom : <?php echo $subscribers[$i]->lname ?></span></div>
            <div class="one_sub__email">Email : <?php echo $subscribers[$i]->email ?></div>
            <div class="one_sub__age">Age : <?php echo $subscribers[$i]->age ?></div>
        </div>
        <div class="one_sub_right">
            <a class="edit_btn" href="<?php echo $view->path('edit-sub',array($subscribers[$i]->id))?>">Modifier</a>

          <a class="delete_btn" href="<?php echo $view->path('delete-sub',array($subscribers[$i]->id))?>">- Supprimer</a>

        </div>

    </div>
    <div class="subline"></div>

<?php } ?>

