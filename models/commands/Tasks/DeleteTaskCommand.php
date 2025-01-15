<?php
class DeleteTaskCommand  {
    private $model;
    private $taskId;
    private $previousState;

    public function __construct(TaskModel $model, $taskId) {
        $this->model = $model;
        $this->taskId = $taskId;
    }

    public function execute() {
        $this->previousState = $this->model->getTaskById($this->taskId);
        $this->model->deleteTask($this->taskId);
        echo "Task deleted successfully!";
    }

    public function undo() {
        if ($this->previousState) {
            $this->model->restoreTask($this->taskId);
            echo "Undo: Task deletion reverted.";
        } else {
            echo "No task deletion to undo.";
        }
    }

    public function getData() {
        return [$this->data];
    }
}
?>
