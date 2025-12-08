<h1><?= htmlspecialchars($event['name']) ?></h1>

<?php if (!empty($event['description'])): ?>
    <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>
<?php endif; ?>

<p><strong>Date:</strong> <?= $event['event_datetime'] ?></p>
<p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>

<hr>

<h2>Available Tickets</h2>

<?php if (empty($tickets)): ?>
    <p>No tickets available for this event.</p>
<?php else: ?>
    <?php foreach ($tickets as $ticket): ?>
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <p><strong><?= $ticket['ticket_type'] ?></strong></p>
            <p>Price: $<?= number_format($ticket['price'], 2) ?></p>
            <p>Available: <?= $ticket['quantity'] ?></p>

            <form method="POST" action="/cart/add" style="display:inline;">
                <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">

                <label>
                    Qty:
                    <input 
                        type="number" 
                        name="quantity" 
                        min="1" 
                        max="<?= $ticket['quantity'] ?>" 
                        value="1"
                        style="width:60px;"
                    >
                </label>

                <button type="submit">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<br>
<a href="/">← Back to All Events</a>
