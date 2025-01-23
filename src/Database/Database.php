<?php

namespace App\Database;

use PDO;

class Database
{
    private PDO $pdo;
    private static ?Database $instance = null;

    // Lit la config de la BDD à partir du fichier config.ini, du dossier config, qui est analysé avec parse_ini_file()
    // et renvoie un tableau associatif de valeurs de configuration
    private function __construct() {
        if (!$config = parse_ini_file(__ROOT__ . 'config/config.ini', true)) {
            throw new \Exception('Erreur d\'accès au fichier de configuration config.ini');
        }

        $dsn = sprintf(
            '%s:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $config['database']['driver'],
            $config['database']['host'],
            $config['database']['port'],
            $config['database']['dbname']
        );

        $this->pdo = new PDO($dsn, $config['database']['user'], $config['database']['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function __destruct() {
        unset($this->pdo);
    }

    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Execute une requête SELECT et renvoie un tableau de lignes sous forme de tableaux associatifs
    public function query(string $sql, array $params = []): array {
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return $query->fetchAll();
    }

    // Execute une requête SELECT et une seule sous forme de tableau associatif
    public function queryOne(string $sql, array $params = []): array {
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return $query->fetch();
    }

    // Execute une requête INSERT ou UPDATE et ne renvoie aucun résultat
    public function execute(string $sql, array $params = []): void {
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
    }
}
