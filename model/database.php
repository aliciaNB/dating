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

    function insertMember($member)
    {
        //check Member type
        if ($member instanceof PremiumMember) {
            $premium = 1;
        } else {
            $premium = 0;
        }

        //Define the query
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

        //TODO: INSERT statement for junction table, PremiumMember fields - you will write one row
        //      to the member_interests table for each interest that the member selected. (Note: this
        //      will be a lot easier if you populate your interests lists in the web app using the ids
        //      that are in the database as the value of each checkbox.)

        //Process result if there is one
        return;
    }

    function getMember($member_id)
    {
        //Define the query

        //Prepare the statement

        //Bind the parameters

        //Execute

        //Process result if there is one
        return;
    }

    function getInterests($member_id)
    {
        //Define the query

        //Prepare the statement

        //Bind the parameters

        //Execute

        //Process result if there is one
        return;
    }
}