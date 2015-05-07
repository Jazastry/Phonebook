<h1><?php if(! empty($this->title)) {echo $this->title;} ?></h1>
<div class='mainList'>
    <h3>Group: <?php echo $this->group['name']; ?></h3>
    <ul>
    <?php foreach ($this->phones as $phone) : ?>
        <li>
            <a href="/logged/phones/view/<?php echo htmlspecialchars($phone['id']); ?>">
            <?php echo htmlspecialchars($phone['name']); ?>
            </a>
        </li> 
    <?php endforeach;?>
    </ul>
</div>
<div class="panel">
    <div>
        <a href="/logged/groups"><button type="submit" form="phonesCreateForm">Groups</button></a>
        <a href="/logged/phones"><button type="button">Phones</button></a>
    </div>
</div>