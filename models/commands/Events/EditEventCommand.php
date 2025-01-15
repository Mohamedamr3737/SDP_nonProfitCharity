<?php

require_once __DIR__ . '/../Command.php';

class EditEventCommand implements Command {
    private $model;
    private $eventId;
    private $newData;
    private $oldData;
    private $userId;

    public function __construct(EventModel $model, $userId, $eventId, $newData) {
        $this->model = $model;
        $this->userId = $userId;
        $this->eventId = $eventId;
        $this->newData = $newData;
    }

    public function execute() {
        $this->oldData = $this->model->getEvent($this->eventId);
        $this->model->updateEvent($this->eventId, $this->newData);
        $this->model->saveAction($this->userId, 'edit', $this->eventId, $this->oldData);
    }

    public function undo() {
        if ($this->oldData) {
            $this->model->updateEvent($this->eventId, $this->oldData);
            $this->model->saveAction($this->userId, 'edit', $this->eventId, $this->newData);
        }
    }
}
?>
