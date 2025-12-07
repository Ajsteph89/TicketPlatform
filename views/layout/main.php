<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Ticketing App' ?></title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>

<?php require __DIR__ . '/../../partials/navbar.php'; ?>

<main>
    <?php require __DIR__ . '/../' . $view . '.php'; ?>
</main>

</body>
</html>
