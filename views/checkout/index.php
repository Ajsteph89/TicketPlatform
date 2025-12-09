<h1>Checkout</h1>

<form method="POST" action="/checkout/process" id="modal-checkout-form">

<div class="checkout-box">

<h3>Customer Information</h3>

    <?php if (!empty($_SESSION['user'])): ?>

        <div class="form-group">
            <label>Name</label>
            <input 
                type="text" 
                name="customer_name" 
                value="<?= htmlspecialchars(($_SESSION['user']['first_name'] ?? '') . ' ' . ($_SESSION['user']['last_name'] ?? '')) ?>" 
                required
            >
        </div>

        <div class="form-group">
            <label>Email</label>
            <input 
                type="email" 
                name="customer_email" 
                value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>" 
                required
            >
        </div>

    <?php else: ?>

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="customer_name" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="customer_email" required>
        </div>

    <?php endif; ?>

    <hr>

    <h3>Payment Information (Demo Only)</h3>

    <div class="form-group">
        <label>Card Number</label>
        <input type="text" maxlength="19" placeholder="4242 4242 4242 4242" required>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Expiration</label>
            <input type="text" maxlength="5" placeholder="MM/YY" required>
        </div>

        <div class="form-group">
            <label>CVV</label>
            <input type="text" maxlength="4" placeholder="123" required>
        </div>
    </div>

    <hr>

    <h3>Order Summary</h3>

    <table class="cart-table">
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

    <!-- <div class="ticket-actions"> -->
        <button type="submit">Place Order</button>
    </div>
</form>

<br><br>

<a href="#" class="back-to-cart btn-secondary">← Back to Cart</a>
