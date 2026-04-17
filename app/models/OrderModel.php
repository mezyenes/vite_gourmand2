<?php

require_once __DIR__ . '/../../config/DatabaseMongo.php';

class OrderModel {

    //  nombre de commandes par menu
    public static function getOrdersByMenu() {

        $db = DatabaseMongo::connect();

        $result = $db->orders->aggregate([
            [
                '$group' => [
                    '_id' => '$menu_name',
                    'total_orders' => ['$sum' => '$quantity']
                ]
            ]
        ]);

        return $result->toArray();
    }

    // chiffre d'affaires par menu
    public static function getRevenueByMenu() {

        $db = DatabaseMongo::connect();

        $result = $db->orders->aggregate([
            [
                '$group' => [
                    '_id' => '$menu_name',
                    'total_revenue' => ['$sum' => '$total']
                ]
            ]
        ]);

        return $result->toArray();
    }
}