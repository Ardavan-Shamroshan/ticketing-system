<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
// Output message variable
$msg = '';
// Check if POST data exists (user submitted the form)
if (isset($_POST['id'], $_POST['title'], $_POST['msg'])) {
    // Validation checks... make sure the POST data is not empty
    if (empty($_POST['id']) || empty($_POST['title']) || empty($_POST['msg'])) {
        $msg = 'Please complete the form!';
    } else {
        // Insert new record into the tickets table
        $stmt = $pdo->prepare('INSERT INTO tickets (id, user_id, title, msg) VALUES (?, ?, ?, ?)');
        $stmt->execute([$_POST['id'], 1, $_POST['title'], $_POST['msg']]);
        // Redirect to the view ticket page, the user will see their created ticket on this page
        header('Location: view.php?id=' . $pdo->lastInsertId());
    }
}

// MySQL query that selects the ticket by the ID column, using the ID GET request variable
$stmt = $pdo->query('SELECT * FROM `tickets` ORDER BY `created` DESC LIMIT 1;');
$stmt->execute();
$ticket = $stmt->fetch(PDO::FETCH_ASSOC);
// Check if ticket exists

$latestTicketCreated = strtotime($ticket['created']);
$day = 60 * 60 * 24;
$deadline = $latestTicketCreated + $day;

$left = $deadline - time();

if ((time() <= $deadline) && ($left > 0)) {
    $data = ['message' => 'برای ارسال تیکت جدید صبر کنید', 'left' => date('H:i', $left)];
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}


if (!$ticket) {
    exit('Invalid ticket ID!');
}
?>

<?= template_header('Create Ticket') ?>

<div class="content create">
    <h2>ثبت تیکت</h2>

    <?php if (isset($data)) { ?>
        <div class="btns">
            <a href="#" class="btn red"><?= $data['message'] .' '. $data['left'] ?></a>
        </div>
   <?php } else { ?>
    <form action="create.php" method="post">
        <label for="id">Id</label>
        <small>درصورت خالی رها کردن، بصورت خودکار ایجاد خواهد شد id</small>
        <input type="number" name="id" placeholder="Identification" id="id" required>
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="Title" id="title" required>
        <label for="msg">Message</label>
        <textarea name="msg" placeholder="Enter your message here..." id="msg" required></textarea>
        <input type="submit" value="ثبت">
    </form>

    <?php } ?>

    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>