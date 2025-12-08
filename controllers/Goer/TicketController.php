<?php

class TicketController extends Controller
{
    public function myTickets()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user']['id'];

        require __DIR__ . '/../../config/db.php';

        $stmt = $pdo->prepare("
            SELECT 
                o.id AS order_id,
                o.created_at,
                o.total,
                oi.quantity,
                t.ticket_type AS ticket_type,
                t.price,
                e.name AS event_name,
                e.event_datetime
            FROM orders o
            JOIN order_items oi ON o.id = oi.order_id
            JOIN tickets t ON oi.ticket_id = t.id
            JOIN events e ON t.event_id = e.id
            WHERE o.user_id = ?
            ORDER BY o.created_at DESC
        ");

        $stmt->execute([$userId]);
        $tickets = $stmt->fetchAll();

        $this->view('goer/my_tickets', [
            'tickets' => $tickets
        ]);
    }
}
