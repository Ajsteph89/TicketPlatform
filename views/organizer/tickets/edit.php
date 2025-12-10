<h1>Edit Tickets</h1>

<div class="form-card">
    <form method="POST" action="/organizer/events/tickets/update">
        <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
        <input type="hidden" name="event_id" value="<?= $event_id ?>">

        <div class="form-group">
            <label>Ticket Type</label><br>
            <select name="ticket_type">
                <option value="VIP" <?= $ticket['ticket_type'] === 'VIP' ? 'selected' : '' ?>>VIP</option>
                <option value="General Admission" <?= $ticket['ticket_type'] === 'General Admission' ? 'selected' : '' ?>>General Admission</option>
            </select>
        </div>

        <div class="form-group">
            <label>Sale Start</label><br>
            <input type="datetime-local" name="sale_start"
                value="<?= date('Y-m-d\TH:i', strtotime($ticket['sale_start'])) ?>" required>
        </div>

        <div class="form-group">
            <label>Sale End</label><br>
            <input type="datetime-local" name="sale_end"
                value="<?= date('Y-m-d\TH:i', strtotime($ticket['sale_end'])) ?>" required>
        </div>

        <div class="form-group">
            <label>Quantity</label><br>
            <input type="number" name="quantity" min="1"
                value="<?= $ticket['quantity'] ?>" required>
        </div>

        <div class="form-group">
            <label>Price</label><br>
            <input type="number" step="0.01" name="price"
                value="<?= $ticket['price'] ?>" required>
        </div>

        <div class="form-group">
            <label>Visibility</label><br>
            <select name="visibility">
                <option value="public" <?= $ticket['visibility'] === 'public' ? 'selected' : '' ?>>Public</option>
                <option value="private" <?= $ticket['visibility'] === 'private' ? 'selected' : '' ?>>Private</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit">Update Ticket</button>
        </div>
    </form>
</div>

<br><br>
<a href="/organizer/events/tickets?event_id=<?= $event_id ?>" class="btn-secondary">
    ← Back to Tickets
</a>