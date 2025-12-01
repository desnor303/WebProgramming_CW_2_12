<h2>Users</h2>

<p>
    <a href="adduser.php">Add New User</a>
</p>

<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($users)): ?>
        <tr>
            <td colspan="3">No users found.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($u['email'], ENT_QUOTES, 'UTF-8') ?></td>
                <td>
                    <a href="edituser.php?id=<?= (int)$u['id'] ?>">Edit</a>
                    |
                    <a href="deleteuser.php?id=<?= (int)$u['id'] ?>"
                       onclick="return confirm('Delete this user? All their questions may also be deleted.');">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
