<nav class="navbar">
    <strong>Ticket Market</strong>

    <span style="float: right;">

        <?php if (!empty($_SESSION['user'])): ?>

            Welcome, <?= htmlspecialchars($_SESSION['user']['first_name']) ?> |

            <?php if ($_SESSION['user']['role'] === 'goer'): ?>
                <!-- VIEW CART MODAL TRIGGER -->
                <a href="#" id="open-cart-modal">View Cart</a> |
                
                <a href="/my-tickets">My Tickets</a> |
            <?php endif; ?>

            <a href="/logout">Logout</a>

        <?php else: ?>
            <a href="/login">Login</a> |
            <a href="/register">Register</a>
        <?php endif; ?>
        
    </span>
</nav>
