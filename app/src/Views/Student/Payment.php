<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Secure Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4>Checkout</h4>
                    </div>
                    <div class="card-body">
                        <p class="lead">Total: <strong>€<?= htmlspecialchars($tutorRate) ?></strong></p>
                        <p class="text-muted small">Lesson with <?= htmlspecialchars($tutorName) ?> on
                            <?= htmlspecialchars($date) ?></p>

                        <form method="POST" action="/book/confirm">
                            <input type="hidden" name="tutor_id" value="<?= $tutorId ?>">
                            <input type="hidden" name="scheduled_at" value="<?= $scheduledAt ?>">
                            <input type="hidden" name="student_comment" value="<?= htmlspecialchars($comment) ?>">

                            <div class="mb-3">
                                <label class="form-label">Card Number</label>
                                <input type="text" class="form-control" placeholder="0000 0000 0000 0000" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Expiry</label>
                                    <input type="text" class="form-control" placeholder="MM/YY" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">CVV</label>
                                    <input type="text" class="form-control" placeholder="123" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Pay & Confirm Booking</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>