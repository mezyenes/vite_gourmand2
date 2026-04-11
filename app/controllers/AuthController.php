<?php

require_once __DIR__ . '/../models/User.php';

class AuthController {

    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    // 👉 PAGE LOGIN
    public function login() {
        require __DIR__ . '/../views/auth/login.php';
    }

    // 👉 TRAITEMENT LOGIN
    public function loginPost() {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = $user;

            header('Location: index.php');
        } else {
            echo "Email ou mot de passe incorrect";
        }
    }

    // 👉 PAGE REGISTER
    public function register() {
        require __DIR__ . '/../views/auth/register.php';
    }

    // 👉 TRAITEMENT REGISTER
    public function registerPost() {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $adresse = $_POST['adresse'];
        $gsm = $_POST['gsm'];

        $this->userModel->create($nom, $prenom, $email, $password, $adresse, $gsm);

       header('Location: index.php?page=register&success=1');
    }

// function pour affficher le profil du users 


public function profile() {

    

    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=login');
        exit;
    }

    $user = $_SESSION['user'];

    require __DIR__ . '/../views/profile.php';
}
   // changer les information de son profil 

   public function updateProfile() {

    session_start();

    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=login');
        exit;
    }

    $id = $_SESSION['user']['id'];

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $gsm = $_POST['gsm'];

    $this->userModel->updateFull($id, $nom, $prenom, $email, $adresse, $gsm);

    // 🔥 MAJ session
    $_SESSION['user']['nom'] = $nom;
    $_SESSION['user']['prenom'] = $prenom;
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['adresse'] = $adresse;
    $_SESSION['user']['gsm'] = $gsm;

    header('Location: index.php?page=profile&success=1');
}




















public function logout() {

    session_start();
    session_destroy();

    header('Location: index.php');
}






}