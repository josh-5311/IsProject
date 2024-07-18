<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rate Service - Green Gear</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="rate-service-body">
    <div class="rate-service-container">
        <h2>Rate Our Service</h2>

        <!-- Feedback message -->
        <?php if (!empty($feedback_message)): ?>
            <div class="feedback-message">
                <?php echo htmlspecialchars($feedback_message); ?>
            </div>
        <?php endif; ?>

        <!-- Rating Form -->
        <form class="form-rate-service" method="POST" action="rate_service.php">
            <div class="rating-stars">
                <input type="radio" id="star5" name="rating" value="5">
                <label for="star5">&#9733;<br> 5</label>
                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4">&#9733;<br> 4</label>
                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3">&#9733;<br> 3</label>
                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2">&#9733;<br> 2</label>
                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1">&#9733;<br> 1</label>
            </div>

            <label for="suggestion">Suggestion/Feedback:</label>
            <textarea id="suggestion" name="suggestion" required></textarea><br>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
