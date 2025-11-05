<?php
// app/Models/Contact.php
require_once 'Model.php';

class Contact extends Model
{
    public function create(array $data)
    {
        $sql = 'INSERT INTO contacts (nom, prenom, email, message, created_at) VALUES (:nom, :prenom, :email, :message, NOW())';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'message' => $data['message'],
        ]);
    }
}