<?php
class ParticipantModel
{
    private $db;
    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function all()
    {
        return $this->db->query('SELECT * FROM participants ORDER BY nom, prenom')->fetchAll();
    }
    public function find($id)
    {
        $s = $this->db->prepare('SELECT * FROM participants WHERE id=?');
        $s->execute([$id]);
        return $s->fetch();
    }
    public function save($d)
    {
        if (!empty($d['id'])) {
            $s = $this->db->prepare('UPDATE participants SET nom=?, prenom=?, email=?, telephone=?, ville=? WHERE id=?');
            $s->execute([$d['nom'], $d['prenom'], $d['email'], $d['telephone'], $d['ville'], $d['id']]);
        } else {
            $s = $this->db->prepare('INSERT INTO participants (nom,prenom,email,telephone,ville) VALUES (?,?,?,?,?)');
            $s->execute([$d['nom'], $d['prenom'], $d['email'], $d['telephone'], $d['ville']]);
        }
    }
    public function delete($id)
    {
        $s = $this->db->prepare('DELETE FROM participants WHERE id=?');
        $s->execute([$id]);
    }
}
