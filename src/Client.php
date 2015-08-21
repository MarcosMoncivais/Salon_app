<?php
    class Client
    {
        private $name;
        private $id;
        private $stylist_id;
        
        function __construct($name, $id = null, $stylist_id)
        
        {
            $this->name = $name;
            $this->id = $id;
            $this->stylist_id = $stylist_id;
        }
        
        function setName($new_name)
        
        {
            $this->name = (string) $new_name;
        }
        
        function getName()
        
        {
            return $this->name;
        }
        
        function setId($new_id)
        
        {
            $this->id = (int) $new_id;
        }
        
        function getId()
        
        {
            return $this->id;
        }
        
        function setStylistId($stylist_id)
        
        {
            $this->stylist_id = (int) $stylist_id;
        }
        
        function getStylistId()
        
        {
            return $this->stylist_id;
        }
        
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES('{$this->getName()}', {this->getStylistId()})");
            $this->id = GLOBALS['DB']->lastInsertId();
        }
        
        function update($new_name)
        
        {
            $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }
        
        function delete()
        
        {
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
        }
        
        static function getAll()
        
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach($returned_clients as $client) {
                $name = $client['name'];
                $id = $client['id'];
                $stylist_id = $current_client['stylist_id'];
                $new_client = new Client($name, $id, $stylist_id);
                array_push($clients, $new_client);
            }
            return $clients;
        }
        
        static function deleteAll()
        
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }
        
        static function find($client_search_id)
        {
            $found_client = null;
            $clients = Client::getAll();
            foreach($clients as $current_client){
                $current_id = $current_client->getId();
                if ($current_id == $client_search_id) {
                    $found_client = $current_client;
                }
            }
            return $found_client;
        }
    }
?>