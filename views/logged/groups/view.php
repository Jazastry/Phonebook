<div class='mainList'>
    <h3>Group: <?php echo $this->group['name']; ?></h3>
    <ul>
    <?php foreach ($this->phones as $phone) : ?>
        <li>
            <?php echo htmlspecialchars($phone['name']); ?>
            <a class="delBtn" href="/logged/phones/delete/<?php echo htmlspecialchars($phone['id']); ?>">
                DELETE
            </a>
        </li> 
    <?php endforeach;?>
    </ul>
</div>