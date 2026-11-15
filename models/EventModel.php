<?php
class EventModel
{
    private $db;
    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function all()
    {
        return $this->db->query('SELECT e.*, c.libelle AS categorie,
            (SELECT COUNT(*) FROM inscriptions i WHERE i.evenement_id=e.id) AS inscrits
            FROM evenements e JOIN categories c ON c.id=e.categorie_id ORDER BY e.date_evenement')->fetchAll();
    }
    public function find($id)
    {
        $s = $this->db->prepare('SELECT * FROM evenements WHERE id=?');
        $s->execute([$id]);
        return $s->fetch();
    }
    public function categories()
    {
        return $this->db->query('SELECT * FROM categories ORDER BY libelle')->fetchAll();
    }
    public function save($data)
    {
        if (!empty($data['id'])) {
            $s = $this->db->prepare('UPDATE evenements SET titre=?, description=?, date_evenement=?, lieu=?, nombre_places=?, categorie_id=? WHERE id=?');
            $s->execute([$data['titre'], $data['description'], $data['date_evenement'], $data['lieu'], $data['nombre_places'], $data['categorie_id'], $data['id']]);
        } else {
            $s = $this->db->prepare('INSERT INTO evenements (titre,description,date_evenement,lieu,nombre_places,categorie_id) VALUES (?,?,?,?,?,?)');
            $s->execute([$data['titre'], $data['description'], $data['date_evenement'], $data['lieu'], $data['nombre_places'], $data['categorie_id']]);
        }
    }
    public function delete($id)
    {
        $s = $this->db->prepare('DELETE FROM evenements WHERE id=?');
        $s->execute([$id]);
    }
}
