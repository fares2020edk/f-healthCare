<?php
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
            background: #f0f4f8;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        form, .section {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        textarea, input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background: #007BFF;
            border: none;
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        ul li {
            background: #e3f2fd;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .chart-bar {
            font-family: monospace;
            color: #4caf50;
        }
    </style>
</head>
<body>

<div class="section">
    <h2>Meal Planning</h2>
    <form method="POST">
        <textarea name="meal_plan" rows="4" placeholder="Enter your meal plan..."><?php echo $_SESSION['meal_plan'] ?? ''; ?></textarea>
        <button type="submit">Update Meal Plan</button>
    </form>
</div>

<div class="section">
    <h2>Weight Tracking</h2>
    <form method="POST">
        <label>Log Weight (kg):</label>
        <input type="number" name="weight" step="0.1" required>
        <button type="submit">Add</button>
    </form>
</div>

<div class="section">
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
</div>

<div class="section">
    <h2>Fitness Activities</h2>
    <ul>
        <li><a href="https://www.youtube.com/watch?v=UBMk30rjy0o" target="_blank">15-min Weight Loss Workout</a></li>
        <li><a href="https://www.youtube.com/watch?v=ml6cT4AZdqI" target="_blank">Home Cardio</a></li>
    </ul>
</div>

<div class="section">
    <h2>Real-time Feedback</h2>
    <form method="POST">
        <label>Your Goal (kg): </label>
        <input type="number" name="goal" step="0.1" required>
        <button type="submit">Get Feedback</button>
    </form>
    <p><strong><?php echo $feedback; ?></strong></p>
</div>

<div class="section">
    <h2>Charts (Simple Text Output)</h2>
    <?php
    if (isset($_SESSION['weights'])) {
        echo "<strong>Weight Chart:</strong><br>";
        foreach ($_SESSION['weights'] as $entry) {
            $bar = str_repeat('█', (int)$entry['weight']);
            echo "<div class='chart-bar'>{$entry['date']} - $bar</div>";
        }
    }
    ?>
</div>

</body>
</html>
<?php
session_start();

$meal_plan = $_POST['meal_plan'] ??  '';
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
<p><?php echo $feedback; ?></p>

<h2>Charts (Simple Text Output)</h2>
<?php
if (isset($_SESSION['weights'])) {
    echo "<strong>Weight Chart:</strong><br>";
    foreach ($_SESSION['weights'] as $entry) {
        $bar = str_repeat('█', $entry['weight']);
        echo "{$entry['date']} - $bar<br>";
    }
}
?>
