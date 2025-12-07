<nav style="padding: 10px; background: #eee;">
    <strong>Ticketing App</strong>

    <span style="float: right;">
        <?php if (!empty($_SESSION['user'])): ?>
            Welcome, <?= htmlspecialchars($_SESSION['user']['first_name']) ?> |
            <a href="/logout">Logout</a>
        <?php else: ?>
            <a href="/login">Login</a> |
            <a href="/register">Register</a>
        <?php endif; ?>
    </span>
</nav>
