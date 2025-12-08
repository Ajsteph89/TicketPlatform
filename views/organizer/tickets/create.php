<h1>Create Ticket</h1>

<form method="POST" action="/organizer/events/tickets/store">
    <input type="hidden" name="event_id" value="<?= $event_id ?>">

    <div>
        <label>Ticket Type</label><br>
        <select name="ticket_type" required>
            <option value="VIP">VIP</option>
            <option value="General Admission">General Admission</option>
        </select>
    </div>

    <div>
        <label>Sale Start</label><br>
        <input type="datetime-local" name="sale_start" required>
    </div>

    <div>
        <label>Sale End</label><br>
        <input type="datetime-local" name="sale_end" required>
    </div>

    <div>
        <label>Quantity</label><br>
        <input type="number" name="quantity" min="1" required>
    </div>

    <div>
        <label>Price</label><br>
        <input type="number" step="0.01" name="price" required>
    </div>

    <div>
        <label>Visibility</label><br>
        <select name="visibility">
            <option value="public">Public</option>
            <option value="private">Private</option>
        </select>
    </div>

    <br>

    <button type="submit">Create Ticket</button>
</form>
