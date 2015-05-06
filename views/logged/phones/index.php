<div class='mainList'>
    <ul>
    <?php foreach ($this->phones as $phone) : ?>       
        <li>
            <a href="/logged/phones/view/<?php echo htmlspecialchars($phone['id']); ?>">
            <?php echo htmlspecialchars($phone['name']); ?>
            </a>
            <a class="delBtn" href="/logged/phones/delete/<?php echo htmlspecialchars($phone['id']); ?>">
                DELETE
            </a>
        </li>                    
    <?php endforeach;?>
    </ul>
</div>
<div class="panel">
    <a href="/logged/groups/create"><button type="button">Add group</button></a>    
</div>


