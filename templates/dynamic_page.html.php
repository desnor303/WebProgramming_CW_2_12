<?php if ($page['has_image']): ?>
    <th>Image</th>
<?php endif; ?>
...
<?php if (!empty($row['image_path'])): ?>
    <img src="../<?= htmlspecialchars($row['image_path']) ?>" alt="" class="thumb">
<?php else: ?>
    —
<?php endif; ?>
