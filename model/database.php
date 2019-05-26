<?php
//Name: Alicia Buehner
//Date: 05.27.19
//Description: This file contains the Database object class for the Dating Assignment.

/* SQL table creation statements:
 *
 *   CREATE TABLE member (
 *      member_id INT NOT NULL AUTO_INCREMENT,
 *         fname VARCHAR(50) NOT NULL,
 *       lname VARCHAR(50) NOT NULL,
 *       age INT NOT NULL,
 *       gender CHAR(1),
 *       phone VARCHAR(14) NOT NULL,
 *       email VARCHAR(255) NOT NULL,
 *       seeking CHAR(1),
 *       bio TEXT,
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

    function connect()
    {
        return;
    }

    function insertMember()
    {
        return;
    }

    function getMember($member_id)
    {
        return;
    }

    function getInterests($member_id)
    {
        return;
    }
}