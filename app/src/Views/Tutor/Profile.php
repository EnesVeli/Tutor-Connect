<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Tutor Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>My Tutor Profile</h2>
                <a href="/" class="btn btn-secondary">Back to Dashboard</a>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    
                    <?php if (isset($message)): ?>
                        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
                    <?php endif; ?>

                    <form method="POST" action="/profile">
                        
                        <div class="mb-3">
                            <label class="form-label">Subject You Teach</label>
                            <select name="subject" class="form-select" required>
                                <option value="">-- Select Subject --</option>
                                <?php 
                                $subjects = ['Math', 'English', 'Physics', 'Chemistry', 'Biology', 'Computer Science', 'Music', 'Art'];
                                foreach ($subjects as $sub) {
                                    $selected = ($profile->subject ?? '') === $sub ? 'selected' : '';
                                    echo "<option value='$sub' $selected>$sub</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Hourly Rate (€)</label>
                                <select name="hourly_rate" class="form-select" required>
                                    <option value="">-- Select Rate --</option>
                                    <?php 
                                    $prices = [5, 10, 15, 20, 25, 30, 35, 40, 45, 50];
                                    foreach ($prices as $p) {
                                        $val = (int)($profile->hourly_rate ?? 0);
                                        $selected = $val === $p ? 'selected' : '';
                                        echo "<option value='$p' $selected>€ $p</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="row mb-3">
                            <label class="form-label fw-bold">Availability (Working Hours)</label>
                            <div class="col">
                                <label class="small text-muted">From</label>
                                <select name="availability_start" class="form-select">
                                    <?php for($i=6; $i<=18; $i++): $time = sprintf('%02d:00', $i); ?>
                                        <option value="<?= $time ?>" <?= ($profile->availability_start ?? '09:00') == $time ? 'selected' : '' ?>>
                                            <?= $time ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col">
                                <label class="small text-muted">To</label>
                                <select name="availability_end" class="form-select">
                                    <?php for($i=10; $i<=22; $i++): $time = sprintf('%02d:00', $i); ?>
                                        <option value="<?= $time ?>" <?= ($profile->availability_end ?? '17:00') == $time ? 'selected' : '' ?>>
                                            <?= $time ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>

                            <div class="col">
                                <label class="form-label">Experience (Years)</label>
                                <input type="number" name="experience_years" class="form-control" 
                                       value="<?= htmlspecialchars($profile->experience_years ?? '') ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">About Me (Bio)</label>
                            <textarea name="bio" class="form-control" rows="5" 
                                      placeholder="Tell students about your teaching style..."><?= htmlspecialchars($profile->bio ?? '') ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>