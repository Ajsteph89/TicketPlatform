<nav style="padding: 10px; background: #eee;">
    <strong>Ticket Market</strong>

    <span style="float: right;">
        <?php if (!empty($_SESSION['user'])): ?>

            Welcome, <?= htmlspecialchars($_SESSION['user']['first_name']) ?> |

            <?php if ($_SESSION['user']['role'] === 'goer'): ?>
                <a href="/my-tickets">My Tickets</a> |
            <?php endif; ?>

            <a href="/logout">Logout</a>

        <?php else: ?>
            <a href="/login">Login</a> |
            <a href="/register">Register</a>
        <?php endif; ?>
    </span>
</nav>
