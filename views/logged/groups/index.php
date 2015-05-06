<div class='mainList'>
    <ul>
    <?php foreach ($this->groups as $group) : ?>        
        <li>
            <a href="/logged/groups/view/<?php echo htmlspecialchars($group['id']); ?>">
                <?php echo htmlspecialchars($group['name']); ?>
            </a>    
            <a class="delBtn" href="/logged/groups/delete/<?php echo htmlspecialchars($group['id']); ?>">DELETE</a>
        </li>       
    <?php endforeach;?>
    </ul>
</div>
<div class="panel">
    <a href="/logged/groups/create"><button type="button">Add group</button></a>    
</div>