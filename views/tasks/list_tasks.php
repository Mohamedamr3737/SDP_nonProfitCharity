<h2>Tasks for Event ID: <?= $eventId; ?></h2>
<a href="/tasks/add">Add Task</a>
<table border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Required Skill</th>
            <th>Completed</th>
            <th>Last Updated</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= $task['name']; ?></td>
            <td><?= $task['required_skill']; ?></td>
            <td><?= $task['is_completed'] ? 'Yes' : 'No'; ?></td>
            <td><?= $task['last_updated']; ?></td>
            <td>
                <a href="/tasks/edit/<?= $task['id']; ?>">Edit</a>
            </td>
            <td>
    <form method="POST" action="/tasks/delete/<?= $task['id']; ?>" style="display:inline;">
        <button type="submit">Delete</button>
    </form>
    <form method="POST" action="/tasks/undo" style="display:inline;">
        <button type="submit">Undo Last Action</button>
    </form>
</td>



        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
