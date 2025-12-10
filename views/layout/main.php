<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Ticket Market' ?></title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

<?php if(empty($hideNavbar)) : ?>
    <?php require __DIR__ . '/../../partials/navbar.php'; ?>
<?php endif; ?>

<div class="container">
    <main>
        <?php require __DIR__ . '/../' . $view . '.php'; ?>
    </main>
</div>

<!-- CART MODAL -->
<div id="cart-modal" class="modal-overlay">

    <div class="modal-box">

        <button id="close-cart-modal" style="
            position:absolute;
            top:10px;
            right:10px;
        ">X</button>

        <!-- Dynamic cart content loads here -->
        <div id="cart-modal-content">
            Loading cart...
        </div>

    </div>
</div>

<script src="/js/cart-modal.js"></script>
<script src="/js/password.js"></script>

</body>
</html>
