<?php
require_once 'Database.php'; 

class Vehicules {
    private $pdo;
    private $lignes_par_page = 3;

    public function __construct() {
        $this->pdo = database::getInstance()->getConnection();
    }

    public function getLinesParPage() {
        return $this->lignes_par_page;
    }

    public function NbrVehicules() {
        $query = $this->pdo->prepare("SELECT COUNT(*) AS total FROM vehicules");
        $query->execute();
        $result = $query->fetch();
        return $result['total'];
    }

    public function GetVehicules($page = 1) {
        $offset = ($page - 1) * $this->lignes_par_page;
        $query = $this->pdo->prepare("SELECT * FROM vehicules LIMIT :offset, :limit");
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->bindValue(':limit', $this->lignes_par_page, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
    }
}
