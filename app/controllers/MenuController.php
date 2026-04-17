<?php

require_once __DIR__ . '/../models/Menu.php';

class MenuController {

    private $menuModel;

    public function __construct($pdo) {
        $this->menuModel = new Menu($pdo);
    }

    //  afficher tous les menus
    public function index() {

        $menus = $this->menuModel->getAll();

        require __DIR__ . '/../views/menu.php';
    }

    //  afficher détail d’un menu avec la funcion show 
    public function show() {

        $id = $_GET['id'];

        $menu = $this->menuModel->getById($id);

        require __DIR__ . '/../views/show_menu.php';
    }

}