<?php 
	class Stylist
	{
		private $name;
		private $id;

		function __construct($name, $id = null)
		{
			$this->name = $name;
			$this->id = $id;
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

		function save()
		{
			$GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();

		}

		static function getAll()
		{
			$db_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach ($db_stylists as $stylist) {
                $name = $stylist['name'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($name, $id);
                array_push($stylists, $new_stylist);
			}
			return $stylists;
		}

		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM stylists *;");
		}

		static function find(search_id)
		{
			$found_stylist = null;
			$stylists = Stylist::getAll();
			foreach($stylists as $stylist) {
				$stylist_id = $stylist->getId();
				if (stylist_id == $search_id) {
					$found_stylist = $stylist;
				}
				return $found_stylist;
			}
			
		}

		function update($new_name)
		{
			$GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = {$this->getId()};");
			$this->setName($new_name);
		}

		function delete()
		{
			$GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
        	$GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getId()};");
    	}

    	function findClients()
    	{
    		$found_clients = array();
    		$table_matches = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
            foreach($table_matches as $row) {
                $name = $row['name'];
                $id = $row['id'];
                $stylist_id = $row['stylist_id'];
                $new_client = new Client($name, $id, $stylist_id);
                array_push($found_clients, $new_client);
    	}
    	return $found_clients;
	}