<?php
require_once __DIR__ . '/../Command.php';

class AddTaskCommand implements Command {
    private $model;
    private $taskData;
    private $userId;
    private $lastInsertedId;

    public function __construct(TaskModel $model, $userId, $taskData) {
        $this->model = $model;
        $this->userId = $userId;
        $this->taskData = $taskData;
    }

    public function execute() {
        $this->lastInsertedId = $this->model->createTask($this->taskData);
        $this->taskData['id'] = $this->lastInsertedId;
        $this->model->saveAction($this->userId, 'add', $this->lastInsertedId, $this->taskData);
    }

    public function undo() {
        $action = $this->model->getLastAction($this->userId);
        if ($action) {
        $taskData = json_decode($action['entity_data'], true);
        $this->model->deleteTask($this->taskData['id']);
    }
}
}
?>
