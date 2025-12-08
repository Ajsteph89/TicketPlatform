<?php

class CheckoutController extends Controller
{
    // Show checkout page
    public function index()
    {
        $cart = $_SESSION['cart'] ?? [];

        if (empty($cart)) {
            header('Location: /cart');
            exit;
        }

        $this->view('checkout/index', [
            'title' => 'Checkout',
            'cart'  => $cart
        ]);
    }

    //  Process order
    public function process()
    {
        require_once __DIR__ . '/../../config/db.php';

        $cart = $_SESSION['cart'] ?? [];

        if (empty($cart)) {
            header('Location: /cart');
            exit;
        }

        $pdo->beginTransaction();

        try {
            $total = 0;

            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $userId = $_SESSION['user']['id'] ?? null;

            // Create order
            $customerName  = $_POST['customer_name'];
            $customerEmail = $_POST['customer_email'];
            $paymentLast4  = substr(preg_replace('/\D/', '', $_POST['card'] ?? '4242424242424242'), -4);

            $stmt = $pdo->prepare("
                INSERT INTO orders (user_id, total, customer_name, customer_email, payment_last4)
                VALUES (?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $userId,
                $total,
                $customerName,
                $customerEmail,
                $paymentLast4
            ]);

            $orderId = $pdo->lastInsertId();

            // Prepare statements
            $insertItem = $pdo->prepare("
                INSERT INTO order_items (order_id, ticket_id, quantity, price)
                VALUES (?, ?, ?, ?)
            ");

            $lockTicket = $pdo->prepare("
                SELECT quantity 
                FROM tickets 
                WHERE id = ?
                FOR UPDATE
            ");

            $updateTicket = $pdo->prepare("
                UPDATE tickets 
                SET quantity = quantity - ?
                WHERE id = ?
            ");

            foreach ($cart as $item) {
                $ticketId = $item['ticket_id'];
                $qty      = $item['quantity'];
                $price    = $item['price'];

                // ✅ Lock ticket row
                $lockTicket->execute([$ticketId]);
                $currentQty = $lockTicket->fetchColumn();

                if ($currentQty === false || $currentQty < $qty) {
                    throw new Exception("Not enough inventory for ticket ID {$ticketId}");
                }

                // ✅ Insert order item
                $insertItem->execute([
                    $orderId,
                    $ticketId,
                    $qty,
                    $price
                ]);

                // ✅ Decrement inventory
                $updateTicket->execute([
                    $qty,
                    $ticketId
                ]);
            }

            // ✅ Clear cart
            unset($_SESSION['cart']);

            $pdo->commit();

            header('Location: /checkout/success');
            exit;

        } catch (Exception $e) {
            $pdo->rollBack();
            die("Checkout failed: " . $e->getMessage());
        }
    }

    public function success()
    {
        $this->view('checkout/success', [
            'title' => 'Order Completed'
        ]);
    }

}
