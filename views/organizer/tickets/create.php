<h1>Create Tickets</h1>

<div class="checkout-box">
    <form method="POST" action="/organizer/events/tickets/store">
        <input type="hidden" name="event_id" value="<?= $event_id ?>">

        <div class="form-group">
            <label>Ticket Type</label><br>
            <select name="ticket_type" required>
                <option value="VIP">VIP</option>
                <option value="General Admission">General Admission</option>
            </select>
        </div>

        <div class="form-group">
            <label>Sale Start</label><br>
            <input type="datetime-local" name="sale_start" required>
        </div>

        <div class="form-group">
            <label>Sale End</label><br>
            <input type="datetime-local" name="sale_end" required>
        </div>

        <div class="form-group">
            <label>Quantity</label><br>
            <input type="number" name="quantity" min="1" required>
        </div>

        <div class="form-group">
            <label>Price</label><br>
            <input type="number" step="0.01" name="price" required>
        </div>

        <div class="form-group">
            <label>Visibility</label><br>
            <select name="visibility">
                <option value="public">Public</option>
                <option value="private">Private</option>
            </select>
        </div>

        <div class="ticket-actions">
            <button type="submit">Create Ticket</button>
        </div>
    </form>
</div>

<br><br>
<a href="/organizer/events/tickets?event_id=<?= $event_id ?>" class="btn-secondary">
    ← Back to Tickets
</a>