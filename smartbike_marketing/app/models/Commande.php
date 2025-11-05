<?php
// app/Models/Commande.php
require_once 'Model.php';

class Commande extends Model
{
    public function create(array $data)
    {
        $sql = 'INSERT INTO commandes (velo_id, nom, prenom, email, message, created_at) VALUES (:velo_id, :nom, :prenom, :email, :message, NOW())';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'velo_id' => $data['velo_id'],
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'message' => $data['message'],
        ]);
    }
}