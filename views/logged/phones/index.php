<div class='phones'>
    <ul>
    <?php foreach ($this->phones as $phone) : ?>
        <a href="/logged/phones/view/<?php echo htmlspecialchars($phone['id']); ?>"><li>
            <?php echo htmlspecialchars($phone['name']); ?></li></s>
    <?php endforeach;?>
    </ul>
</div>





