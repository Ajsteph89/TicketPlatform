<h1>Checkout</h1>

<form method="POST" action="/checkout/process">

    <h3>Customer Information</h3>

    <?php if (!empty($_SESSION['user'])): ?>
        <label>
            Name:
            <input type="text" name="customer_name" 
                value="<?= htmlspecialchars($_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'] ?? '') ?>" required>
        </label>
        <br><br>

        <label>
            Email:
            <input type="email" name="customer_email" 
                value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>" required>
        </label>

    <?php else: ?>
        <label>
            Name:
            <input type="text" name="customer_name" required>
        </label>
        <br><br>

        <label>
            Email:
            <input type="email" name="customer_email" required>
        </label>
    <?php endif; ?>

    <hr>

    <h3>Payment Information (Demo Only)</h3>

    <label>
        Card Number:
        <input type="text" maxlength="19" placeholder="4242 4242 4242 4242" required>
    </label>
    <br><br>

    <label>
        Expiration:
        <input type="text" maxlength="5" placeholder="MM/YY" required>
    </label>
    <br><br>

    <label>
        CVV:
        <input type="text" maxlength="4" placeholder="123" required>
    </label>

    <hr>

    <h3>Order Summary</h3>

    <table border="1" cellpadding="8">
        <tr>
            <th>Event</th>
            <th>Ticket</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
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
                <td><?= $item['quantity'] ?></td>
                <td>$<?= number_format($item['price'], 2) ?></td>
                <td>$<?= number_format($itemTotal, 2) ?></td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="4" align="right"><strong>Grand Total:</strong></td>
            <td><strong>$<?= number_format($grandTotal, 2) ?></strong></td>
        </tr>
    </table>

    <br>

    <button type="submit">Place Order</button>

</form>

<br>
<a href="/cart">← Back to Cart</a>
