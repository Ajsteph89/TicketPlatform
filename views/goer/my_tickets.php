<h1>My Tickets</h1>

<?php if (empty($tickets)): ?>
    <p>You have not purchased any tickets yet.</p>
    <a href="/events">Browse Events</a>
<?php else: ?>

    <table class="cart-table">
        <tr>
            <th>Event</th>
            <th>Date</th>
            <th>Ticket Type</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Order Total</th>
            <th>Order Date</th>
        </tr>

        <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><?= htmlspecialchars($ticket['event_name']) ?></td>
                <td>
                    <?= date('F j, Y g:i A', strtotime($ticket['event_datetime'])) ?>
                </td>
                <td><?= htmlspecialchars($ticket['ticket_type']) ?></td>
                <td><?= (int)$ticket['quantity'] ?></td>
                <td>$<?= number_format($ticket['price'], 2) ?></td>
                <td><strong>$<?= number_format($ticket['total'], 2) ?></strong></td>
                <td>
                    <?= date('F j, Y g:i A', strtotime($ticket['created_at'])) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>

<br><br>

<a href="/events" class="btn-secondary">← Back to Events</a>
