<?php
//
//Name: Alicia Buehner
//Date: 04.14.19
//Description: This file contains the index page for Dating I, instantiates the Fat-Free Framework
//and defines the project routing.
//

//Start session
session_start();

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

//Define home route
$f3->route('GET /homepage', function() {
    $view = new Template();
    echo $view-> render('views/home.html');
});

//Define route to first create profile form - personal information
$f3->route('POST /personalinformation', function() {
    $view = new Template();
    echo $view->render('views/personal_form.html');
});

//Define route to second create profile form - profile
$f3->route('POST /profile', function() {

    //gather SESSION info
    $_SESSION['first'] = $_POST['first'];
    $_SESSION['last'] = $_POST['last'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['phone'] = $_POST['phone'];

    var_dump($_SESSION);

    $view = new Template();
    echo $view->render('views/profile_form.html');
});

//Define route to third create profile form - interest
$f3->route('POST /interest', function() {

    //gather SESSION info
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['seeking'] = $_POST['seeking'];
    $_SESSION['bio'] = $_POST['bio'];


    $view = new Template();
    echo $view->render('views/interest_form.html');
});

//Define route to third create profile form - interest
$f3->route('POST /summary', function() {

    //gather SESSION info
    $_SESSION['indoor'] = $_POST['indoor'];
    $_SESSION['outdoor'] = $_POST['outdoor'];

    $view = new Template();
    echo $view->render('views/form_summary.html');
});

//Run Fat-free
$f3->run();