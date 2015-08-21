<?php
    
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    
    require_once "src/Stylist.php";
    require_once "src/Client.php";
    
    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    
    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
            Stylist::deleteAll();
        }
        
        function test_getId()
        {
            //Arrange
            $id = 1;
            $client_name = "Marcos";
            $test_client = new Client($id, $client_name, $stylist_id);
            
            //Act
            $result = $test_client->getId();
            
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
        
        function test_setId()
        {
            //Arrange
            $id = null;
            $stylist_name = "Fabian";
            $test_stylist = new Stylist($id, $stylist_name);
            $test_stylist->save();
            $client_id = 9;
            $client_name = "Khalil Mack";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_id, $client_name, $stylist_id);
            
            //Act
            $test_client->setId(10);
            $result = $test_client->getId();
            
            //Assert
            $this->assertEquals(10, $result);
        }
        
        function test_getClientName()
        {
            //Arrange
            $id = null
            $client_name = "Derek Carr";
            $stylist_id = null;
            $test_client = new Client($id, $client_name, $stylist_id);
            
            //Act
            $result = $test_client->getClientName();
            
            //Assert
            $this->assertEquals($client_name, $result);
        }
        
        function test_setClientName()
        {
            //Arrange
            $id = 3;
            $client_name = "Justin Ellis";
            $stylist_id = null;
            $test_client = new Client($id, $client_name, $stylist_id);
            
            //Act
            $test_client->setClientName("Rodney Hudson");
            $result = $test_client->getClientName();
            
            //Assert
            $this->assertEquals("Rodney Hudson", $result);
        }
        
        function test_getStylistId()
        {
            //Arrange
            $id = null;
            $stylist_name = "Fabian";
            $test_stylist = new Stylist($id, $stylist_name);
            $test_stylist->save();
            $client_id = 14;
            $client_name = "Amari Cooper";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_id, $client_name, $stylist_id);
            
            //Act
            $result = $test_client->getStylistId();
            
            //Assert
            $this->assertEquals($stylist_id, $result);
        }
        
        function test_setStylistId()
        {
            //Arrange
            $id = null;
            $stylist_name = "Fabian";
            $test_stylist = new Stylist($id, $stylist_name);
            $test_stylist->save();
            $client_id = 14;
            $client_name = "DJ Hayden";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_id, $client_name, $stylist_id);
            
            //Act
            $test_client->setStylistId(90);
            $result = $test_client->getStylistId();
            
            //Assert
            $this->assertEquals(90, $result);
        }
        
        function test_save()
        {
            //Arrange
            $id = null;
            $stylist_name = "Fabian";
            $test_stylist = new Stylist($id, $stylist_name);
            $test_stylist->save();
            $client_name = "Micahel Crabtree";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($id, $client_name, $stylist_id);
            
            //Act
            $test_client->save();
            $result = Client::getAll();
            
            //Assert
            $this->assertEquals($test_client, $result[0]);
        }
        
        function test_getAll()
        {
            //Arrange
            $id = null;
            $stylist_name = "Fabian";
            $test_stylist = new Stylist($id, $stylist_name);
            $test_stylist->save();
            
            $client_name = "Khalil Mack";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($id, $client_name, $stylist_id);
            $test_client->save();
            
            $client_name2 = "Justin Tuck";
            $test_client2 = new Client($id, $client_name2, $stylist_id);
            $test_client2->save();
            
            //Act
            $result = Client::getAll();
            
            //Assert
            $this->assertEquals([$test_client1, $test_client2], $result);
        }
        
        function test_deleteAll()
        {
            //Arrange
            $id = null;
            $stylist_name = "Fabian";
            $test_stylist = new Stylist($id, $stylist_name);
            $test_stylist->save();
            
            $stylist_name2 = "Khalil Mack";
            $test_stylist2 = new Stylist->($stylists_name2, $id);
            $test_stylist2->save();

            $test_client1 = new CLient 
            $test_client1->save();
            
            $test_client2 = new Client($id, $client_name2, $stylist_id);
            $test_client2->save();

            
            //Act
            $test_client->deleteClient();
            
            //Assert
            $this->assertEquals([$test_client2], Client::getAll());
        }
    }
?>