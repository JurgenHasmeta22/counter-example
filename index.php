<?php
session_start();

$persons = isset ($_SESSION['persons']) ? $_SESSION['persons'] : [];

if (isset ($_POST['addPerson'])) {
    $newPerson = [
        'name' => $_POST['name'],
        'age' => $_POST['age'],
        'city' => $_POST['city']
    ];

    $persons[] = $newPerson;
    $_SESSION['persons'] = $persons;
}

if (isset ($_POST['updatePerson'])) {
    $index = $_POST['index'];
    $persons[$index]['name'] = $_POST['name'];
    $persons[$index]['age'] = $_POST['age'];
    $persons[$index]['city'] = $_POST['city'];
    $_SESSION['persons'] = $persons;
}

if (isset ($_POST['deletePerson'])) {
    $index = $_POST['index'];
    unset($persons[$index]);
    $_SESSION['persons'] = $persons;
}

if (isset ($_POST['resetPersons'])) {
    $_SESSION['persons'] = [];
    $persons = [];
}

if (isset ($_POST['counter'])) {
    $change = intval($_POST['counter']);

    if ($change < 0 && $_SESSION['count'] + $change < 0) {
        $_SESSION['count'] = 0;
    } elseif ($change > 0 && $_SESSION['count'] + $change > 20) {
        $_SESSION['count'] = 20;
    } else {
        $_SESSION['count'] += $change;
    }

    echo $_SESSION['count'];

    exit;
}

if (isset ($_POST['resetCounter'])) {
    $_SESSION['count'] = 0;
    echo 0;

    exit;
}

if (empty ($persons)) {
    for ($i = 1; $i <= 20; $i++) {
        $person = [
            'id' => $i,
            'name' => 'Person ' . $i,
            'age' => rand(18, 80),
            'city' => 'City ' . rand(1, 5),
        ];

        $persons[] = $person;
    }

    $_SESSION['persons'] = $persons;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Counter example</title>
</head>

<body>
    <div class="container-wrapper">
        <div class="container">
            <div class="count-group">
                <p>Count: <span id="count">
                        <?php echo isset ($_SESSION['count']) ? $_SESSION['count'] : 0; ?>
                    </span></p>
            </div>
            <div class="buttons">
                <button id="decrement-btn">Decrement</button>
                <button id="increment-btn">Increment</button>
                <button id="reset-btn">Reset</button>
            </div>
        </div>
        <div class="cards-container">
            <?php foreach ($persons as $person): ?>
                <div class="card">
                    <h3>
                        <?php echo $person['name']; ?>
                    </h3>
                    <p>Age:
                        <?php echo $person['age']; ?>
                    </p>
                    <p>City:
                        <?php echo $person['city']; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>