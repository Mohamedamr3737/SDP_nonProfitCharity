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
        $this->model->deleteEvent($this->eventId);
        $this->model->saveAction($this->userId, 'delete', $this->eventId, $this->oldData);
    }

    public function undo() {
        if ($this->oldData) {
            $this->model->restoreEvent($this->oldData);
            $this->model->saveAction($this->userId, 'add', $this->eventId, $this->oldData);
        }
    }
}
?>
