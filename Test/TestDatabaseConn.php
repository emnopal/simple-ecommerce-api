<?php

require_once __DIR__. "/../Database/Connection.php";

use \Database\Connection;

function test_database_conn(){
    try{
        Connection::connect();
    } catch (PDOException $e){
        echo $e->getMessage();
    }
    echo "Connection successful";
}

test_database_conn();