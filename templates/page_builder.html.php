<h2>Create New Dynamic Page</h2>

<?php if (!empty($errors)): ?>
    <div class="errors">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="" method="post">
    <p>
        <label for="name">Page Name:</label><br>
        <input type="text"
               id="name"
               name="name"
               required
               value="<?= htmlspecialchars($name ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </p>

    <p>
        <label for="slug">Slug (for URL):</label><br>
        <input type="text"
               id="slug"
               name="slug"
               required
               value="<?= htmlspecialchars($slug ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <small>Example: faq, news</small>
    </p>

    <p>
        <label for="tableName">Database Table Name:</label><br>
        <input type="text"
               id="tableName"
               name="tableName"
               required
               value="<?= htmlspecialchars($tableName ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <small>Example: page_faq, page_news</small>
    </p>

    <fieldset>
        <legend>Columns</legend>

        <p>
            <label>
                <input type="checkbox"
                       name="hasImage"
                       value="1"
                    <?= !empty($hasImage) ? 'checked' : '' ?>>
                Include Image column
            </label>
        </p>

        <p>
            <label>
                <input type="checkbox"
                       name="hasDate"
                       value="1"
                    <?= !isset($hasDate) || $hasDate ? 'checked' : '' ?>>
                Include Date column
            </label>
        </p>

        <p>
            <label>
                <input type="checkbox"
                       name="hasUser"
                       value="1"
                    <?= !empty($hasUser) ? 'checked' : '' ?>>
                Link to User (userID)
            </label>
        </p>

        <p>
            <label>
                <input type="checkbox"
                       name="hasModule"
                       value="1"
                    <?= !empty($hasModule) ? 'checked' : '' ?>>
                Link to Module (moduleID)
            </label>
        </p>
    </fieldset>

    <p>
        <button type="submit">Create Page</button>
    </p>
</form>
