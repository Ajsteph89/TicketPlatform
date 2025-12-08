<div style="max-width:700px; margin:60px auto; text-align:center;">

    <h1>Ticket Market</h1>

    <p style="font-size:18px; margin:20px 0;">
        Browse events, purchase tickets, and manage events as an organizer — all in one place.
    </p>

    <div style="margin-top:30px;">

        <a href="/events">
            <button>Browse Events</button>
        </a>

        <?php if (empty($_SESSION['user'])): ?>
            <a href="/login" style="margin-left:10px;">
                <button>Login</button>
            </a>

            <a href="/register" style="margin-left:10px;">
                <button>Register</button>
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
