<?php
/**
 * Class PremiumMember represents a premium Spark dating profile.
 * The PremiumMember represents a Spark dating profile with a first name,
 * last name, age, gender, phone number, email, seeking gender, biography,
 * and indoor and outdoor interests.
 *
 * @author Alicia Buehner
 * @copyright 2017
 */
class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;

    /**
     * PremiumMember constructor.
     *
     * @param String $first Member first name
     * @param String $last Member last name
     * @param int $age Member age
     * @param String $gender Member gender
     * @param String $phone Member phone number
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
}