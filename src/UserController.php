<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 8/7/18
 * Time: 6:51 PM
 */

declare(strict_types=1);

namespace App;

use PDO;

class UserController
{

    private $db;
    private $log;

    public function __construct(\PDO $db, \Monolog\Logger $log){
        $this->db = $db;
        $this->log = $log;
    }


    public function getUser($ip){

        $this->log->info("Get user with ip $ip '/' route");
        //$result = $this->db->prepare();
        //$result->execute();
        //$data[][] = $result;
    }

}