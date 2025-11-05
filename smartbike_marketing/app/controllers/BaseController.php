<?php
// app/Controllers/BaseController.php

abstract class BaseController
{
    /**
     * Configuration globale (venant de config/config.php)
     * @var array
     */
    protected array $config;

    /**
     * Instance PDO pour la base de données
     * @var PDO
     */
    protected PDO $db;

    /**
     * Constructeur : initialise la configuration et la connexion DB
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->db = $this->initPDO();
    }

    /**
     * Initialise la connexion PDO à PostgreSQL
     */
    protected function initPDO(): PDO
    {
        $db = $this->config['db'];
        $dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s', $db['host'], $db['port'], $db['dbname']);

        try {
            $pdo = new PDO($dsn, $db['user'], $db['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
            return $pdo;
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }

    /**
     * Rend une vue avec le header et footer automatiques
     *
     * @param string $view Nom du fichier vue sans extension (ex: 'home')
     * @param array $data Variables disponibles dans la vue
     */
    protected function render(string $view, array $data = []): void
    {
        extract($data); // crée des variables à partir du tableau
        $base_url = $this->config['base_url'];

        require __DIR__ . '/../views/header.php';
        require __DIR__ . '/../views/' . $view . '.php';
        require __DIR__ . '/../views/footer.php';
    }

    /**
     * Redirige vers une autre route
     */
    protected function redirect(string $page): void
    {
        header('Location: index.php?page=' . urlencode($page));
        exit;
    }

    /**
     * Définit un message flash en session (affiché une fois)
     */
    protected function flash(string $message): void
    {
        $_SESSION['flash'] = $message;
    }
}
