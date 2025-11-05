<?php
// app/Controllers/ProductController.php
require_once 'BaseController.php';
require_once __DIR__ . '/../Models/Velo.php';


class ProduitController extends BaseController
{
    public function index()
    {
        $velos = (new Velo($this->db))->all();
        $this->render('products', ['velos' => $velos]);
    }


    public function detail()
    {
        $id = isset($_GET['velo']) ? (int)$_GET['velo'] : 0;
        $v = (new Velo($this->db))->find($id);
        if (!$v) {
            header('HTTP/1.0 404 Not Found');
            echo 'Vélo introuvable';
            exit;
        }
        $this->render('product_detail', ['velo' => $v]);
    }
}
