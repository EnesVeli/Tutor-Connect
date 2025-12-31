<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>My Profile</h2>
                <a href="/" class="btn btn-secondary">Back to Dashboard</a>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <?php if (isset($message)): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
                    <?php endif; ?>

                    <form method="POST" action="/student/profile">
                        <div class="mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control" 
                                   value="<?= htmlspecialchars($profile->date_of_birth ?? '') ?>" required>
                            <div class="form-text">We need this to show your age to tutors.</div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>