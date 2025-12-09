<h1><?= htmlspecialchars($event['name']) ?></h1>

<?php if (!empty($event['description'])): ?>
    <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>
<?php endif; ?>

<p><strong>Date:</strong> <?= date('F j, Y g:i A', strtotime($event['event_datetime'])) ?></p>

<p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>

<hr>

<h2>Available Tickets</h2>

<?php if (empty($tickets)): ?>
    <p>No tickets available for this event.</p>
<?php else: ?>
    <?php foreach ($tickets as $ticket): ?>
        <div class="ticket-card">
            <p><strong><?= $ticket['ticket_type'] ?></strong></p>
            <p>Sales Begin: <?= date('F j, Y g:i A', strtotime($ticket['sale_start'])) ?></p>
            <p>Sales End: <?= date('F j, Y g:i A', strtotime($ticket['sale_end'])) ?></p>
            <p>Price: $<?= number_format($ticket['price'], 2) ?></p>

            <?php if ($ticket['quantity'] > 0): ?>
                <p>Available: <?= $ticket['quantity'] ?></p>

                <form method="POST" action="/cart/add" class="add-to-cart-form ticket-actions">
                    <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">

                    <span>Qty:</span>

                    <input 
                        type="number" 
                        name="quantity" 
                        min="1" 
                        max="<?= $ticket['quantity'] ?>" 
                        value="1"
                    >

                    <button type="submit">Add to Cart</button>
                </form>

            <?php else: ?>
                <p style="color:red; font-weight:bold;">SOLD OUT</p>

                <button type="button" disabled style="opacity:0.6;">
                    Sold Out
                </button>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<br><br>
<a href="/events" class="btn-secondary">← Back to All Events</a>
