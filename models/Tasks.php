<?php
class TaskModel extends BaseModel {    
    public function createTask($data) {
    $stmt = $this->db->prepare("INSERT INTO tasks (event_id, name, required_skill) VALUES (:event_id, :name, :required_skill)");
    $stmt->execute($data);
    $taskId = $this->db->lastInsertId();

    // Log the 'add' action in the actions table
    $stmt = $this->db->prepare("INSERT INTO actions (entity_type, entity_id, action_type, previous_data, user_id) 
                                VALUES ('task', :entity_id, 'add', NULL, :user_id)");
    $stmt->execute(['entity_id' => $taskId, 'user_id' => $_SESSION['user_id']]);

    return $taskId;
    }

    public function getTasksByEvent($eventId, $includeDeleted = false) {
        $query = $includeDeleted 
            ? "SELECT * FROM tasks WHERE event_id = :event_id" 
            : "SELECT * FROM tasks WHERE event_id = :event_id AND is_deleted = 0";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['event_id' => $eventId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTaskById($id) {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTask($id, $data) {
        $existingData = $this->getTaskById($id);
        $stmt = $this->db->prepare("UPDATE tasks SET name = :name, required_skill = :required_skill WHERE id = :id");
        $stmt->execute(array_merge($data, ['id' => $id]));

        // Log the 'update' action in the actions table
        $stmt = $this->db->prepare("INSERT INTO actions (entity_type, entity_id, action_type, previous_data, user_id) 
                                    VALUES ('task', :entity_id, 'update', :previous_data, :user_id)");
        $stmt->execute([
            'entity_id' => $id,
            'previous_data' => json_encode($existingData),
            'user_id' => $_SESSION['user_id']
        ]);

        return true;
    }

    public function deleteTask($id) {
        $stmt = $this->db->prepare("UPDATE tasks SET is_deleted = 1 WHERE id = :id");
        $stmt->execute(['id' => $id]);

        // Log the 'delete' action in the actions table
        $stmt = $this->db->prepare("INSERT INTO actions (entity_type, entity_id, action_type, previous_data, user_id) 
                                    VALUES ('task', :entity_id, 'delete', NULL, :user_id)");
        $stmt->execute(['entity_id' => $id, 'user_id' => $_SESSION['user_id']]);

        return true;
    }
    public function restoreTask($id) {
        $stmt = $this->db->prepare("UPDATE tasks SET is_deleted = 0 WHERE id = :id");
        $stmt->execute(['id' => $id]);

        return true;
    }

    // Get the last action of a user
    public function getLastAction($entityType) {
        $stmt = $this->db->prepare("SELECT * FROM actions WHERE entity_type = :entity_type AND user_id = :user_id AND is_undone = 0 ORDER BY created_at DESC LIMIT 1");
        $stmt->execute([
            'entity_type' => $entityType,
            'user_id' => $_SESSION['user_id'],
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get the last undone action
    public function getLastUndoneAction($entityType) {
        $stmt = $this->db->prepare("SELECT * FROM actions WHERE entity_type = :entity_type AND user_id = :user_id AND is_undone = 1 ORDER BY created_at DESC LIMIT 1");
        $stmt->execute([
            'entity_type' => $entityType,
            'user_id' => $_SESSION['user_id'],
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function markActionAsUndone($actionId) {
        $stmt = $this->db->prepare("UPDATE actions SET is_undone = 1 WHERE id = :id");
        $stmt->execute(['id' => $actionId]);
    }

    public function markActionAsActive($actionId) {
        $stmt = $this->db->prepare("UPDATE actions SET is_undone = 0 WHERE id = :id");
        $stmt->execute(['id' => $actionId]);
    }
}
