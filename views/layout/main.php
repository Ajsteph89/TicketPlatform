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

<!-- CART MODAL -->
<div id="cart-modal" style="
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.6);
    z-index:1000;
">

    <div style="
        background:#fff;
        width:90%;
        max-width:800px;
        margin:40px auto;
        padding:20px;
        position:relative;
        max-height:85vh;
        overflow-y:auto;
    ">

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

</body>
</html>
