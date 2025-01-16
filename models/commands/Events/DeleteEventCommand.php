<?php

require_once __DIR__ . '/../Command.php';

class DeleteEventCommand implements Command {
    private $model;
    private $eventId;
    private $userId;
    private $oldData;

    public function __construct(EventModel $model, $userId, $eventId) {
        $this->model = $model;
        $this->userId = $userId;
        $this->eventId = $eventId;
    }

    public function execute() {
        $this->oldData = $this->model->getEvent($this->eventId);
        error_log("aaaaaaa".$this-> oldData);

        $this->model->deleteEvent($this->eventId);
        $this->model->saveAction($this->userId, 'delete', $this->eventId, $this->oldData);
    }

    public function undo() {
        $action = $this->model->getLastAction($this->userId);
        if ($action) {
            $eventData = json_decode($action['entity_data'], true);
        
        if ($eventData) {
            $this->model->restoreEvent($eventData);
        }
    }
    }
}
?>
