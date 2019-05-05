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
        $f3->set("errors['age']", 'Please a age between 18-118');
    }

    if (!validPhone($f3->get('phone'))) {
        $isValid = false;
        $f3->set("errors['phone']", 'Please enter a phone number');
    }

    return $isValid;
}

/**
 * Checks to see that profile form is valid.
 *
 * @return boolean
 */
function validForm2() {
    //temp return value
    return false;
}

/**
 * Checks to see that interest form is valid.
 *
 * @return boolean
 */
function validForm3() {
    //temp return value
    return false;
}

//TODO: Make name, age, phone, and email required fields.
// Gender, bio, and interests are optional

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
    //TODO: You can decide what constitutes a "valid" phone number. What about spaces, -, or ()??
    //return true if valid number 0-9, first number is not zero, and not empty
    return preg_match('/^[1-9][0-9]{0,15}$/', $phoneNum);
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


/**
 * Checks each selected outdoor interest against a list
 * of valid options. Not required field.
 *
 * @param String outdoor Interests to validate
 * @return boolean
 */
function validOutdoor($outdoor) {
    //temp return value
    return false;
}

/**
 * Checks each selected indoor interest against a list
 * of valid options. Not required field.
 *
 * @param String indoor Interests to validate
 * @return boolean
 */
function validIndoor($indoor) {
    //temp return value
    return false;
}