<?php
//Name: Alicia Buehner
//Date: 05.27.19
//Description: This file contains the index page for Dating I, II & III, IV instantiates the Fat-Free Framework
//and defines the project routes through the create a profile form.

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require vendor/autoload file
require_once('vendor/autoload.php');
require_once('model/validation-functions.php');

//Start session
session_start();

//Create an instance of the Base class (instantiate Fat-Free)
$f3 = Base::instance();

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

//Create Database object
$db = new Database();

//Define expected values for form checks, radios, and drop downs
$f3->set('memberships', 'Sign me up for a Premium Account!');
$f3->set('genders', array('Male', 'Female'));

$f3->set('states', array('ALABAMA', 'ALASKA', 'ARIZONA', 'ARKANSAS', 'CALIFORNIA', 'COLORADO', 'CONNECTICUT', 'DELAWARE',
    'DISTRICT OF COLUMBIA', 'FLORIDA','GEORGIA', 'HAWAII', 'IDAHO', 'ILLINOIS', 'INDIANA', 'IOWA', 'KANSAS', 'KENTUCKY',
    'LOUISIANA', 'MAINE', 'MARYLAND', 'MASSACHUSETTS','MICHIGAN', 'MINNESOTA', 'MISSISSIPPI', 'MISSOURI', 'MONTANA',
    'NEBRASKA', 'NEVADA', 'NEW HAMPSHIRE', 'NEW JERSEY', 'NEW MEXICO', 'NEW YORK', 'NORTH CAROLINA', 'NORTH DAKOTA',
    'OHIO', 'OKLAHOMA','OREGON', 'PENNSYLVANIA', 'RHODE ISLAND', 'SOUTH CAROLINA', 'SOUTH DAKOTA', 'TENNESSEE',
    'TEXAS', 'UTAH', 'VERMONT', 'VIRGINIA', 'WASHINGTON', 'WEST VIRGINIA', 'WISCONSIN', 'WYOMING'));

//get the interest and id for each type of interest to display from the db
$indoors = $db->getInterest('indoor');
$outdoors =$db->getInterest('outdoor');

$f3->set('indoors', $indoors);
$f3->set('outdoors', $outdoors);

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
        $membership = $_POST['membership'];

        //add data to the hive
        $f3->set('first', $first);
        $f3->set('last', $last);
        $f3->set('age', $age);
        $f3->set('gender', $gender);
        $f3->set('phone', $phone);
        $f3->set('membership', $membership);

        //if valid add to session
        if (validForm1()) {
            //gather SESSION info
            //instantiate PremiumMember if checked
            if (!empty($membership)) {
                //gender is optional check if empty store default value
                if (empty($gender)) {
                    $gender = "Not specified";
                }
                $newMember = new PremiumMember($first, $last, $age, $gender, $phone);
            } else { //otherwise, instantiate Member
                $newMember = new Member($first, $last, $age, $gender, $phone);
            }
            $_SESSION['member'] = $newMember;
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
            $_SESSION['member']->setEmail($email);

            //state is optional check if empty store default value
            if (empty($state)) {
                $state = "Not specified";
            }

            //gender is optional check if empty store default value
            if (empty($seeking)) {
                $seeking = "Not specified";
            }

            //bio is optional check if empty store default value
            if (empty($bio)) {
                $bio = "Not specified";
            }

            $_SESSION['member']->setState($state);
            $_SESSION['member']->setSeeking($seeking);
            $_SESSION['member']->setBio($bio);

            //redirect user based on member type
            if ($_SESSION['member'] instanceof PremiumMember) {
                //Redirect to interests form
                $f3->reroute('/interests');
            } else {
                //Redirect to summary
                $f3->reroute('/summary');
            }
        }
    }

    $view = new Template();
    echo $view->render('views/profile_form.html');
});

//Define route to third create profile form - interest if empty
$f3->route('GET /interests', function($f3) {

    if ($_SESSION['member'] instanceof PremiumMember) {
        $view = new Template();
        echo $view->render('views/interest_form.html');
    } else {
        //Redirect to summary
        $f3->reroute('/summary');
    }
});

//Define route to third create profile form - interest
$f3->route('POST /interests', function($f3) {

    $indoor = $_POST['indoor'];
    $outdoor = $_POST['outdoor'];

    //add data to hive
    $f3->set('indoor', $indoor);
    $f3->set('outdoor', $outdoor);

    //if valid add to session
    if (validForm3()) {
        //gather SESSION info && check for empty values
        if (!empty($indoor) && !empty($outdoor)) {
            //if selected in both display both
            $_SESSION['member']->setInDoorInterests($indoor);
            $_SESSION['member']->setOutDoorInterests($outdoor);
        } else if (empty($outdoor) && !empty($indoor)) {
            //if outdoor is empty display just indoor
            $outdoor = array("None selected");
            $_SESSION['member']->setInDoorInterests($indoor);
            $_SESSION['member']->setOutDoorInterests($outdoor);
        } else if (empty($indoor) && !empty($outdoor)) {
            //if indoor is empty display just outdoor
            $indoor = array("None selected");
            $_SESSION['member']->setInDoorInterests($indoor);
            $_SESSION['member']->setOutDoorInterests($outdoor);
        } else {
            //if both are empty display default
            $indoor = array("None selected");
            $outdoor = array("None selected");
            $_SESSION['member']->setInDoorInterests($indoor);
            $_SESSION['member']->setOutDoorInterests($outdoor);
        }

        //Redirect to summary
        $f3->reroute('/summary');
    }

    $view = new Template();
    echo $view->render('views/interest_form.html');
});

//Define route to third create profile form - interest
$f3->route('GET|POST /summary', function($f3) {

    //make db global access
    global $db;

    //add member to the db and store the id
    $memberId = $db->insertMember($_SESSION['member']);

    //retrieve interests for current member
    $selectedInterest = $db->getInterests($memberId);
    if (empty($selectedInterest)) {
        $selectedInterest = 'None selected';
    }
    $f3->set('selectedInterest', $selectedInterest);

    $view = new Template();
    echo $view->render('views/form_summary.html');
});

//Define route to the admin page that displays all the members
$f3->route('GET /admin', function ($f3) {

    //make db global
    global $db;

    //get the members
    $members = $db->getMembers();
    $f3->set('members', $members);

    //add interests if member is Premium member
    foreach ($members as $key => $row) {
        if($row['premium']== 1) {
            $interest = $db->getInterests($row['member_id']);
            $members[$key]['interest'] = $interest;
        }
    }
    //store new members hive value
    $f3->set('members', $members);

    $view = new Template();
    echo $view->render('views/admin_page.html');
});

//Run Fat-free
$f3->run();