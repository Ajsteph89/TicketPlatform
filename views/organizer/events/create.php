<h1>Create Event</h1>

<div class="form-card">
    <form method="POST" action="/organizer/events/store">
        <div class="form-group">
            <label>Event Name</label><br>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Description</label><br>
            <textarea name="description"></textarea>
        </div>

        <div class="form-group">
            <label>Date & Time</label><br>
            <input type="datetime-local" name="event_datetime" required>
        </div>
        
        <div class="form-group">
            <label>Location</label><br>
            <input type="text" name="location" required>
        </div>

        <div class="form-actions">
            <button type="submit">Create Event</button>
        </div>
            
    </form>
</div>

<br><br>

<a href="/organizer/events" class="btn-secondary"> ← Back to Events </a>