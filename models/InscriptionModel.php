<?php
class InscriptionModel
{
    private $db;
    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function allEvents()
    {
        return $this->db->query('SELECT e.id,e.titre,e.nombre_places,
          (SELECT COUNT(*) FROM inscriptions i WHERE i.evenement_id=e.id) AS inscrits
          FROM evenements e ORDER BY e.date_evenement')->fetchAll();
    }
    public function participants()
    {
        return $this->db->query('SELECT id, nom, prenom, email FROM participants ORDER BY nom')->fetchAll();
    }
    public function listForEvent($id)
    {
        $s = $this->db->prepare('SELECT p.*, i.id AS inscription_id, i.date_inscription FROM inscriptions i JOIN participants p ON p.id=i.participant_id WHERE i.evenement_id=? ORDER BY i.date_inscription DESC');
        $s->execute([$id]);
        return $s->fetchAll();
    }
    public function add($participantId, $eventId)
    {
        $s = $this->db->prepare('SELECT nombre_places FROM evenements WHERE id=?');
        $s->execute([$eventId]);
        $event = $s->fetch();
        if (!$event) throw new Exception('Événement introuvable.');
        $s = $this->db->prepare('SELECT COUNT(*) FROM inscriptions WHERE evenement_id=?');
        $s->execute([$eventId]);
        $count = (int)$s->fetchColumn();
        if ($count >= (int)$event['nombre_places']) throw new Exception('Événement complet : aucune place restante.');
        $s = $this->db->prepare('SELECT COUNT(*) FROM inscriptions WHERE evenement_id=? AND participant_id=?');
        $s->execute([$eventId, $participantId]);
        if ((int)$s->fetchColumn() > 0) throw new Exception('Ce participant est déjà inscrit à cet événement.');
        $s = $this->db->prepare('INSERT INTO inscriptions (participant_id, evenement_id) VALUES (?,?)');
        $s->execute([$participantId, $eventId]);
    }
    public function delete($id)
    {
        $s = $this->db->prepare('DELETE FROM inscriptions WHERE id=?');
        $s->execute([$id]);
    }
}
