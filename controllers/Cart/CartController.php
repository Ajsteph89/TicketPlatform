<?php

class CartController extends Controller
{
    // Show cart
    public function index()
    {
        $cart = $_SESSION['cart'] ?? [];

        $this->view('cart/index', [
            'title' => 'Your Cart',
            'cart'  => $cart
        ]);
    }

    // Add to cart
    public function add()
    {
        require_once __DIR__ . '/../../config/db.php';
    
        $ticketId = $_POST['ticket_id'];
        $qtyToAdd = max(1, (int)($_POST['quantity'] ?? 1));
    
        // Fetch ticket + event info
        $stmt = $pdo->prepare("
            SELECT 
                t.*, 
                e.name AS event_name
            FROM tickets t
            JOIN events e ON t.event_id = e.id
            WHERE t.id = ? AND t.visibility = 'public'
        ");
        $stmt->execute([$ticketId]);
        $ticket = $stmt->fetch();
    
        if (!$ticket) {
            die('Invalid ticket.');
        }
    
        // Initialize cart if needed
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    
        // Current qty already in cart
        $existingQty = $_SESSION['cart'][$ticketId]['quantity'] ?? 0;
    
        // Enforce inventory limit
        $newQty = min(
            $existingQty + $qtyToAdd,
            $ticket['quantity']
        );
    
        $_SESSION['cart'][$ticketId] = [
            'ticket_id'  => $ticket['id'],
            'event_name' => $ticket['event_name'],
            'type'       => $ticket['ticket_type'],
            'price'      => $ticket['price'],
            'quantity'   => $newQty
        ];
    
        header('Location: /cart');
        exit;
    }

    //  Remove one item
    public function remove()
    {
        $ticketId  = $_POST['ticket_id'];
        $qtyToRemove = max(1, (int)($_POST['quantity'] ?? 1));

        if (!isset($_SESSION['cart'][$ticketId])) {
            header('Location: /cart');
            exit;
        }

        $currentQty = $_SESSION['cart'][$ticketId]['quantity'];

        $newQty = $currentQty - $qtyToRemove;

        // If quantity drops to 0 or below, remove item entirely
        if ($newQty <= 0) {
            unset($_SESSION['cart'][$ticketId]);
        } else {
            $_SESSION['cart'][$ticketId]['quantity'] = $newQty;
        }

        header('Location: /cart');
        exit;
    }


    // Clear entire cart
    public function clear()
    {
        unset($_SESSION['cart']);
        header('Location: /cart');
        exit;
    }
}
