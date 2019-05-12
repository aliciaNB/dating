<?php
//Name: Alicia Buehner
//Date: 05.05.19
//Description: This file contains the validation functions for the dating profile form

/**
 * Checks to see that personal information form
 * is valid.
 *
 * @return boolean
 */
function validForm1() {
    global $f3;
    $isValid = true;

    if (!validName($f3->get('first'))) {
        $isValid = false;
        $f3->set("errors['first']", 'Please enter your first name');
    }

    if (!validName($f3->get('last'))) {
        $isValid = false;
        $f3->set("errors['last']", 'Please enter your last name');
    }

    if (!validAge($f3->get('age'))) {
        $isValid = false;
        $f3->set("errors['age']", 'Please choose a valid age between 18-118');
    }

    if (!validGender($f3->get('gender'))) {
        $isValid = false;
        $f3->set("errors['gender']", "Invalid selection");
    }

    if (!validPhone($f3->get('phone'))) {
        $isValid = false;
        $f3->set("errors['phone']", 'Please enter a valid phone number');
    }

    if (!validMembership($f3->get('membership'))) {
        $isValid = false;
        $f3->set("errors['membership']", 'Invalid selection');
    }

    return $isValid;
}

/**
 * Checks to see that profile form is valid.
 *
 * @return boolean
 */
function validForm2() {
    global $f3;
    $isValid = true;

    if (!validEmail($f3->get('email'))) {
        $isValid = false;
        $f3->set("errors['email']", 'Please enter a valid email');
    }

    if (!validState($f3->get('state'))) {
        $isValid = false;
        $f3->set("errors['state']", "Invalid selection");
    }

    if (!validGender($f3->get('seeking'))) {
        $isValid = false;
        $f3->set("errors['seeking']", "Invalid selection");
    }

    return $isValid;
}

/**
 * Checks to see that interest form is valid.
 *
 * @return boolean
 */
function validForm3() {
    global $f3;
    $isValid = true;

    if (!validIndoor($f3->get('indoor'))) {
        $isValid = false;
        $f3->set("errors['indoor']", "Invalid selection");
    }

    if (!validOutdoor($f3->get('outdoor'))) {
        $isValid = false;
        $f3->set("errors['outdoor']", "Invalid selection");
    }

    //temp return value
    return $isValid;
}

/**
 * Checks to see that a string is all alphabetic
 * and contains a value.
 *
 *@param String name A string to validate
 * @return boolean
 */
function validName($name) {
    //return true if not empty and all alphabetic
    return !empty($name) && ctype_alpha($name);
}

/* Validate gender
 *
 * @param String gender
 * @return boolean
 */
function validGender($gender){
    global $f3;

    //gender is optional
    if (empty($gender)) {
        return true;
    }

    return in_array($gender, $f3->get('genders'));
}

/**
 * Checks to age is numeric and in range of 18-118
 * and contains a value.
 *
 * @param Number age An age to validate
 * @return boolean
 */
function validAge($age) {
    //return true if age is 18-118, a number, and not empty
    return $age >= 18 && $age <= 118 && is_numeric($age) && !empty($age);
}

/**
 * Checks to see that a phone number is valid.
 *
 * @param Number phoneNum A phone number to validate
 * @return boolean
 */
function validPhone($phoneNum) {
    $isValid = true;

    //remove spaces
    $numbers = preg_replace("/[^0-9]/", '', $phoneNum);
    $values = strlen($numbers);

    if($values != 10) {
        $isValid = false;
    }
    //return true if valid number 0-9, not empty, is at least 10 digits
    return $isValid;
}

/**
 * Checks to see that an email address is valid.
 *
 * @param String email An email to validate
 * @return boolean
 */
function validEmail($email) {
    //return true if valid email and not empty
    return filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email);
}


/* Validate state
 *
 * @param String state selected
 * @return boolean
 */
function validState($state) {
    global $f3;

    //state is optional
    if (empty($state)) {
        return true;
    }

    return in_array($state, $f3->get('states'));
}


/**
 * Checks each selected outdoor interest against a list
 * of valid options. Not required field.
 *
 * @param String outdoor Interests to validate
 * @return boolean
 */
function validOutdoor($outdoor) {
    global $f3;
    $isValid = true;
    // if it's empty, don't check for in array
    if(!empty($outdoor)) {
        foreach($outdoor as $item) {
            if(!in_array($item, $f3->get('outdoors'))) {
                $isValid = false;
            }
        }
    }
    return $isValid;
}

/**
 * Checks each selected indoor interest against a list
 * of valid options. Not required field.
 *
 * @param String indoor Interests to validate
 * @return boolean
 */
function validIndoor($indoor) {
    global $f3;
    $isValid = true;
    // if it's empty, don't check for in array
    if(!empty($indoor)) {
        foreach($indoor as $item) {
            if(!in_array($item, $f3->get('indoors'))) {
                $isValid = false;
            }
        }
    }
    return $isValid;
}

/**
 * Checks Premium account input is a valid value.
 *
 * @param String $membership to validate
 * @return boolean
 */
function validMembership($membership) {
    global $f3;
    $isValid = true;
    // if it's empty, don't check for in array
    if(!empty($membership)){
       if(!($membership == $f3->get('memberships'))) {
           $isValid = false;
       }
    }
    return $isValid;
}
