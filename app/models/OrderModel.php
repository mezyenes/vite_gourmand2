<?php

require_once __DIR__ . '/../../config/DatabaseMongo.php';

class OrderModel {

    // =========================
    // 📊 NOMBRE DE COMMANDES PAR MENU
    // =========================
    public static function getOrdersByMenu() {

        $db = DatabaseMongo::connect();

        $result = $db->orders->aggregate([
            [
                '$group' => [
                    '_id' => '$menu_name',
                    
                    // 🟢 total commandes (sécurisé)
                    'total_orders' => [
                        '$sum' => [
                            '$ifNull' => ['$quantity', 1]
                        ]
                    ]
                ]
            ],
            [
                '$sort' => ['total_orders' => -1]
            ]
        ]);

        return $result->toArray();
    }

    // =========================
    // 💰 CHIFFRE D'AFFAIRES PAR MENU
    // =========================
    public static function getRevenueByMenu() {

        $db = DatabaseMongo::connect();

        $result = $db->orders->aggregate([
            [
                '$group' => [
                    '_id' => '$menu_name',

                    // 🟢 total revenu propre
                    'total_revenue' => [
                        '$sum' => [
                            '$ifNull' => ['$total', 0]
                        ]
                    ],

                    // 🟢 bonus utile dashboard
                    'total_delivery' => [
                        '$sum' => [
                            '$ifNull' => ['$delivery_price', 0]
                        ]
                    ],

                    // 🟢 prix moyen
                    'avg_order' => [
                        '$avg' => [
                            '$ifNull' => ['$total', 0]
                        ]
                    ]
                ]
            ],
            [
                '$sort' => ['total_revenue' => -1]
            ]
        ]);

        return $result->toArray();
    }
}