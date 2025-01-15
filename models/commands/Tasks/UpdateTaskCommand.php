<?php
class UpdateTaskCommand  {
    private $model;
    private $taskId;
    private $data;
    private $previousState;

    public function __construct(TaskModel $model, $taskId, $data) {
        $this->model = $model;
        $this->taskId = $taskId;
        $this->data = $data;
    }

    public function execute() {
        $this->previousState = $this->model->getTaskById($this->taskId);
        $this->model->updateTask($this->taskId, $this->data);
        echo "Task updated successfully!";
    }

    public function undo() {
        if ($this->previousState) {
            $this->model->updateTask($this->taskId, $this->previousState);
            echo "Undo: Task update reverted.";
        } else {
            echo "No previous state to undo.";
        }
    }

    public function getData() {
        return [$this->eventId, $this->newData];
    }
    
}
?>
