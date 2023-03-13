<?php

$routes = array(
    array('home','admin','index'),

    array('home-borrow','borrow','index'),
    array('add-borrow','borrow','addBorrow'),
    array('edit-borrow','borrow','editBorrow',array('id')),



//products
    array('home-products','products','index'),
    array('add-products','products','addProd'),
    array('delete-products','products','deleteProd',array('id')),
    array('edit-products','products','editProd',array('id')),

//sub
    array('home-sub','subscriber','index'),
    array('add-sub','subscriber','addSub'),
    array('delete-sub','subscriber','deleteSub',array('id')),
    array('edit-sub','subscriber','editSub',array('id')),

    array('api_test','api','index'),

    //login
    array('login','user','login'),
    array('register','user','register'),
    array('logout','user','logout'),

    array('dashboard','dashboard','index')

);









