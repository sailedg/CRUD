<?php

const host = "localhost";
const db = "crud";
const user = "root";
const pass = "";
const utf8 = "utf8";

const gestorDB = "mysql:host=".host.";dbname=".db.";charset=".utf8;

class dbconexion{
    protected function conexion(){
        $conex = new PDO(gestorDB,user,pass);
        $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conex;
    }
}


?>