<?php

require_once __DIR__ . '/../vendor/autoload.php';

class DatabaseMongo {

    public static function connect() {

        // 👉 MONGO ATLAS (HEROKU)
        $uri = getenv("MONGO_URI");

        // 👉 fallback local (si tu travailles sur ton PC)
        if (!$uri) {
            $uri = "mongodb://localhost:27017";
        }

        $client = new MongoDB\Client($uri);

        // base Mongo
        return $client->vite_gourmand2;
    }
}