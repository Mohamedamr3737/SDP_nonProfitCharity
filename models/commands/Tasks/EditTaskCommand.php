<?php
require_once __DIR__ . '/../Command.php';

class EditTaskCommand implements Command {
    private $model;
    private $taskId;
    private $newData;
    private $oldData;
    private $userId;

    public function __construct(TaskModel $model, $userId, $taskId, $newData) {
        $this->model = $model;
        $this->userId = $userId;
        $this->taskId = $taskId;
        $this->newData = $newData;
    }

    public function execute() {
        $this->oldData = $this->model->getTask($this->taskId);
        $this->model->updateTask($this->taskId, $this->newData);
        $this->model->saveAction($this->userId, 'edit', $this->taskId, $this->oldData);
    }

    public function undo() {
        $action = $this->model->getLastAction($this->userId);
        if ($action) {
        $taskData = json_decode($action['entity_data'], true);
        if($taskData){
        error_log($taskData['name']);
        $this->model->updateTask($taskData['id'], $taskData);
        }
    }
}
}
?>
