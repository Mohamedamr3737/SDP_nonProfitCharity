<h2>Edit Task</h2>
<form method="POST" action="/tasks/edit/<?= $task['id']; ?>">
    <label for="name">Task Name:</label>
    <input type="text" id="name" name="name" value="<?= $task['name']; ?>" required>
    
    <label for="required_skill">Required Skill:</label>
    <input type="text" id="required_skill" name="required_skill" value="<?= $task['required_skill']; ?>" required>
    
    <label for="is_completed">Completed:</label>
    <input type="checkbox" id="is_completed" name="is_completed" <?= $task['is_completed'] ? 'checked' : ''; ?>>
    
    <button type="submit">Update Task</button>
</form>

<!-- Undo Button -->
<form method="POST" action="/tasks/undo" style="margin-top: 20px;">
    <button type="submit">Undo Last Action</button>
</form>
