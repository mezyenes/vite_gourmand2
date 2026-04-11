<?php

require_once __DIR__ . '/../models/Setting.php';
require_once __DIR__ . '/../models/Review.php';

class HomeController {

    private $settingModel;
    private $reviewModel;

    public function __construct($pdo) {
        $this->settingModel = new Setting($pdo);
        $this->reviewModel = new Review($pdo);
    }

    public function index() {

        $hours = $this->settingModel->getHours();

        // ✅ récupérer les avis VALIDÉS
        $reviews = $this->reviewModel->getApproved();

        require __DIR__ . '/../views/home.php';
    }
}