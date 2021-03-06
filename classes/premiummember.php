<?php
//Name: Alicia Buehner
//Date: 05.27.19
//Description: This file contains PremiumMember object class for the Dating Assignment.
//             Includes field and getter/setter for profile image functionality that is
//             not implemented yet.

/**
 * Class PremiumMember represents a premium Spark dating profile.
 * The PremiumMember represents a Spark dating profile with a first name,
 * last name, age, gender, phone number, email, seeking gender, biography,
 * and indoor and outdoor interests.
 *
 * @author Alicia Buehner
 * @copyright 2019
 */
class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;
    private $_profileImage;

    /**
     * PremiumMember constructor.
     *
     * @param String $first Member first name
     * @param String $last Member last name
     * @param int $age Member age
     * @param String $gender Member gender
     * @param String $phone Member phone number
     * @return void
     */
    public function __construct($first, $last, $age, $gender, $phone)
    {
        parent:: __construct($first, $last, $age, $gender, $phone);
    }

    /**
     * Gets PremiumMember indoor interests.
     *
     * @return array indoor interests
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * Gets PremiumMember outdoor interests.
     *
     * @return array outdoor interests
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * Gets PremiumMember profile image path.
     *
     * @return String Profile image path
     */
    public function getProfileImage()
    {
        return $this->_profileImage;
    }

    /**
     * Sets PremiumMember indoor interests.
     *
     * @param array $inDoorInterests Selected interests
     * @return void
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * Sets PremiumMember outdoor interests.
     *
     * @param array $outDoorInterests Selected interests
     * @return void
     */
    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }

    /**
     * Sets PremiumMember profile image path.
     *
     * @param $profileImage Member profile image path
     * @return void
     */
    public function setProfileImage($profileImage)
    {
        $this->_profileImage = $profileImage;
    }
}