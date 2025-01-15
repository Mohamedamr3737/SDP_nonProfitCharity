<?php
require_once __DIR__.'/../models/Events.php';
require_once __DIR__. '/../models/commands/Events/AddEventCommand.php';
require_once __DIR__. '/../models/commands/Events/EditEventCommand.php';
require_once __DIR__. '/../models/commands/Events/DeleteEventCommand.php';
require_once __DIR__. '/../models/commands/SessionInvoker.php';

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
            $eventData = json_decode($action['event_data'], true);

            if ($action['action_type'] === 'add') {
                $this->model->deleteEvent($action['event_id']);
            } elseif ($action['action_type'] === 'edit') {
                $this->model->updateEvent($action['event_id'], $eventData);
            } elseif ($action['action_type'] === 'delete') {
                $this->model->restoreEvent($eventData);
            }

            $this->model->removeAction($action['id']);
        }
    }

    // Redo the last undone action
    public function redo() {
        $action = $this->model->getLastRedoAction($this->userId);
        if ($action) {
            $eventData = json_decode($action['event_data'], true);

            if ($action['action_type'] === 'add') {
                $this->model->restoreEvent($eventData);
            } elseif ($action['action_type'] === 'edit') {
                $this->model->updateEvent($action['event_id'], $eventData);
            } elseif ($action['action_type'] === 'delete') {
                $this->model->deleteEvent($action['event_id']);
            }

            $this->model->removeAction($action['id']);
        }
    }
}
?>
