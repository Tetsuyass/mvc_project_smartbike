<?php
// app/Controllers/AcceuilController.php
require_once 'BaseController.php';
require_once __DIR__ . '/../Models/Velo.php';

class AccueilController extends BaseController
{
    public function index()
    {
        $veloModel = new Velo($this->db);
        $latest = $veloModel->all();
        $latest = $latest ? $latest[0] : null; // le dernier ajouté (ORDER BY id DESC)
        $this->render('home', ['latest' => $latest]);
    }
}