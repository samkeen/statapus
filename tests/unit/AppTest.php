<?php
/**
 * These are tests for the user[s] endpoint
 * @see http://developer.github.com/v3/users/
 */
namespace Statapus;

class AppTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \InvalidArgumentException
     */
    function testAppInstantiateExplodesWithMissingConfig()
    {
        new App(array(), new DbFake());
        $this->assertTrue(true);
    }
    function testAppInstantiateNoExplodesWithProperConfig()
    {
        $config = array(
            'client_id'     => null,
            'client_secret' => null,
            'base_path'     => null
        );
        new App($config, new DbFake());
        $this->assertTrue(true);
    }

}
