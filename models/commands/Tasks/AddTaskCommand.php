<?php

require_once __DIR__ . '/../Command.php';
class AddTaskCommand  {
    private $model;
    private $data;
    private $lastInsertedId;

    public function __construct(TaskModel $model, $data) {
        $this->model = $model;
        $this->data = $data;
    }

    public function execute() {
        $this->lastInsertedId = $this->model->createTask($this->data);
    }

    public function undo() {
        if ($this->lastInsertedId) {
            $this->model->deleteTask($this->lastInsertedId);
            echo "Undo: Task addition reverted.";
        } else {
            echo "No task to undo.";
        }
    }
}
?>
