<?php
require_once __DIR__. '/../core/BaseModel.php';

class EventModel extends BaseModel {
    public function getAllEvents() {
        $stmt = $this->db->query("SELECT * FROM events WHERE is_deleted = 0" );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEvent($id) {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createEvent($data) {
        $stmt = $this->db->prepare("INSERT INTO events (name, date, location) VALUES (:name, :date, :location)");
        $stmt->execute([
            'name' => $data['name'],
            'date' => $data['date'],
            'location' => $data['location'],
        ]);
        return $this->db->lastInsertId();
    }

    public function updateEvent($id, $data) {
        $stmt = $this->db->prepare("UPDATE events SET name = :name, date = :date, location = :location WHERE id = :id");
        $stmt->execute([
            'name' => $data['name'],
            'date' => $data['date'],
            'location' => $data['location'],
            'id' => $id,
        ]);
    }

    public function deleteEvent($id) {
        $stmt = $this->db->prepare("UPDATE events SET is_deleted = 1 WHERE id = :id");
        // $stmt = $this->db->prepare("DELETE FROM events WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function restoreEvent($data) {
        $stmt = $this->db->prepare("UPDATE events SET is_deleted = 0 WHERE id = :id");
        error_log($data['id']);
        $stmt->execute(['id' => $data['id']]);
    }

    public function  saveAction($userId, $actionType, $eventId, $eventData) {
        $stmt = $this->db->prepare(
            "INSERT INTO action_history (user_id, action_type, entity_id, entity_data, entity_type) VALUES (:user_id, :action_type, :entity_id, :entity_data, :entity_type)"
        );
        $stmt->execute([
            'user_id' => $userId,
            'action_type' => $actionType,
            'entity_id' => $eventId,
            'entity_data' => json_encode($eventData),
            'entity_type' => 'event',
        ]);
    }

    public function getLastAction($userId) {
        $stmt = $this->db->prepare(
            "SELECT * FROM action_history WHERE (user_id = :user_id AND entity_type = 'event')  ORDER BY id DESC LIMIT 1"
        );
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    public function removeAction($actionId) {
        $stmt = $this->db->prepare("DELETE FROM action_history WHERE id = :id");
        $stmt->execute(['id' => $actionId]);
    }
    
}


?>
