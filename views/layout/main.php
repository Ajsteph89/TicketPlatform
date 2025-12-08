<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Ticket Market' ?></title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>

<?php if(empty($hideNavbar)) : ?>
    <?php require __DIR__ . '/../../partials/navbar.php'; ?>
<?php endif; ?>

<main>
    <?php require __DIR__ . '/../' . $view . '.php'; ?>
</main>

</body>
</html>
