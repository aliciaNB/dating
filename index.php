<!--
Name: Alicia Buehner
Date: 04.14.19
Description: This file contains the index page for Dating I, instantiates the Fat-Free Framework
             and defines the project routing.
 -->
<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require vendor/autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class (instantiate Fat-Free)
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function() {
    $view = new Template();
    echo $view-> render('views/home.html');
});

//Run Fat-free
$f3->run();