<?php
require_once __DIR__ . '/../core/BaseModel.php';

class TaskModel extends BaseModel {
    public function getAllTasksByEvent($eventId) {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE event_id = :event_id AND is_deleted = 0");
        $stmt->execute(['event_id' => $eventId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTask($id) {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = :id AND is_deleted = 0");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllTasks() {
        $stmt = $this->db->query(
            "SELECT tasks.*, events.name AS event_name 
            FROM tasks 
            LEFT JOIN events ON tasks.event_id = events.id 
            WHERE tasks.is_deleted = 0"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createTask($data) {
        $stmt = $this->db->prepare("INSERT INTO tasks (event_id, name, required_skill, is_completed, hours) VALUES (:event_id, :name, :required_skill, :is_completed, :hours)");
        $stmt->execute([
            'event_id' => $data['event_id'],
            'name' => $data['name'],
            'required_skill' => $data['required_skill'],
            'is_completed' => $data['is_completed'] ?? 0,
            'hours' => $data['hours'],
        ]);
        return $this->db->lastInsertId();
    }

    public function updateTask($id, $data) {
        // Update the task
        $query = "UPDATE tasks SET name = :name, required_skill = :required_skill, is_completed = :is_completed, hours = :hours";
        if (isset($data['assigned_to'])) {
            $query .= ", assigned_to = :assigned_to";
        }
        $query .= " WHERE id = :id";
    
        $stmt = $this->db->prepare($query);
        $params = [
            'name' => $data['name'],
            'required_skill' => $data['required_skill'],
            'is_completed' => $data['is_completed'] ?? 0,
            'hours' => $data['hours'],
            'id' => $id,
        ];
        if (isset($data['assigned_to'])) {
            $params['assigned_to'] = $data['assigned_to'];
        }
    
        $stmt->execute($params);
        error_log(json_encode($data));
        $thisTask = $this->getTask($data['id']);
        error_log(message: "aaaaaa ".json_encode($thisTask));
        // Update the user's availability
        if (isset($thisTask['assigned_to'])) {
            $userAvailability = ($data['is_completed'] == 1) ? 'available' : 'busy';
            $this->setAvailability($thisTask['assigned_to'], $userAvailability);
        }
    }
    
    public function setAvailability($userId, $availability) {
        // Define valid availability states
        $validStates = ['available', 'busy', 'unavailable'];
    
        // Check if the provided availability state is valid
        if (!in_array($availability, $validStates)) {
            throw new InvalidArgumentException("Invalid availability state. Valid states are: 'available', 'busy', 'unavailable'.");
        }
    
        // Update the availability in the database
        $stmt = $this->db->prepare("UPDATE users SET availability = :availability WHERE id = :id");
        $stmt->execute([
            'availability' => $availability,
            'id' => $userId,
        ]);
    }
    
    
    public function deleteTask($id) {
        $stmt = $this->db->prepare("UPDATE tasks SET is_deleted = 1 WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function saveAction($userId, $actionType, $taskId, $taskData) {
        $stmt = $this->db->prepare(
            "INSERT INTO action_history (user_id, action_type, entity_id, entity_data, entity_type) VALUES (:user_id, :action_type, :entity_id, :entity_data, :entity_type)"
        );
        $stmt->execute([
            'user_id' => $userId,
            'action_type' => $actionType,
            'entity_id' => $taskId,
            'entity_data' => json_encode($taskData),
            'entity_type' => 'task',
        ]);
    }

    public function getLastAction($userId) {
        $stmt = $this->db->prepare(
            "SELECT * FROM action_history WHERE user_id = :user_id AND entity_type = 'task' ORDER BY id DESC LIMIT 1"
        );
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function removeAction($actionId) {
        $stmt = $this->db->prepare("DELETE FROM action_history WHERE id = :id");
        $stmt->execute(['id' => $actionId]);
    }

    public function restoreTask($data) {
        $stmt = $this->db->prepare("UPDATE tasks SET is_deleted = 0 WHERE id = :id");
        error_log($data['id']);
        $stmt->execute(['id' => $data['id']]);
    }

}
?>
