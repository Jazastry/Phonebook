<div class='phones'>
    <ul>
    <?php foreach ($this->groups as $group) : ?>
        <a href="/logged/groups/view/<?php echo htmlspecialchars($group['id']); ?>"><li>
            <?php echo htmlspecialchars($group['name']); ?></li></s>
    <?php endforeach;?>
    </ul>
</div>
