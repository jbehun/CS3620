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


class FeedController
{

    private $db;
    private $log;

    public function __construct(\PDO $db, \Monolog\Logger $log){
        $this->db = $db;
        $this->log = $log;
    }



}