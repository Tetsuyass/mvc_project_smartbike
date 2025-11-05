<?php
// app/Models/Velo.php
require_once 'Model.php';

class Velo extends Model
{
    public function all()
    {
        $stmt = $this->pdo->query('SELECT * FROM velos ORDER BY id DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM velos WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}