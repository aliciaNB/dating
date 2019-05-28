<?php
//Name: Alicia Buehner
//Date: 05.27.19
//Description: This file contains the Database object class for the Dating Assignment.

/* SQL table creation statements, *Optional fields are NOT NULL because - default values stored:
 *
 *   CREATE TABLE member (
 *       member_id INT NOT NULL AUTO_INCREMENT,
 *       fname VARCHAR(50) NOT NULL,
 *       lname VARCHAR(50) NOT NULL,
 *       age INT NOT NULL,
 *       gender VARCHAR(13) NOT NULL,
 *       phone VARCHAR(14) NOT NULL,
 *       email VARCHAR(255) NOT NULL,
 *       state VARCHAR(20) NOT NULL,
 *       seeking VARCHAR(13) NOT NULL,
 *       bio TEXT NOT NULL,
 *       premium TINYINT(1) DEFAULT 0,
 *       image TEXT,
 *       PRIMARY KEY(member_id)
 *   );
 *
 *   CREATE TABLE interest (
 *       interest_id INT NOT NULL AUTO_INCREMENT,
 *       interest VARCHAR(25),
 *       type VARCHAR(20),
 *       PRIMARY KEY(interest_id)
 *   );
 *
 *   CREATE TABLE member_interest (
 *       member_id INT NOT NULL,
 *       FOREIGN KEY(member_id)
 *       REFERENCES member(member_id),
 *       interest_id INT NOT NULL,
 *       FOREIGN KEY(interest_id)
 *       REFERENCES interest(interest_id),
 *       PRIMARY KEY(member_id, interest_id)
 *   );
 *
 *   INSERT INTO interest (interest, type)
 *   VALUES
 *   ('tv','indoor'),
 *   ('puzzles','indoor'),
 *   ('movies','indoor'),
 *   ('reading','indoor'),
 *   ('cooking','indoor'),
 *   ('playing cards','indoor'),
 *   ('board games','indoor'),
 *   ('video games','indoor'),
 *   ('hiking','outdoor'),
 *   ('walking','outdoor'),
 *   ('biking','outdoor'),
 *   ('climbing','outdoor'),
 *   ('swimming','outdoor'),
 *   ('collecting','outdoor');
 */

//require the user config file
require '/home/abuehner/config-member.php';

/**
 * Class Database represents a new Database object
 * for dating site user profiles.
 *
 * @author Alicia Buehner
 * @copyright 2019
 */
class Database
{
    //field
    private $_dbh;

    /**
     * Database constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->connect();
    }


    /**
     * Connect to the database.
     *
     * @return PDO|String Database or error message
     */
    function connect()
    {
        try {
            //Instantiate a db object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            return $this->_dbh;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Inserts a new member object into the database.
     *
     * @param $member Member|PremiumMember to insert into database.
     * @return String $id The member_id that was just inserted
     */
    function insertMember($member)
    {
        //check Member type
        if ($member instanceof PremiumMember) {
            $premium = 1;
        } else {
            $premium = 0;
        }

        //Define the query for member value fields
        $sql = "INSERT INTO member(fname, lname, age, gender, phone, email, state, seeking, bio, premium) 
                VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium)";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':fname', $member->getFname(), PDO::PARAM_STR);
        $statement->bindParam(':lname', $member->getLname(), PDO::PARAM_STR);
        $statement->bindParam(':age', $member->getAge(), PDO::PARAM_INT);
        $statement->bindParam(':gender', $member->getGender(), PDO::PARAM_STR);
        $statement->bindParam(':phone', $member->getPhone(), PDO::PARAM_STR);
        $statement->bindParam(':email', $member->getEmail(), PDO::PARAM_STR);
        $statement->bindParam(':state', $member->getState(), PDO::PARAM_STR);
        $statement->bindParam(':seeking', $member->getSeeking(), PDO::PARAM_STR);
        $statement->bindParam(':bio', $member->getBio(), PDO::PARAM_STR);
        $statement->bindParam(':premium', $premium, PDO::PARAM_INT);

        //Execute
        $statement->execute();

        //get member_id
        $id = $this->_dbh->lastInsertId();

        //check if premium member and add premium member fields
        if ($member instanceof PremiumMember) {

            //get members check interests
            $interests = array_merge($member->getInDoorInterests(), $member->getOutDoorInterests());

            //go through each of the values in selected interests
            foreach ($interests as $item) {
                //Define the query
                $sql = "INSERT INTO member_interest(member_id, interest_id)
                        VALUES (:id, :item)";

                //Prepare the statement
                $statement = $this->_dbh->prepare($sql);

                //Bind the parameters
                $statement->bindParam(':id', $id, PDO::PARAM_INT);
                $statement->bindParam(':item', $item, PDO::PARAM_INT);

                //Execute
                $statement->execute();
            }
        }
        //return the result
        return $id;
    }

    /**
     * Gets all member records from the database.
     *
     * @return array $result of database query
     */
    function getMembers()
    {
        //Define the query
        $sql = "SELECT * FROM member
                ORDER BY lname";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters

        //Execute
        $statement->execute();

        //Process result if there is one
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Gets a single member record from the database.
     *
     * @param $member_id Member|PremiumMember to get from database.
     * @return array $result of database query
     */
    function getMember($member_id)
    {
        //Define the query
        $sql = "SELECT * FROM member
                WHERE member_id = :member_id";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':member_id', $member_id, PDO::PARAM_INT);

        //Execute
        $statement->execute();

        //FIXME: needs to also get interests??

        //Process result if there is one
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Gets all the interests for a member in the database.
     *
     * @param $member_id Member|PremiumMember id to get from database.
     * @return string of interests member selected.
     */
    function getInterests($member_id)
    {
        //Define the query
        $sql = "SELECT interest 
                FROM interest
                WHERE interest_id IN(SELECT interest_id FROM member_interest WHERE member_id = :member_id)";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':member_id', $member_id, PDO::PARAM_INT);

        //Execute
        $statement->execute();

        //Process result if there is one
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $resultString = '';
        foreach($result as $row) {
            $resultString .= $row['interest'] . ', ';
        }
        $resultString = rtrim($resultString, ', ');

        return $resultString;
    }

    /**
     * Gets the id and interest based on type of interest from the database.
     * @param string $type The type of interest.
     *
     * @return array id, interest for all interest of type
     */
    function getInterest($type)
    {
        //Define the query - get array of id values for each type of interest
        $sql = "SELECT interest_id, interest
                FROM interest
                WHERE type = :type";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':type', $type, PDO::PARAM_STR);

        //Execute
        $statement->execute();

        //Process result if there is one
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}