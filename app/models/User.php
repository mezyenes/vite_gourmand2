<?php

class User {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($nom, $prenom, $email, $password, $adresse, $gsm) {
        $sql = "INSERT INTO users (nom, prenom, email, password, adresse, gsm)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nom, $prenom, $email, $password, $adresse, $gsm]);
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }


    public function updateFull($id, $nom, $prenom, $email, $adresse, $gsm) {

    $sql = "UPDATE users 
            SET nom = ?, prenom = ?, email = ?, adresse = ?, gsm = ?
            WHERE id = ?";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$nom, $prenom, $email, $adresse, $gsm, $id]);
}
 
// recuperer la liste des users inscris sur le site pour que l admin puisse les voir et activer ou desactiver un compte 
 public function getAllUsers() {

    $sql = "SELECT * FROM users ORDER BY id DESC";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();
}

// activer ou desactiver un compte pour l admin 
public function toggleActive($id) {

    $sql = "UPDATE users 
            SET active = NOT active 
            WHERE id = ?";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$id]);
}


// creer un compte employer par ladmin 
public function createEmployee($nom, $prenom, $email, $password) {

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (nom, prenom, email, password, role, active) 
            VALUES (?, ?, ?, ?, 'employe', 1)";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$nom, $prenom, $email, $password]);
}




}