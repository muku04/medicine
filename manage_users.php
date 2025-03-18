<?php

include 'admin_header.php';
include 'db.php';

// Fetch users
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <h1>Manage Users</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Approved</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><?php echo $row['approved'] ? 'Yes' : 'No'; ?></td>
                    <td>
                        <form method="POST" action="approve_user.php">
                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                            <button type="submit"><?php echo $row['approved'] ? 'Disapprove' : 'Approve'; ?></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include 'footer.php';
?>