<?php

class TestController extends Controller
{
    public function index()
    {
        require_once __DIR__ . '/../config/db.php';

        $stmt = $pdo->query("SELECT 1");
        $result = $stmt->fetchColumn();

        $this->view('test', [
            'title' => 'DB Test',
            'dbResult' => $result
        ]);
    }
}
