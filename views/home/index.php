<div style="max-width:700px; margin:60px auto; text-align:center;">

    <h1 class="hero-title">Ticket Market</h1>
    <p class="hero-subtitle">
        Browse events, purchase tickets, and manage events as an organizer!
    </p>

    <div style="margin-top:30px;">

        <a href="/events" class="btn-primary">
            Browse Events
        </a>

        <?php if (empty($_SESSION['user'])): ?>
            <a href="/login" class="btn-secondary">
                Login
            </a>

            <a href="/register" class="btn-secondary">
                Register
            </a>
        <?php else: ?>
            <?php if ($_SESSION['user']['role'] === 'organizer'): ?>
                <a href="/organizer/events" style="margin-left:10px;">
                    <button>Go to Dashboard</button>
                </a>
            <?php else: ?>
                <a href="/events" style="margin-left:10px;">
                    <button>Browse Events</button>
                </a>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</div>
