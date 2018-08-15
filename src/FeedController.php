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
    private $ip;

    public function __construct(\PDO $db, \Monolog\Logger $log){
        $this->db = $db;
        $this->log = $log;
    }

public function addMessage($msg){

    $name = $msg['name'];
    $message = $msg['message'];
    $this->log->info("Add message request $name: $message '/' route");
    $sql = "INSERT INTO feed(name, message) VALUES(:name, :message)";
    $result = $this->db->prepare($sql);
    $result->execute(array(":name" => $name, ":message" => $message));
    return $result->rowCount();
}

public function getMessages($numOfMessages){

    $sql = "(SELECT name, message, time From feed ORDER BY time DESC LIMIt $numOfMessages) ORDER BY time";
    $result = $this->db->prepare($sql);
    $result->execute();
    return \GuzzleHttp\json_encode($result->fetchAll());


}

}