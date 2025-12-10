<h1>Manage Tickets</h1>

<a href="/organizer/events/tickets/create?event_id=<?= $event_id ?>" class="btn-primary">+ Add Ticket Type</a>

<hr>

<?php if (empty($tickets)): ?>
    <p>No tickets created for this event yet.</p>
<?php else: ?>
    <?php foreach ($tickets as $ticket): ?>
        <div class="event-card">
            <p><strong>Type:</strong> <?= $ticket['ticket_type'] ?></p>
            <p><strong>Price:</strong> $<?= number_format($ticket['price'], 2) ?></p>
            <p><strong>Qty:</strong> <?= $ticket['quantity'] ?></p>
            <p><strong>Sales Start:</strong>
                <?= date('F j, Y g:i A', strtotime($ticket['sale_start'])) ?>
            </p>
            <p><strong>Sales End:</strong>
                <?= date('F j, Y g:i A', strtotime($ticket['sale_end'])) ?>
            </p>
            <p><strong>Visibility:</strong> <?= ucfirst($ticket['visibility']) ?></p>

            <a href="/organizer/events/tickets/edit?id=<?= $ticket['id'] ?>&event_id=<?= $event_id ?>" class="btn-secondary">Edit</a>

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

<br><br>

<a href="/organizer/events" class="btn-secondary">← Back to Events</a>
