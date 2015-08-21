<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	require_once "src/Stylist.php"
	require_once "src/Client.php"

	$server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {

    	protected function tearDown()
    	{
    		Stylist::deleteAll();
    	}

    	function test_getId()
    	{
    		//Arrange
    		$id = 1;
    		$stylist_name = "Rooks Traditional";
    		$test_stylist = new Stylist($id, $stylist_name);

    		//Act
    		$result = $test_stylist->getId();

    		//Assert
    		$this->assertEquals(1, $result);

    	}

    	function test_setId()
    	{
    		//Arrange
    		$id = null;
    		$stylist_name = "Rooks Traditional"
    		$test_stylist = new Stylist($id, $stylist_name);

    		//Act
    		$test_stylist->setId(25);
    		$result = $test_stylist->getId();

    		//Assert
    		$this->assertEquals(25, $result);
    	}

    	function test_getStylistName()
    	{
    		//Arrange
    		$id = null;
    		$stylist_name = "Rooks International";
    		$test_stylist = new Stylist($id, $stylist_name);

    		//Act
    		$result = test_stylist->getStylistName();

    		//Assert
    		$this->assertEquals("Rooks International", $result);
    	}

    }