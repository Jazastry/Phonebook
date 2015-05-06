<h1><?php if(! empty($this->title)) {echo $this->title;} ?></h1>
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
    <div>
        <a href="/logged/phones/create"><button type="button">Add New Record</button></a>
    </div>
</div>


