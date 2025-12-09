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
            <p>Sales Begin: <?= $ticket['sale_start']?></p>
            <p>Sales End: <?= $ticket['sale_end']?></p>
            <p>Price: $<?= number_format($ticket['price'], 2) ?></p>

            <?php if ($ticket['quantity'] > 0): ?>
                <p>Available: <?= $ticket['quantity'] ?></p>

                <form method="POST" action="/cart/add" class="add-to-cart-form" style="display:inline;">
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

            <?php else: ?>
                <p style="color:red; font-weight:bold;">SOLD OUT</p>

                <button type="button" disabled style="opacity:0.6;">
                    Sold Out
                </button>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<br>
<a href="/events">← Back to All Events</a>
