<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Find a Tutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Find a Tutor</h2>
        <a href="/" class="btn btn-secondary">Back to Dashboard</a>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card p-3 bg-white shadow-sm">
                <form method="GET" action="/tutors" class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label fw-bold">Subject</label>
                        <select name="subject" class="form-select">
                            <option value="">All Subjects</option>
                            <option value="Math" <?= (isset($_GET['subject']) && $_GET['subject'] == 'Math') ? 'selected' : '' ?>>Math</option>
                            <option value="English" <?= (isset($_GET['subject']) && $_GET['subject'] == 'English') ? 'selected' : '' ?>>English</option>
                            <option value="Physics" <?= (isset($_GET['subject']) && $_GET['subject'] == 'Physics') ? 'selected' : '' ?>>Physics</option>
                            <option value="Chemistry" <?= (isset($_GET['subject']) && $_GET['subject'] == 'Chemistry') ? 'selected' : '' ?>>Chemistry</option>
                            <option value="Biology" <?= (isset($_GET['subject']) && $_GET['subject'] == 'Biology') ? 'selected' : '' ?>>Biology</option>
                            <option value="Computer Science" <?= (isset($_GET['subject']) && $_GET['subject'] == 'Computer Science') ? 'selected' : '' ?>>Computer Science</option>
                            <option value="Music" <?= (isset($_GET['subject']) && $_GET['subject'] == 'Music') ? 'selected' : '' ?>>Music</option>
                            <option value="Art" <?= (isset($_GET['subject']) && $_GET['subject'] == 'Art') ? 'selected' : '' ?>>Art</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-bold">Max Hourly Price (€)</label>
                        <select name="price" class="form-select">
                            <option value="">Any Price</option>
                            <?php 
                            $prices = [5, 10, 15, 20, 25, 30, 35, 40, 45, 50];
                            foreach($prices as $p) {
                                $selected = (isset($_GET['price']) && $_GET['price'] == $p) ? 'selected' : '';
                                echo "<option value='$p' $selected>€ $p</option>"; 
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <?php foreach ($tutors as $tutor): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><?= htmlspecialchars($tutor['first_name'] . ' ' . $tutor['last_name']) ?></h5>
                    <small class="text-muted"><?= htmlspecialchars($tutor['subject']) ?></small>
                </div>
                <div class="card-body">
                    <p class="card-text text-truncate"><?= htmlspecialchars($tutor['bio']) ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-success">€<?= htmlspecialchars($tutor['hourly_rate']) ?>/hr</span>
                        <span class="badge bg-info text-dark"><?= htmlspecialchars($tutor['experience_years']) ?> Years Exp.</span>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0">
                    <a href="/book?tutor_id=<?= $tutor['user_id'] ?>" class="btn btn-primary w-100">Book Lesson</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <?php if (empty($tutors)): ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">No tutors found matching your criteria.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>