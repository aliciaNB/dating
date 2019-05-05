<?php
//Name: Alicia Buehner
//Date: 05.05.19
//Description: This file contains the index page for Dating I, II & III, instantiates the Fat-Free Framework
//and defines the project routes through the create a profile form.

//Start session
session_start();

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require vendor/autoload file
require_once('vendor/autoload.php');
require_once('model/validation-functions.php');

//Create an instance of the Base class (instantiate Fat-Free)
$f3 = Base::instance();

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

//TODO: define arrays for the check boxes and radio here.
$f3->set('genders', array('Male', 'Female'));
$f3->set('states', array('ALABAMA', 'ALASKA', 'ARIZONA', 'ARKANSAS', 'CALIFORNIA', 'COLORADO', 'CONNECTICUT', 'DELAWARE',
    'DISTRICT OF COLUMBIA', 'FLORIDA','GEORGIA', 'HAWAII', 'IDAHO', 'ILLINOIS', 'INDIANA', 'IOWA', 'KANSAS', 'KENTUCKY',
    'LOUISIANA', 'MAINE', 'MARYLAND', 'MASSACHUSETTS','MICHIGAN', 'MINNESOTA', 'MISSISSIPPI', 'MISSOURI', 'MONTANA',
    'NEBRASKA', 'NEVADA', 'NEW HAMPSHIRE', 'NEW JERSEY', 'NEW MEXICO', 'NEW YORK', 'NORTH CAROLINA', 'NORTH DAKOTA',
    'OHIO', 'OKLAHOMA','OREGON', 'PENNSYLVANIA', 'RHODE ISLAND', 'SOUTH CAROLINA', 'SOUTH DAKOTA', 'TENNESSEE',
    'TEXAS', 'UTAH', 'VERMONT', 'VIRGINIA', 'WASHINGTON', 'WEST VIRGINIA', 'WISCONSIN', 'WYOMING'));

//Define a default route
$f3->route('GET /', function() {
    $view = new Template();
    echo $view-> render('views/home.html');
});

//Define route to first create profile form - personal information
$f3->route('GET|POST /personalinformation', function($f3) {

    //if form has been submitted, validate
    if (!empty($_POST)) {

        //get data from form
        $first = $_POST['first'];
        $last = $_POST['last'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];

        //add data to the hive
        $f3->set('first', $first);
        $f3->set('last', $last);
        $f3->set('age', $age);
        $f3->set('gender', $gender);
        $f3->set('phone', $phone);


        //if valid add to session
        if (validForm1()) {
            //gather SESSION info
            $_SESSION['first'] = $first;
            $_SESSION['last'] = $last;
            $_SESSION['age'] = $age;

            //gender is optional check if empty store default value
            if (empty($gender)) {
                $_SESSION['gender'] = "Gender was not specified";
            } else {
                $_SESSION['gender'] = $gender;
            }

            $_SESSION['phone'] = $phone;

            //Redirect to profile form
            $f3->reroute('/profile');
        }
    }

    $view = new Template();
    echo $view->render('views/personal_form.html');
});

//Define route to second create profile form - profile
$f3->route('GET|POST /profile', function($f3) {

    //if form has been submitted, validate
    if (!empty($_POST)) {
        //get data from form
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seeking = $_POST['seeking'];
        $bio = $_POST['bio'];

        //add data to the hive
        $f3->set('email', $email);
        $f3->set('state', $state);
        $f3->set('seeking', $seeking);
        $f3->set('bio', $bio);

        //if valid add to session
        if (validForm2()) {

            //gather SESSION info
            $_SESSION['email'] = $email;
            $_SESSION['state'] = $state;
            $_SESSION['seeking'] = $seeking;

            //gender is optional check if empty store default value
            if (empty($seeking)) {
                $_SESSION['seeking'] = "Gender was not specified";
            } else {
                $_SESSION['seeking'] = $seeking;
            }
            $_SESSION['bio'] = $bio;

            //Redirect to profile form
            $f3->reroute('/interest');
        }
    }
    $view = new Template();
    echo $view->render('views/profile_form.html');
});

//Define route to third create profile form - interest
$f3->route('GET|POST /interest', function() {

    //TODO: if form has been submitted validate

    //TODO: fix bug with implode
    //gather SESSION info
    //$interest1 = implode(" ", $_POST['indoor']);
    //$interest2 = implode(" ", $_POST['outdoor']);
    //$_SESSION['interests'] = $interest1 . " " . $interest2;

    $view = new Template();
    echo $view->render('views/interest_form.html');
});

//Define route to third create profile form - interest
$f3->route('POST /summary', function() {
    $view = new Template();
    echo $view->render('views/form_summary.html');
});

//Run Fat-free
$f3->run();