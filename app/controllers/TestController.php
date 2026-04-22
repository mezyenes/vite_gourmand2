<?php



require_once __DIR__ . '/../../config/DatabaseMongo.php';

class TestController {

    public function mongo() {

        $db = DatabaseMongo::connect();

        $db->test->insertOne([
            'message' => 'mongo fonctionne',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        die("MONGO OK");
    }
}