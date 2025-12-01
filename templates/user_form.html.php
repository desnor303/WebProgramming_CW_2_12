<h2><?= htmlspecialchars($formTitle, ENT_QUOTES, 'UTF-8') ?></h2>

<?php if (!empty($errors)): ?>
    <div class="errors">
        <ul>
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="" method="post">
    <p>
        <label for="name">Name:</label><br>
        <input
            type="text"
            id="name"
            name="name"
            required
            value="<?= htmlspecialchars($name ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >
    </p>

    <p>
        <label for="email">Email:</label><br>
        <input
            type="email"
            id="email"
            name="email"
            required
            value="<?= htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >
    </p>

    <p>
        <button type="submit">
            <?= htmlspecialchars($submitLabel, ENT_QUOTES, 'UTF-8') ?>
        </button>
    </p>
</form>
