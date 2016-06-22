<?php
    namespace Pluto\Application\Database;

    class Database {

        public $Main;
        public $Slave;

        public function __construct()
        {
    	    global $database;

    	    $this->Main = self::Connection(
    	        $database['host'], 
                $database['username'],
                $database['password'],
                $database['database']
    	    );
        }

        public function Connection($host, $username, $password, $database)
        {
          try {
            $Connection = new \PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password);
            $Connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
          } catch (\PDOException $e) {
            print "Error " . $e->getMessage();
            die();
          }

          return $Connection;
        }

    }
