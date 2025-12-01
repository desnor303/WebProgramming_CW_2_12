<h2>Contact</h2>

<?php if (!empty($errors)): ?>
    <div class="errors">
        <ul>
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <p class="success">Your message has been sent successfully.</p>
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
        <label for="subject">Subject:</label><br>
        <input
            type="text"
            id="subject"
            name="subject"
            required
            value="<?= htmlspecialchars($subject ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >
    </p>

    <p>
        <label for="message">Message:</label><br>
        <textarea
            id="message"
            name="message"
            rows="5"
            required
        ><?= htmlspecialchars($message ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
    </p>

    <p>
        <button type="submit">Send</button>
    </p>
</form>
