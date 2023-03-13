<h1>Products</h1>
<a class="add_btn" href="<?php echo $view->path('add-products')?>"> + Ajouter</a>
<?php
for ($i = 0;$i < count($products);$i++){
    ?>
    <div class="one_sub">
        <div class="one_sub_left">
            <div class="one_sub__name"><p><?php echo $products[$i]->title ?> </p><span>Reference : <?php echo $products[$i]->reference ?></span></div>
            <div class="one_sub__email">Description : <?php echo $products[$i]->descri ?></div>
        </div>
        <div class="one_sub_right">
            <a class="edit_btn" href="<?php echo $view->path('edit-products',array($products[$i]->id))?>">Modifier</a>

            <a class="delete_btn" href="<?php echo $view->path('delete-products',array($products[$i]->id))?>">- Supprimer</a>

        </div>

    </div>
    <div class="subline"></div>
<?php } ?>
