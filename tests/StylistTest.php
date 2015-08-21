<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	require_once "src/Stylist.php"
	require_once "src/Client.php"

	$server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {

    	protected function tearDown()
    	{
    		Stylist::deleteAll();
    		Client::deleteAll();
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
    		$result = $test_stylist->getStylistName();

    		//Assert
    		$this->assertEquals($stylist_name, $result);
    	}

    	function test_setStylistName()
    	{
    		//Arrange
    		$id = 2;
    		$stylist_name = "Rooks Traditional";
    		$test_stylist = new Stylist($id, $stylist_name);

    		//Act
    		$test_stylist->setStylistName("Modern Man");
    		$result = $test_stylist->getStylistName();

    		//Assert
    		$this->assertEquals("Modern Man", $result);
    	}

    	function test_save()
    	{
            //Arrange
            $stylist_name = "Fabian";
            $test_stylist = new Stylist($stylist_name);
            
            //Act
            $test_stylist->save();
            
            //Assert
            $this->assertEquals($test_stylist, $result[0]);
        }
        
        function test_getAll()
        {
            //Arrange
            $stylist_name1 = "Sang Nguyen";
            $stylist_name2 = "Rob Van Dam";
            $test_stylist1 = new Stylist($stylist_name1);
            $test_stylist1->save();
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();
            
            //Act
            $result = Stylist::getAll();
            
            //Assert
            $this->assertEquals([$test_stylist1, $test_stylist2], $result);
        }
        
        function test_deleteAll()
        {
            //Arrange
            $id1 = null;
            $stylist_name1 = "Sang Nguyen";
            $id2 = null;
            $stylist_name2 = "Rob Van Dam";
            $test_stylist1 = new Stylist($id1, $stylist_name1);
            $test_stylist1->save();
            $test_stylist2 = new Stylist($id2, $stylist_name2);
            $test_stylist2->save();
            
            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();
            
            //Assert
            $this->assertEquals([], $result);
        }
        
        function test_find()
        {
            //Arrange
            $stylist_name1 = "Rooks Traditional";
            $stylist_name2 = "Throne Traditional";
            $test_stylist1 = new Stylist($id1, $stylist_name1);
            $test_stylist1->save();
            $test_stylist2 = new Stylist($id2, $stylist_name2);
            $test_stylist2->save();
            
            //Act
            $result = Stylist::find($test_stylist1->getId());
            
            //Assert
            $this->assertEquals($test_stylist1, $result);
        }
        
        function test_updateName()
        {
            //Arrange
            $id = null;
            $stylist_name = "Rooks Traditional";
            $test_stylist = new Stylist($id, $stylist_name);
            $test_stylist->save();
            
            $new_stylist_name = "Chachi";
            
            //Act
            $test_stylist->updateStylist($new_stylist_name);
            
            
            //Assert
            $this->assertEquals("Chachi", $test_stylist->getStylistName());
        }
        
        function test_delete()
        {
            //Arrange
            $id = null;
            $stylist_name1 = "Rooks Traditional";
            $stylist_name2 = "Throne Traditional";
            $test_stylist1 = new Stylist($id, $stylist_name1);
            $test_stylist1->save();
            $test_stylist2 = new Stylist($id, $stylist_name2);
            $test_stylist2->save();
            
            //Act
            $test_stylist->delete();
           
            
            //Assert
            $this->assertEquals([$test_stylist2], Stylist::getAll());
        }
        
        function test_getClients()
        {
            //Arrange
            $id = null;
            $stylist_name = "Derek Carr";
            $test_stylist = new Stylist($id, $stylist_name);
            $test_stylist->save();
            
            $client_name1 = "Khalil Mack";
            $stylist_id = $test_stylist->getId();
            $test_client1 = new Client($id, $client_name1, $stylist_id);
            $test_client1->save();
            
            $client_name2 = "Amari Cooper";
            $test_client2 = new Client($id, $client_name2, $stylist_id);
            $test_client2->save();
            
            //Act
            $result = $test_stylist->getClients();
            
            //Assert
            $this->assertEquals([$test_client1, $test_client2], $result);
        }
    }
?>

    }