<?php

/**
 * @var \shop\entities\shop\course\Course $course
 */
?>
<div class="row">
    <?php foreach ($dataProvider->getModels() as $course): ?>
        <?= $course->name; ?> <br>
    <?php endforeach; ?>
</div>