<?php
echo "test";
require 'models/OrderModel.php';

$data = OrderModel::getOrdersByMenu();

echo "<pre>";
print_r($data);