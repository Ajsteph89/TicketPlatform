<?php

class EventController extends Controller
{
    // Public event list
    public function index()
    {
        require_once __DIR__ . '/../../config/db.php';

        // Only events that have at least one PUBLIC ticket
        $stmt = $pdo->query("
            SELECT DISTINCT e.*
            FROM events e
            JOIN tickets t ON t.event_id = e.id
            WHERE t.visibility = 'public'
            ORDER BY e.event_datetime
        ");

        $events = $stmt->fetchAll();

        $this->view('events/index', [
            'title'  => 'Upcoming Events',
            'events' => $events
        ]);
    }

    //  Public event detail + tickets
    public function show()
    {
        require_once __DIR__ . '/../../config/db.php';

        $eventId = $_GET['id'] ?? null;

        if (!$eventId) {
            die('Event ID is required.');
        }

        // Fetch event
        $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$eventId]);
        $event = $stmt->fetch();

        if (!$event) {
            die('Event not found.');
        }

        // Fetch PUBLIC tickets for this event
        $stmt = $pdo->prepare("
            SELECT * FROM tickets 
            WHERE event_id = ?
                AND visibility = 'public'
            ORDER BY price
        ");
        $stmt->execute([$eventId]);
        $tickets = $stmt->fetchAll();

        $this->view('events/show', [
            'title'   => $event['name'],
            'event'   => $event,
            'tickets' => $tickets
        ]);
    }
}
