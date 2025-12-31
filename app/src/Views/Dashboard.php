<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Tutor Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Tutor Connect</a>
            <div class="d-flex">
                <span class="navbar-text text-white me-3">
                    Welcome, <?= htmlspecialchars($name) ?> (<?= ucfirst($role) ?>)
                </span>
                <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">My Dashboard</h2>
                        <p class="lead">Select an option below to get started.</p>

                        <div class="row mt-4">
                            <?php if ($role === 'student'): ?>
                            <div class="col-md-4">
                                <div class="card text-center h-100">
                                    <div class="card-body">
                                        <h4>Find a Tutor</h4>
                                        <p>Search by subject and book a lesson.</p>
                                        <a href="/tutors" class="btn btn-primary">Search Tutors</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center h-100">
                                    <div class="card-body">
                                        <h4>My Bookings</h4>
                                        <p>View your upcoming lessons.</p>
                                        <a href="/bookings" class="btn btn-outline-primary">View Schedule</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center h-100">
                                    <div class="card-body">
                                        <h4>My Profile</h4>
                                        <p>Update your personal details.</p>
                                        <a href="/student/profile" class="btn btn-primary">Edit Profile</a>
                                    </div>
                                </div>
                            </div>

                            <?php elseif ($role === 'tutor'): ?>
                            <div class="col-md-4">
                                <div class="card text-center h-100">
                                    <div class="card-body">
                                        <h4>My Profile</h4>
                                        <p>Update your bio, subjects, and hourly rate.</p>
                                        <a href="/profile" class="btn btn-primary">Edit Profile</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center h-100">
                                    <div class="card-body">
                                        <h4>Upcoming Lessons</h4>
                                        <p>See which students have booked you.</p>
                                        <a href="/bookings" class="btn btn-outline-primary">View Schedule</a>
                                    </div>
                                </div>
                            </div>

                            <?php elseif ($role === 'admin'): ?>
                            <div class="col-md-4">
                                <div class="card text-center h-100 border-danger">
                                    <div class="card-body">
                                        <h4 class="text-danger">Manage Users</h4>
                                        <p>View, edit, or delete users.</p>
                                        <a href="/admin/users" class="btn btn-danger">User Management</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center h-100 border-danger">
                                    <div class="card-body">
                                        <h4 class="text-danger">System Stats</h4>
                                        <p>View platform activity.</p>
                                        <a href="/admin/stats" class="btn btn-outline-danger">View Reports</a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>