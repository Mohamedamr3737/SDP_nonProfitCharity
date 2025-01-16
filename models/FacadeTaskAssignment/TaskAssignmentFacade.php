<?php

require_once __DIR__ . '/../User.php';
require_once __DIR__ .  '/../Tasks.php';

class TaskAssignmentFacade {
    private $userModel;
    private $taskModel;

    public function __construct(User $userModel, TaskModel $taskModel) {
        $this->userModel = $userModel;
        $this->taskModel = $taskModel;
    }

    public function assignTaskToUser($taskId) {
        // Fetch the task details
        $task = $this->taskModel->getTask($taskId);
    
        if (!$task) {
            return "Task not found.";
        }
    
        // Fetch users with the required skill and availability
        $users = $this->userModel->findAvailableUsersBySkill($task['required_skill']);
    
        if (empty($users)) {
            return "No available users with the required skill.";
        }

        // Assign the task to the first available user
        $assignedUser = $users[0];
        $task['assigned_to'] =  $assignedUser['id'];
        $this->taskModel->updateTask($taskId, $task);
        $this->userModel->setAvailability($assignedUser['id'], 'busy');
    
        return "Task '{$task['name']}' assigned to user: {$assignedUser['firstName']} {$assignedUser['lastName']}.";
    }
    
}
?>
