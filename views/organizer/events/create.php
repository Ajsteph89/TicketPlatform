<h1>Create Event</h1>

<form method="POST" action="/organizer/events/store">
    <div>
        <label>Event Name</label><br>
        <input type="text" name="name" required>
    </div>

    <div>
        <label>Description</label><br>
        <textarea name="description"></textarea>
    </div>

    <div>
        <label>Date & Time</label><br>
        <input type="datetime-local" name="event_datetime" required>
    </div>

    <div>
        <label>Location</label><br>
        <input type="text" name="location" required>
    </div>

    <br>

    <button type="submit">Create Event</button>

    <br><br>

    <a href="/organizer/events">
        <button type="button">Back to Events</button>
    </a>
</form>
