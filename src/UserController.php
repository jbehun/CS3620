<?php
/**
 * UserController.php
 *
 * PHP version 7
 *
 *
 * @category source
 * @package  App
 * @author   Justin Behunin
 */

declare(strict_types=1);

namespace App;


class UserController
{

    private $db;
    private $log;

    public function __construct(\PDO $db, \Monolog\Logger $log){
        $this->db = $db;
        $this->log = $log;
    }


    function getUser($ip){

        $this->log->info("Get user with ip $ip '/' route");

        try{

            $sql = "SELECT name FROM users where ip = :ip";
            $result = $this->db->prepare($sql);
            $result->execute(['ip' => $ip]);

            return $result->fetchObject();


        }catch (\PDOException $e){
            die($e->getCode() . ": " . $e->getMessage());
        }

    }


    function addUser($ip, $name){


        try{

            $sql = "INSERT INTO users set ip = :ip, name = :name";
            $result = $this->db->prepare($sql);
            $result->execute(array(':ip' => $ip, ':name' => $name));
            return $result->rowCount();


        }catch (\PDOException $e){
            echo $sql.$e->getMessage();
            throw new \RuntimeException("Insert Failed");
        }

    }
}