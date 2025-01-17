<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Admin Panel'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin/dashboard">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/donations">Manage Donations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/event_registrations">Event Registrations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/payments">Manage Payments</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="eventsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Events
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="eventsDropdown">
                            <li><a class="dropdown-item" href="/events/list">Manage Events</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="tasksDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tasks
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="tasksDropdown">
                            <li><a class="dropdown-item" href="/tasks/list">Manage Tasks</a></li>
                            <li><a class="dropdown-item" href="/tasks/available">Available Tasks</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="beneficiariesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Beneficiaries
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="beneficiariesDropdown">
                            <li><a class="dropdown-item" href="/admin/list_beneficiaries">Manage Beneficiaries</a></li>
                            <li><a class="dropdown-item" href="/admin/manage_needs">Manage Needs</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Back To Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <?= $content; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
