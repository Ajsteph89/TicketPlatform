<h1>Your Cart</h1>

<?php if (empty($cart)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <table class="cart-table">
        <tr>
            <th>Event</th>
            <th>Ticket Type</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th></th>
        </tr>

        <?php $grandTotal = 0; ?>

        <?php foreach ($cart as $item): ?>
            <?php 
                $itemTotal = $item['price'] * $item['quantity']; 
                $grandTotal += $itemTotal;
            ?>

            <tr>
                <td><?= htmlspecialchars($item['event_name']) ?></td>
                <td><?= $item['type'] ?></td>
                <td>$<?= number_format($item['price'], 2) ?></td>
                <td><?= $item['quantity'] ?></td>
                <td>$<?= number_format($itemTotal, 2) ?></td>
                <td>
                <form method="POST" action="/cart/remove" class="remove-from-cart cart-actions">
                    <input type="hidden" name="ticket_id" value="<?= $item['ticket_id'] ?>">

                    <span>Qty:</span>

                    <input 
                        type="number" 
                        name="quantity" 
                        min="1" 
                        max="<?= $item['quantity'] ?>" 
                        value="1"
                    >

                    <button type="submit">Remove</button>
                </form>

                </td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="4" align="right"><strong>Grand Total:</strong></td>
            <td colspan="2"><strong>$<?= number_format($grandTotal, 2) ?></strong></td>
        </tr>
    </table>

    <br>

    <form method="POST" action="/cart/clear" class="clear-cart-form">
        <button type="submit">Clear Cart</button>
    </form>
    <br>
    <form method="GET" action="/checkout" class="proceed-to-review" style="display:inline;">
        <button type="submit">Proceed to Checkout</button>
    </form>
<?php endif; ?>

<br><br>

<a href="/events" class="btn-secondary">← Back to Events</a>
