<?php
/**
 * Class Member represents a standard Spark dating profile.
 * Member represents a Spark dating profile with a first name,
 * last name, age, gender, phone number, email, seeking gender,
 * and biography.
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
     *
     * @param String $first First name
     * @param String $last Last name
     * @param int $age Age
     * @param String $gender Gender
     * @param String $phone Phone number
     * @return void
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
     * Gets Member first name.
     *
     * @return String
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Gets Member last name.
     *
     * @return String
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Gets Member age.
     *
     * @return int
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * Gets Member gender.
     *
     * @return String
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * Gets Member phone number.
     *
     * @return String
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Gets Member email.
     *
     * @return String
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Get Member state.
     *
     * @return String
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Get Member seeking gender.
     *
     * @return String
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * Gets Member biography.
     *
     * @return String
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * Sets Member first name.
     *
     * @param String $first First name
     * @return void
     */
    public function setFname($first)
    {
        $this->_fname = $first;
    }

    /**
     * Sets Member last name.
     *
     * @param String $last Last name
     * @return void
     */
    public function setLname($last)
    {
        $this->_lname = $last;
    }

    /**
     * Sets Member age.
     *
     * @param int $age Age
     * @return void
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * Sets Member gender.
     *
     * @param String $gender Gender
     * @return void
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * Sets Member phone number.
     *
     * @param String $phone Phone number
     * @return void
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * Sets Member email.
     *
     * @param String $email Email
     * @return void
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * Sets Member state.
     *
     * @param String $state State
     * @return void
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * Sets Member gender seeking.
     *
     * @param String $seeking Seeking gender
     * @return void
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * Sets member biography.
     *
     * @param String $bio Biography
     * @return void
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }
}