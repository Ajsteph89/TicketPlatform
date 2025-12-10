<h1>Edit Event</h1>
<div class="form-card">
    <form method="POST" action="/organizer/events/update">
        <input type="hidden" name="id" value="<?= $event['id'] ?>">

        <div class="form-group">
            <label>Event Name</label><br>
            <input type="text" name="name" value="<?= htmlspecialchars($event['name']) ?>" required>
        </div>

        <div class="form-group">
            <label>Description</label><br>
            <textarea name="description"><?= htmlspecialchars($event['description']) ?></textarea>
        </div>

        <div class="form-group">
            <label>Date & Time</label><br>
            <input type="datetime-local" name="event_datetime"
                value="<?= date('Y-m-d\TH:i', strtotime($event['event_datetime'])) ?>" required>
        </div>

        <div class="form-group">
            <label>Location</label><br>
            <input type="text" name="location" value="<?= htmlspecialchars($event['location']) ?>" required>
        </div>

        <div class="form-actions">
            <button type="submit">Update Event</button>
        </div>
        
        <br><br>
    </form>
</div>

<br><br>

<a href="/organizer/events" class="btn-secondary">← Back to Events</a>
