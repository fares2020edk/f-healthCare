<?php//Errir fixedwww
session_start();

$meal_plan = $_POST['meal_plan'] ?? '';
$weight = $_POST['weight'] ?? '';
$goal = $_POST['goal'] ?? '';
$feedback = '';

// Save meal plan and weight
if ($meal_plan) {
    $_SESSION['meal_plan'] = $meal_plan;
}
if ($weight) {
    $_SESSION['weights'][] = ['date' => date("Y-m-d"), 'weight' => $weight];
}

// Feedback logic
if ($goal && $weight) {
    if ($weight > $goal) {
        $feedback = "Keep going! You're getting closer to your goal.";
    } elseif ($weight == $goal) {
        $feedback = "Congrats! You've reached your goal!";
    } else {
        $feedback = "You've passed your goal! Maybe set a new one.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fitness Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        h2 {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 40px;
        }

        form {
            background-color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        textarea, input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
            margin-bottom: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        ul {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            list-style-type: none;
        }

        li {
            padding: 5px 0;
        }

        p.feedback {
            background-color: #e7f3fe;
            padding: 10px;
            border-left: 6px solid #2196F3;
            border-radius: 4px;
        }

        a {
            color: #2196F3;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .chart-bar {
            font-family: monospace;
            color: #4CAF50;
            white-space: pre;
            margin: 5px 0;
        }
    </style>
</head>
<body>

<h1>My Fitness & Meal Tracker</h1>

<h2>Meal Planning</h2>
<form method="POST">
    <textarea name="meal_plan" rows="4" cols="50"><?php echo $_SESSION['meal_plan'] ?? ''; ?></textarea><br>
    <button type="submit">Update Meal Plan</button>
</form>

<h2>Weight Tracking</h2>
<form method="POST">
    <label>Log Weight: </label>
    <input type="number" name="weight" step="0.1" required>
    <button type="submit">Add</button>
</form>

<h2>Weight History</h2>
<ul>
    <?php
    if (isset($_SESSION['weights'])) {
        foreach ($_SESSION['weights'] as $entry) {
            echo "<li>{$entry['date']} - {$entry['weight']} kg</li>";
        }
    }
    ?>
</ul>

<h2>Fitness Activities</h2>
<ul>
    <li><a href="https://www.youtube.com/watch?v=UBMk30rjy0o" target="_blank">15-min Weight Loss Workout</a></li>
    <li><a href="https://www.youtube.com/watch?v=ml6cT4AZdqI" target="_blank">Home Cardio</a></li>
</ul>

<h2>Real-time Feedback</h2>
<form method="POST">
    <label>Your Goal (kg): </label>
    <input type="number" name="goal" step="0.1" required>
    <button type="submit">Get Feedback</button>
</form>
<?php if ($feedback): ?>
    <p class="feedback"><?php echo $feedback; ?></p>
<?php endif; ?>

<h2>Charts (Simple Text Output)</h2>
<div class="chart">
    <?php
    if (isset($_SESSION['weights'])) {
        echo "<strong>Weight Chart:</strong><br>";
        foreach ($_SESSION['weights'] as $entry) {
            $bar = str_repeat('█', intval($entry['weight']));
            echo "<div class='chart-bar'>{$entry['date']} - $bar</div>";
        }
    }
    ?>
</div>

</body>
</html>
