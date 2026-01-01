<?php 
$title = 'Manage Users';
require __DIR__ . '/../Partials/header.php';
require __DIR__ . '/../Partials/navbar.php';
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>User Management</h2>
        <a href="/" class="btn btn-secondary">Back to Dashboard</a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Bio</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td><?= htmlspecialchars($user->first_name . ' ' . $user->last_name) ?></td>
                            <td><?= htmlspecialchars($user->email) ?></td>
                            <td>
                                <span
                                    class="badge bg-<?= $user->role === 'admin' ? 'danger' : ($user->role === 'tutor' ? 'primary' : 'success') ?>">
                                    <?= ucfirst($user->role) ?>
                                </span>
                            </td>
                            <td>
                                <small
                                    class="text-muted"><?= htmlspecialchars(substr($user->bio ?? '', 0, 50)) ?>...</small>
                            </td>
                            <td>
                                <a href="/admin/users/edit?id=<?= $user->id ?>"
                                    class="btn btn-sm btn-outline-primary">Edit</a>

                                <form method="POST" action="/admin/users/delete"
                                    onsubmit="return confirm('Are you sure? This will delete all their bookings!');"
                                    style="display:inline;">
                                    <input type="hidden" name="user_id" value="<?= $user->id ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../Partials/footer.php'; ?>