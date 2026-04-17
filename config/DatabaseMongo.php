<?php

require_once __DIR__ . '/../vendor/autoload.php';

class DatabaseMongo {

    public static function connect() {

        // connexion au serveur Mongo
        $client = new MongoDB\Client("mongodb://localhost:27017");

        // choisir ma base sql vite_gourmand2 et on les relie dans mongosh avec 
        // use vite_gourmand2
        return $client->vite_gourmand2;
    }
}