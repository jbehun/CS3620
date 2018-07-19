<?php
/**
 * Unit-test for Part 1
 *
 * PHP Version 7
 *
 * @category UnitTests
 * @package  Tests
 * @author   Don Stringham <donstringham@weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://weber.edu
 */
declare(strict_types=1);
namespace App\Tests;

use PHPUnit\Framework\TestCase;

/**
 * PartOneTest tests database validation
 *
 * @property string _host
 * @property string _port
 * @property string _username
 * @property string _password
 * @property \MySQLi _connection
 * @property string _database
 * @category UnitTests
 * @package  App\Tests
 * @author   Don Stringham <donstringham@weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://weber.edu
 */
class PartOneTest extends TestCase
{
    /**
     * Set up data needed for every unit-test
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Don Stringham <donstringham@weber.edu>
     * @license  MIT https://opensource.org/licenses/MIT
     * @link     https://weber.edu
     * @return   void
     */
    public function setUp(): void
    {
        $this->_host = '67.205.183.11';
        $this->_port = '3306';
        $this->_username = 'student';
        $this->_password = 'letmein';
        $this->_connection = null;
        $this->_database = 'student';
        $this->_connection = mysqli_connect(
            $this->_host,
            $this->_username,
            $this->_password
        );
        $this->_connection->select_db($this->_database);
    }

    /**
     * Tests if unit-test can be run
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Don Stringham <donstringham@weber.edu>
     * @license  MIT https://opensource.org/licenses/MIT
     * @link     https://weber.edu
     * @return   void
     */
    public function testCanary(): void
    {
        // arrange & act & assert
        $this->assertTrue(true);
    }

    /**
     * Tests prime numbers
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Don Stringham <donstringham@weber.edu>
     * @license  MIT https://opensource.org/licenses/MIT
     * @link     https://weber.edu
     * @return   void
     */
    public function testSelectAll(): void
    {
        // arrange
        $query = "SELECT * FROM student.test";
        // act
        $result = $this->_connection->query($query);
        $row = $result->fetch_row();
        // assert
        $this->assertEquals('1', $row[0]);
    }
}
