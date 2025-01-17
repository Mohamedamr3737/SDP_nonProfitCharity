<?php
require_once __DIR__.'/../models/Events.php';
require_once __DIR__. '/../models/commands/Events/AddEventCommand.php';
require_once __DIR__. '/../models/commands/Events/EditEventCommand.php';
require_once __DIR__. '/../models/commands/Events/DeleteEventCommand.php';

class EventController {
    private $model;
    private $userId;

    public function __construct(EventModel $model, $userId) {
        $this->model = $model;
        $this->userId = $userId;
    }

    // Fetch all events for the list view
    public function getAllEvents() {
        return $this->model->getAllEvents();
    }

    public function getEvent($id) {
        return $this->model->getEvent($id);
    }
    
    // Add a new event
    public function addEvent($data) {
        $command = new AddEventCommand($this->model, $this->userId, $data);
        $command->execute();
    }

    // Edit an existing event
    public function editEvent($id, $data) {
        $command = new EditEventCommand($this->model, $this->userId, $id, $data);
        $command->execute();
    }

    // Delete an event
    public function deleteEvent($id) {
        $command = new DeleteEventCommand($this->model, $this->userId, $id);
        $command->execute();
    }

    // Undo the last action    
    public function undo() {
        $action = $this->model->getLastAction($this->userId);
        if ($action) {
            $eventData = json_decode($action['entity_data'], true);

            if ($action['action_type'] === 'add') {
                $command = new AddEventCommand($this->model, $this->userId, $eventData);
            } elseif ($action['action_type'] === 'edit') {
                $command = new EditEventCommand($this->model, $this->userId, $action['entity_id'], $eventData);
            } elseif ($action['action_type'] === 'delete') {
                $command = new DeleteEventCommand($this->model, $this->userId, $action['entity_id']);
            }

            $command->undo();
            $this->model->removeAction($action['id']);
        }
    }
    public function getFutureEvents() {
        return $this->model->getFutureEvents();
    }
    public function registerForEvent($userId, $eventId) {
        if (empty($userId) || empty($eventId)) {
            throw new Exception("User ID or Event ID cannot be null.");
        }
    
        return $this->model->registerForEvent($userId, $eventId);
    }
 
    
    public function getEventRegistrations() {
        return $this->model->getEventRegistrations();
    }
    public function markAttendance($registrationId) {
        if (empty($registrationId)) {
            throw new Exception("Registration ID is required.");
        }
    
        $this->model->updateAttendance($registrationId);
    }
    
    
    
    
    
}
?>
