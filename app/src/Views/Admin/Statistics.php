<?php 
$title = 'Platform Statistics';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Platform Statistics</h2>
        <a href="/admin/users" class="btn btn-secondary">Back to Users</a>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card bg-primary text-white p-3 text-center">
                <h3><?= $stats['total_users'] ?></h3>
                <div>Total Users</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white p-3 text-center">
                <h3>€<?= number_format($stats['total_earnings'], 2) ?></h3>
                <div>Platform Earnings</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark p-3 text-center">
                <h3><?= $stats['total_bookings'] ?></h3>
                <div>Total Bookings</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white p-3 text-center">
                <h3><?= $stats['total_tutors'] ?></h3>
                <div>Active Tutors</div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>