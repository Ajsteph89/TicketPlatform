<h1>Upcoming Events</h1>

<?php if (empty($events)): ?>
    <p>No public events available yet.</p>
<?php else: ?>
    <?php foreach ($events as $event): ?>
        <div class="event-card">
            <h3><?= htmlspecialchars($event['name']) ?></h3>

            <?php if (!empty($event['description'])): ?>
                <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>
            <?php endif; ?>

            <p><strong>Date:</strong><?= date('F j, Y g:i A', strtotime($event['event_datetime'])) ?></p>

            <p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>

            <a href="/events/show?id=<?= $event['id'] ?>" class="btn-secondary">View Tickets</a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
