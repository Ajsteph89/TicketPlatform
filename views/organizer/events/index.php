<h1>My Events</h1>

<a href="/organizer/events/create">+ Create New Event</a>

<hr>

<?php if (empty($events)): ?>
    <p>No events yet.</p>
<?php else: ?>
    <?php foreach ($events as $event): ?>
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <h3><?= htmlspecialchars($event['name']) ?></h3>
            <p><strong>Date:</strong> <?= date('F j, Y g:i A', strtotime($event['event_datetime']))?></p>

            <p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>

            <a href="/organizer/events/tickets?event_id=<?= $event['id'] ?>">Manage Tickets</a> |

            <a href="/organizer/events/edit?id=<?= $event['id'] ?>">Edit</a>

            <form method="POST" action="/organizer/events/delete" style="display:inline;">
                <input type="hidden" name="id" value="<?= $event['id'] ?>">
                <button type="submit" onclick="return confirm('Delete this event?')">
                    Delete
                </button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
