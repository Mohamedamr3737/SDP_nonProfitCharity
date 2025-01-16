<?php
require_once __DIR__ . '/../models/Tasks.php';
require_once __DIR__ . '/../models/commands/Tasks/AddTaskCommand.php';
require_once __DIR__ . '/../models/commands/Tasks/EditTaskCommand.php';
require_once __DIR__ . '/../models/commands/Tasks/DeleteTaskCommand.php';

class TaskController {
    private $model;
    private $userId;

    public function __construct(TaskModel $model, $userId) {
        $this->model = $model;
        $this->userId = $userId;
    }

    public function getAllTasks() {
        return $this->model->getAllTasks();
    }

    public function getAllTasksByEvent($eventId) {
        return $this->model->getAllTasksByEvent($eventId);
    }
    public function getTask($id) {
        return $this->model->getTask($id);
    }
    public function addTask($data) {
        $command = new AddTaskCommand($this->model, $this->userId, $data);
        $command->execute();
    }

    public function editTask($id, $data) {
        $command = new EditTaskCommand($this->model, $this->userId, $id, $data);
        $command->execute();
    }

    public function deleteTask($id) {
        $command = new DeleteTaskCommand($this->model, $this->userId, $id);
        $command->execute();
    }

    public function undo() {
        $action = $this->model->getLastAction($this->userId);
        if ($action) {
            $taskData = json_decode($action['entity_data'], true);

            if ($action['action_type'] === 'add') {
                $command = new AddTaskCommand($this->model, $this->userId, $taskData);
            } elseif ($action['action_type'] === 'edit') {
                $command = new EditTaskCommand($this->model, $this->userId, $action['entity_id'], $taskData);
            } elseif ($action['action_type'] === 'delete') {
                $command = new DeleteTaskCommand($this->model, $this->userId, $action['entity_id']);
            }

            $command->undo();
            $this->model->removeAction($action['id']);
        }
    }
}
?>
