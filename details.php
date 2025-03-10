<?php
include 'admin_header.php';
include 'db.php';

// Fetch notifications
$query = "SELECT * FROM notifications";
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <h1>Notifications</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Message</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include 'footer.php';
?>