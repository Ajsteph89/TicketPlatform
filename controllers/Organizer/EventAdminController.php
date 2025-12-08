<?php

class EventAdminController extends Controller
{
    // LIST EVENTS
    public function index()
    {
        require_once __DIR__ . '/../../config/db.php';

        $userId = $_SESSION['user']['id'];

        $stmt = $pdo->prepare("SELECT * FROM events WHERE user_id = ? ORDER BY event_datetime");
        $stmt->execute([$userId]);
        $events = $stmt->fetchAll();

        $this->view('organizer/events/index', [
            'title' => 'My Events',
            'events' => $events
        ]);
    }

    // SHOW CREATE FORM
    public function create()
    {
        $this->view('organizer/events/create', [
            'title' => 'Create Event'
        ]);
    }

    // STORE EVENT
    public function store()
    {
        require_once __DIR__ . '/../../config/db.php';

        $userId = $_SESSION['user']['id'];

        $name        = trim($_POST['name']);
        $description = trim($_POST['description']);
        $datetime    = $_POST['event_datetime'];
        $location    = trim($_POST['location']);

        $stmt = $pdo->prepare("
            INSERT INTO events (user_id, name, description, event_datetime, location)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $userId,
            $name,
            $description,
            $datetime,
            $location
        ]);

        header('Location: /organizer/events');
        exit;
    }

    // SHOW EDIT FORM
    public function edit()
    {
        require_once __DIR__ . '/../../config/db.php';

        $eventId = $_GET['id'];
        $userId  = $_SESSION['user']['id'];

        $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ? AND user_id = ?");
        $stmt->execute([$eventId, $userId]);
        $event = $stmt->fetch();

        if (!$event) {
            die('Event not found or unauthorized.');
        }

        $this->view('organizer/events/edit', [
            'title' => 'Edit Event',
            'event' => $event
        ]);
    }

    // UPDATE EVENT
    public function update()
    {
        require_once __DIR__ . '/../../config/db.php';

        $eventId     = $_POST['id'];
        $userId      = $_SESSION['user']['id'];
        $name        = trim($_POST['name']);
        $description = trim($_POST['description']);
        $datetime    = $_POST['event_datetime'];
        $location    = trim($_POST['location']);

        $stmt = $pdo->prepare("
            UPDATE events 
            SET name = ?, description = ?, event_datetime = ?, location = ?
            WHERE id = ? AND user_id = ?
        ");

        $stmt->execute([
            $name,
            $description,
            $datetime,
            $location,
            $eventId,
            $userId
        ]);

        header('Location: /organizer/events');
        exit;
    }

    // DELETE EVENT
    public function delete()
    {
        require_once __DIR__ . '/../../config/db.php';

        $eventId = $_POST['id'];
        $userId  = $_SESSION['user']['id'];

        $stmt = $pdo->prepare("DELETE FROM events WHERE id = ? AND user_id = ?");
        $stmt->execute([$eventId, $userId]);

        header('Location: /organizer/events');
        exit;
    }
}
