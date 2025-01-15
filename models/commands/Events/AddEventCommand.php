<?php

require_once __DIR__ . '/../Command.php';


class AddEventCommand implements Command {
    private $model;
    private $eventData;
    private $userId;
    private $lastInsertedId;

    public function __construct(EventModel $model, $userId, $eventData) {
        $this->model = $model;
        $this->userId = $userId;
        $this->eventData = $eventData;
    }

    public function execute() {
        $this->lastInsertedId = $this->model->createEvent($this->eventData);
        $this->eventData['id'] = $this->lastInsertedId;
        $this->model->saveAction($this->userId, 'add', $this->lastInsertedId, $this->eventData);
    }

    public function undo() {
        if ($this->lastInsertedId) {
            $this->model->deleteEvent($this->lastInsertedId);
            $this->model->saveAction($this->userId, 'delete', $this->lastInsertedId, $this->eventData);
        }
    }
}
?>

