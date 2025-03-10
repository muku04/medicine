<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: admin_login.php");
    exit();
}

include 'admin_header.php';
include 'db.php';

if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    $sql = "UPDATE users SET approval=1 WHERE id=$id";
    $conn->query($sql);
}

if (isset($_GET['reject'])) {
    $id = $_GET['reject'];
    $sql = "DELETE FROM users WHERE id=$id";
    $conn->query($sql);
}

$pending_users = [];
$sql = "SELECT * FROM users WHERE approval=0";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $pending_users[] = $row;
}

include 'footer.php';
?>

<div class="container">
    <h1>Approve Users</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
               
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pending_users as $user) { ?>
                <tr>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td>
                        <a href="approve_user.php?approve=<?php echo $user['id']; ?>">Approve</a> | 
                        <a href="approve_user.php?reject=<?php echo $user['id']; ?>">Reject</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>