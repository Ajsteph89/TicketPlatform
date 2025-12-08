<h1>Your Cart</h1>

<?php if (empty($cart)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <table border="1" cellpadding="8">
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
                <form method="POST" action="/cart/remove" style="display:inline;">
                    <input type="hidden" name="ticket_id" value="<?= $item['ticket_id'] ?>">

                    <label>
                        Remove:
                        <input 
                            type="number" 
                            name="quantity" 
                            min="1" 
                            max="<?= $item['quantity'] ?>" 
                            value="1"
                            style="width:60px;"
                        >
                    </label>

                    <button type="submit">Update</button>
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

    <form method="POST" action="/cart/clear">
        <button type="submit">Clear Cart</button>
    </form>
<?php endif; ?>

<br>
<a href="/">← Back to Events</a>
