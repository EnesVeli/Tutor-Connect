<?php 
$title = 'Find a Tutor';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

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
                            <?php 
                            $subjects = ['Math', 'English', 'Physics', 'Chemistry', 'Biology', 'Computer Science', 'Music', 'Art'];
                            foreach ($subjects as $sub) {
                                $isSelected = (isset($selectedSubject) && $selectedSubject === $sub) ? 'selected' : '';
                                echo "<option value='$sub' $isSelected>$sub</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label fw-bold">Max Hourly Price (€)</label>
                        <select name="price" class="form-select">
                            <option value="">Any Price</option>
                            <?php 
                            $prices = [5, 10, 15, 20, 25, 30, 35, 40, 45, 50];
                            foreach($prices as $p) {
                                $isSelected = (isset($selectedPrice) && (float)$selectedPrice == $p) ? 'selected' : '';
                                echo "<option value='$p' $isSelected>€ $p</option>"; 
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
                        <span class="badge bg-info text-dark"><?= htmlspecialchars($tutor['experience_years']) ?> Years
                            Exp.</span>
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

<?php 
require __DIR__ . '/../partials/footer.php'; 
?>