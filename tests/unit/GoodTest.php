<?php
/**
 * These are tests for the user[s] endpoint
 * @see http://developer.github.com/v3/users/
 */
namespace Statapus;

class GoodTest extends \PHPUnit_Framework_TestCase
{
   
    /*
     * The Me tests are for the shortcut endpoint /user (rather than /users) 
     * that returns the currently authenticated User
     */
    
    
    function testMakeGoodTests()
    {
        $this->assertTrue(true);
    }
}
