<?php
/**
 * These are tests for the user[s] endpoint
 * @see http://developer.github.com/v3/users/
 */
namespace Statapus;

class DbTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    function testDbInstantiateExplodesWithMissingConfig()
    {
        new Db(array());
        $this->assertTrue(true);
    }
    /**
     * @expectedException \InvalidArgumentException
     */
    function testDbInstantiateNoExplodesWithProperConfig()
    {
        $config = array(
            'host'     => null,
            'port'     => null,
            'database' => null,
            'username' => null,
            'password' => null,
        );
        new Db($config);
        $this->assertTrue(true);
    }

}
