<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

include 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

switch($action) {
    case 'get_user':
        $phone = $_GET['phone'] ?? '';
        $stmt = $pdo->prepare("SELECT * FROM users WHERE phone = ?");
        $stmt->execute([$phone]);
        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
        break;
        
    case 'update_earnings':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("UPDATE users SET total_earnings = ? WHERE phone = ?");
        $stmt->execute([$data['earnings'], $data['phone']]);
        echo json_encode(['success' => true]);
        break;
        
    case 'complete_task':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO tasks (user_id, task_name, earning_amount) VALUES (?, ?, ?)");
        $stmt->execute([$data['user_id'], $data['task'], $data['amount']]);
        echo json_encode(['success' => true]);
        break;
        
    case 'buy_premium':
        $phone = $_POST['phone'] ?? '';
        $stmt = $pdo->prepare("UPDATE users SET plan_type = 'premium', is_premium = 1, multiplier = 2 WHERE phone = ?");
        $stmt->execute([$phone]);
        echo json_encode(['success' => true]);
        break;
}
?>