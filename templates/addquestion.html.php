<h2><?= htmlspecialchars($title) ?></h2>

<?php if (!empty($errors)): ?>
    <div class="errors">
        <ul>
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="" method="post" enctype="multipart/form-data">
    <p>
        <label for="question_text">Question:</label><br>
        <textarea name="question_text" id="question_text" rows="4" required><?= 
            htmlspecialchars($question_text)
        ?></textarea>
    </p>

    <p>
        <label for="user_id">User:</label><br>
        <select name="user_id" id="user_id" required>
            <option value="">-- Select user --</option>
            <?php foreach ($users as $u): ?>
                <option value="<?= (int)$u['id'] ?>"
                    <?= $user_id == $u['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($u['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        <label for="module_id">Module:</label><br>
        <select name="module_id" id="module_id" required>
            <option value="">-- Select module --</option>
            <?php foreach ($modules as $m): ?>
                <option value="<?= (int)$m['id'] ?>"
                    <?= $module_id == $m['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($m['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        <?php if ($currentImage): ?>
            <label>Current image:</label><br>
            <!-- currentImage is 'uploads/xxx', need ../ -->
            <img src="../<?= htmlspecialchars($currentImage) ?>" class="thumb" alt="">
        <?php endif; ?>
    </p>

    <p>
        <label for="image">Image (optional):</label><br>
        <input type="file" name="image" id="image" accept="image/*">
    </p>

    <p>
        <button type="submit">Save</button>
    </p>
</form>
