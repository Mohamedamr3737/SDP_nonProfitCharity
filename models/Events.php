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
    public function getFutureEvents() {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE date >= CURDATE() AND is_deleted = 0 ORDER BY date ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function registerForEvent($userId, $eventId) {
        $stmt = $this->db->prepare("
            INSERT INTO event_registrations (user_id, event_id)
            VALUES (:user_id, :event_id)
        ");
        $stmt->execute([
            'user_id' => $userId,
            'event_id' => $eventId
        ]);
        return true;
    }
    
    public function getEventRegistrations() {
        $stmt = $this->db->prepare("
            SELECT 
                er.id AS registration_id, 
                u.firstName AS user_first_name, 
                u.email AS user_email, 
                e.name AS event_name, 
                er.is_attended
            FROM event_registrations er
            JOIN users u ON er.user_id = u.id
            JOIN events e ON er.event_id = e.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateAttendance($registrationId) {
        $stmt = $this->db->prepare("
            UPDATE event_registrations
            SET is_attended = 1
            WHERE id = :registration_id
        ");
        $stmt->execute(['registration_id' => $registrationId]);
    }
    
    
    
    
    
    
}


?>
