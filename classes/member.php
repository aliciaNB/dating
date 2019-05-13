<?php

/**
 * Class Member represents a...
 *
 * @author Alicia Buehner
 * @copyright 2017
 */
class Member
{
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Member constructor.
     * @param $first
     * @param $last
     * @param $age
     * @param $gender
     * @param $phone
     */
    public function __construct($first, $last, $age, $gender, $phone)
    {
        $this->_fname = $first;
        $this->_lname = $last;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_phone = $phone;
    }

    /**
     * Gets member first name.
     * @return String
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Gets member last name.
     * @return String
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Gets member age.
     * @return int
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * Gets member gender.
     * @return String
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * Gets member phone number.
     * @return String
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Gets member email.
     * @return String
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Get member state.
     * @return String
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Get member seeking gender.
     * @return String
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * Gets member biography.
     * @return String
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * Sets member first name.
     * @param $first
     * @return void
     */
    public function setFname($first)
    {
        $this->_fname = $first;
    }

    /**
     * Sets member last name.
     * @param $last
     * @return void
     */
    public function setLname($last)
    {
        $this->_lname = $last;
    }

    /**
     * Sets member age.
     * @param $age
     * @return void
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * Set member gender
     * @param $gender
     * @return void
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * Sets member phone number.
     * @param $phone
     * @return void
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * Sets member email.
     * @param $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * Sets member state.
     * @param $state
     * @return void
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * Sets member gender seeking.
     * @param $seeking
     * @return void
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * Sets member biography.
     * @param $bio
     * @return void
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }
}