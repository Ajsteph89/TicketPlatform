<?php

class TicketAdminController extends Controller
{
    // LIST TICKETS FOR AN EVENT
    public function index()
    {
        require_once __DIR__ . '/../../config/db.php';

        $eventId = $_GET['event_id'];
        $userId  = $_SESSION['user']['id'];

        // Verify organizer owns event
        $check = $pdo->prepare("SELECT id FROM events WHERE id = ? AND user_id = ?");
        $check->execute([$eventId, $userId]);

        if (!$check->fetch()) {
            die('Unauthorized access.');
        }

        $stmt = $pdo->prepare("SELECT * FROM tickets WHERE event_id = ? ORDER BY created_at DESC");
        $stmt->execute([$eventId]);
        $tickets = $stmt->fetchAll();

        $this->view('organizer/tickets/index', [
            'title'    => 'Manage Tickets',
            'tickets'  => $tickets,
            'event_id' => $eventId
        ]);
    }

    // SHOW CREATE FORM
    public function create()
    {
        $eventId = $_GET['event_id'];

        $this->view('organizer/tickets/create', [
            'title'    => 'Create Ticket',
            'event_id' => $eventId
        ]);
    }

    // STORE TICKET
    public function store()
    {
        require_once __DIR__ . '/../../config/db.php';

        $eventId    = $_POST['event_id'];
        $userId     = $_SESSION['user']['id'];
        $type       = $_POST['ticket_type'];
        $saleStart  = $_POST['sale_start'];
        $saleEnd    = $_POST['sale_end'];
        $quantity   = (int)$_POST['quantity'];
        $price      = $_POST['price'];
        $visibility = $_POST['visibility'];

        $stmt = $pdo->prepare("
            INSERT INTO tickets 
            (event_id, user_id, ticket_type, sale_start, sale_end, quantity, price, visibility)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $eventId,
            $userId,
            $type,
            $saleStart,
            $saleEnd,
            $quantity,
            $price,
            $visibility
        ]);

        header("Location: /organizer/events/tickets?event_id={$eventId}");
        exit;
    }

    // SHOW EDIT FORM
    public function edit()
    {
        require_once __DIR__ . '/../../config/db.php';

        $ticketId = $_GET['id'];
        $eventId  = $_GET['event_id'];
        $userId   = $_SESSION['user']['id'];

        $stmt = $pdo->prepare("
            SELECT t.* 
            FROM tickets t
            JOIN events e ON t.event_id = e.id
            WHERE t.id = ? AND e.user_id = ?
        ");
        $stmt->execute([$ticketId, $userId]);
        $ticket = $stmt->fetch();

        if (!$ticket) {
            die('Unauthorized.');
        }

        $this->view('organizer/tickets/edit', [
            'title'     => 'Edit Ticket',
            'ticket'   => $ticket,
            'event_id' => $eventId
        ]);
    }

    // UPDATE TICKET
    public function update()
    {
        require_once __DIR__ . '/../../config/db.php';

        $ticketId  = $_POST['id'];
        $eventId   = $_POST['event_id'];
        $type      = $_POST['ticket_type'];
        $saleStart = $_POST['sale_start'];
        $saleEnd   = $_POST['sale_end'];
        $quantity  = (int)$_POST['quantity'];
        $price     = $_POST['price'];
        $visibility = $_POST['visibility'];
        $userId    = $_SESSION['user']['id'];

        $stmt = $pdo->prepare("
            UPDATE tickets t
            JOIN events e ON t.event_id = e.id
            SET 
                t.ticket_type = ?,
                t.sale_start = ?,
                t.sale_end = ?,
                t.quantity = ?,
                t.price = ?,
                t.visibility = ?
            WHERE t.id = ? AND e.user_id = ?
        ");

        $stmt->execute([
            $type,
            $saleStart,
            $saleEnd,
            $quantity,
            $price,
            $visibility,
            $ticketId,
            $userId
        ]);

        header("Location: /organizer/events/tickets?event_id={$eventId}");
        exit;
    }

    // DELETE TICKET
    public function delete()
    {
        require_once __DIR__ . '/../../config/db.php';

        $ticketId = $_POST['id'];
        $eventId  = $_POST['event_id'];
        $userId   = $_SESSION['user']['id'];

        $stmt = $pdo->prepare("
            DELETE t 
            FROM tickets t
            JOIN events e ON t.event_id = e.id
            WHERE t.id = ? AND e.user_id = ?
        ");
        $stmt->execute([$ticketId, $userId]);

        header("Location: /organizer/events/tickets?event_id={$eventId}");
        exit;
    }
}
