<h2>Modules</h2>

<p>
    <a href="addmodule.php">Add New Module</a>
</p>

<table>
    <thead>
    <tr>
        <th>Module Name</th>
        <th>Description</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($modules)): ?>
        <tr>
            <td colspan="4">No modules found.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($modules as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m['name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($m['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($m['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
                <td>
                    <a href="editmodule.php?id=<?= (int)$m['id'] ?>">Edit</a>
                    |
                    <a href="deletemodule.php?id=<?= (int)$m['id'] ?>"
                       onclick="return confirm('Delete this module? Related questions may also be removed.');">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
