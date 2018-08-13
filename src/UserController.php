<?php
/**
 * UserController.php
 *
 * PHP version 7
 *
 * @category source
 * @package  App
 * @author   Justin Behunin
 */

declare(strict_types=1);

namespace App;

/**
 * UserController.php
 *
 * Handles any request to the user database
 *
 * @category source
 * @package  App
 * @author   Justin Behunin
 */
class UserController
{
    /**
     * Accepts a database connection
     *
     * @var \PDO
     */
    private $db;

    /**
     * Accepts a monolog object
     *
     * @var \Monolog\Logger
     */
    private $log;

    /**
     * Construct
     *
     * @param \PDO $db database connection
     * @param \Monolog\Logger $log logs actions to a file
     *
     * @category source
     * @package  App
     * @author   Justin Behunin
     * @return void
     */

    public function __construct(\PDO $db, \Monolog\Logger $log)
    {

        $this->db = $db;
        $this->log = $log;
    }

    /**
     * GetUser return the user based on ip
     *
     * @param String $ip
     *
     * @return mixed
     */
    function getUser($ip)
    {

        $this->log->info("Get user with ip $ip '/' route");

        $sql = "SELECT name FROM users where ip = :ip";
        $result = $this->db->prepare($sql);
        $result->execute(['ip' => $ip]);

        return \GuzzleHttp\json_encode($result->fetchObject());
    }

    /**
     * AddUser adds a user to the dp with ip and name
     *
     * @param String $ip
     *
     * @param String $name
     *
     * @return int
     */

    function addUser($ip, $name)
    {

        $this->log->info("Added user $ip $name '/' route");

        $sql = "INSERT INTO users set ip = :ip, name = :name";
        $result = $this->db->prepare($sql);
        $result->execute(array(':ip' => $ip, ':name' => $name));
        $value = $result->queryString;
        $this->log->info("Query user $value '/' route");
        return $result->rowCount();
    }

    /**
     * DeleteUser adds a user to the dp with ip and name
     *
     * @param String $ip
     *
     * @return int
     */
    function deleteUser($ip)
    {

        $this->log->info("Deleted user $ip '/' route");

        $sql = "DELETE FROM users WHERE ip = :ip";
        $result = $this->db->prepare($sql);
        $result->execute(array(':ip' => $ip));

        return $result->rowCount();
    }
}