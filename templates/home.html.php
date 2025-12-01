<h2>Questions</h2>

<p>
    <!-- Run by /controller/index.php then href is relative to /controller -->
    <a href="addquestion.php" class="action-link">Add Question</a>
</p>

<table class="data-table">
    <thead>
    <tr>
        <th>Image</th>
        <th>Question</th>
        <th>User</th>
        <th>Module</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    <?php if (empty($questions)): ?>
        <tr>
            <td colspan="6">No questions found.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($questions as $q): ?>
            <tr>
                <td>
                    <?php if (!empty($q['image_path'])): ?>
                        <!-- image_path save in 'uploads/xxx', ../ because URL is in /controller -->
                        <img src="../<?= htmlspecialchars($q['image_path']) ?>" alt="" class="thumb">
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
                <td><?= nl2br(htmlspecialchars($q['question_text'])) ?></td>
                <td><?= htmlspecialchars($q['user_name']) ?></td>
                <td><?= htmlspecialchars($q['module_name']) ?></td>
                <td><?= htmlspecialchars($q['created_at']) ?></td>
                <td>
                    <a href="addquestion.php?id=<?= (int)$q['id'] ?>">Edit</a> |
                    <a href="dynamic_delete.php?table=questions&id=<?= (int)$q['id'] ?>"
                    onclick="return confirm('Delete this question?');">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
