<h1>Manage Tickets</h1>

<a href="/organizer/events/tickets/create?event_id=<?= $event_id ?>">+ Add Ticket Type</a>

<hr>

<?php if (empty($tickets)): ?>
    <p>No tickets created for this event yet.</p>
<?php else: ?>
    <?php foreach ($tickets as $ticket): ?>
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <p><strong>Type:</strong> <?= $ticket['ticket_type'] ?></p>
            <p><strong>Price:</strong> $<?= number_format($ticket['price'], 2) ?></p>
            <p><strong>Qty:</strong> <?= $ticket['quantity'] ?></p>
            <p><strong>Sale:</strong> <?= $ticket['sale_start'] ?> → <?= $ticket['sale_end'] ?></p>
            <p><strong>Visibility:</strong> <?= ucfirst($ticket['visibility']) ?></p>

            <a href="/organizer/events/tickets/edit?id=<?= $ticket['id'] ?>&event_id=<?= $event_id ?>">Edit</a>

            <form method="POST" action="/organizer/events/tickets/delete" style="display:inline;">
                <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                <input type="hidden" name="event_id" value="<?= $event_id ?>">
                <button type="submit" onclick="return confirm('Delete this ticket?')">
                    Delete
                </button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<br>
<a href="/organizer/events">← Back to Events</a>
