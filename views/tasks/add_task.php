<h2>Add Task</h2>
<form method="POST" action="/tasks/add">
    <label for="event_id">Event ID:</label>
    <input type="number" id="event_id" name="event_id" required>
    
    <label for="name">Task Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="required_skill">Required Skill:</label>
    <input type="text" id="required_skill" name="required_skill" required>
    
    <button type="submit">Add Task</button>
</form>

<!-- Undo Button -->
<form method="POST" action="/tasks/undo" style="margin-top: 20px;">
    <button type="submit">Undo Last Action</button>
</form>
