<?php
/**
 * Unit-test for Part 1
 *
 * PHP Version 7
 *
 * @category UnitTests
 * @package  Tests
 * @author   Justin Behunin
 */
declare(strict_types=1);

namespace App\Tests;

use App\UserController;
use PHPUnit\Framework\TestCase;
use Monolog;
use PDO;


/**
 * UserControllerTest tests database validation
 *
 * @property PDO db
 * @property Monolog\Logger log
 * @property UserController harness
 * @category UnitTests
 * @package  App\Tests
 * @author   Justin Behunin
 */


class UserControllerTest extends TestCase
{

    /**
     * Set up the data base used for the tests
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Justin Behunin
     * @return   void
     * @throws   \Exception
     */
    public function setUp(): void
    {
        $settings = array(
        'host' => '67.205.183.11',
        'port' => '3306',
        'dbname' => 'feed_jbehun',
        'username' => 'jbehun',
        'password' => 'changeme');

        $dsn = 'mysql:dbname='.$settings['dbname'].
            ';host='.$settings['host'].
            ';port='.$settings['port'];
        $this->db = new \PDO($dsn, $settings['username'], $settings['password']);


        $this->log = new Monolog\Logger("Test Logger");
        $this->log->pushProcessor(new Monolog\Processor\UidProcessor());
        $this->log->pushHandler(new Monolog\Handler\StreamHandler(isset($_ENV['docker']) ? 'php://stdout'
            : __DIR__ . '/../logs/app.log',\Monolog\Logger::DEBUG));

        $this->harness = new UserController($this->db, $this->log);
    }

    /**
     * Tests if unit-test can be run
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Justin Behunin
     * @return   void
     */
    public function testCanary(): void
    {
        // arrange & act & assert
        $this->assertTrue($this->harness instanceof UserController);

    }

    /**
     * Tests adding a user
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Justin Behunin
     * @return   void
     */
    public function testAddUser(): void
    {
        // arrange
        $ip = "192.168.1.254";
        $name = "Test Name";
        // act
        $result = $this->harness->addUser($ip, $name);
        // assert
        $this->assertEquals(1 , $result);
    }

    /**
     * Tests deleting a user
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Justin Behunin
     * @return   void
     */
    public function testGetUser(): void
    {
        // arrange
        $ip = "192.168.1.254";
        $name = "Test Name";
        // act
        $result = $this->harness->getUser($ip);
        $act = \GuzzleHttp\json_decode($result, TRUE);
        // assert
        $this->assertEquals($name, $act['name']);
    }

    /**
     * Tests deleting a user
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Justin Behunin
     * @return   void
     */
    public function testDeleteUser(): void
    {
        // arrange
        $ip = "192.168.1.254";
        // act
        $result = $this->harness->deleteUser($ip);
        // assert
        $this->assertEquals(1 , $result);
    }

}
