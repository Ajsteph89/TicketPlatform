<h1>Edit Event</h1>

<form method="POST" action="/organizer/events/update">
    <input type="hidden" name="id" value="<?= $event['id'] ?>">

    <div>
        <label>Event Name</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($event['name']) ?>" required>
    </div>

    <div>
        <label>Description</label><br>
        <textarea name="description"><?= htmlspecialchars($event['description']) ?></textarea>
    </div>

    <div>
        <label>Date & Time</label><br>
        <input type="datetime-local" name="event_datetime"
            value="<?= date('Y-m-d\TH:i', strtotime($event['event_datetime'])) ?>" required>
    </div>

    <div>
        <label>Location</label><br>
        <input type="text" name="location" value="<?= htmlspecialchars($event['location']) ?>" required>
    </div>

    <br>

    <button type="submit">Update Event</button>

    <br><br>
</form>

<a href="/organizer/events">← Back to Events</a>
