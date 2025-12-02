<h2>Login</h2>

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
        <label for="password">Password:</label><br>
        <input
            type="password"
            id="password"
            name="password"
            required
        >
    </p>

    <p>
        <button type="submit">Login</button>
    </p>
</form>
