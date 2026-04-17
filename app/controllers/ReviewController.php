<?php

require_once __DIR__ . '/../models/Review.php';

class ReviewController {

    private $reviewModel;

    public function __construct($pdo) {
        $this->reviewModel = new Review($pdo);
    }

    //  formulaire pour les avis 
    public function form() {

        

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $order_id = $_GET['order_id'];

        require __DIR__ . '/../views/review_form.php';
    }

    //  enregistrer
    public function create() {

        

        $this->reviewModel->create(
            $_POST['order_id'],
            $_SESSION['user']['id'],
            $_POST['rating'],
            $_POST['comment']
        );

        header('Location: index.php?page=myOrders');
    }

    //  recuperer lavis pour le valider ou le supprimer 
    public function admin() {

        

        $reviews = $this->reviewModel->getPending();

        require __DIR__ . '/../views/employee_reviews.php';
    }

    public function approve() {
        $this->reviewModel->approve($_GET['id']);
        header('Location: index.php?page=employeeReviews');
    }

    public function reject() {
        $this->reviewModel->reject($_GET['id']);
        header('Location: index.php?page=employeeReviews');
    }
}