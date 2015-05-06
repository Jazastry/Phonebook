<h1><?php if(! empty($this->title)) {echo $this->title;} ?></h1>
<div class='mainList'>
    <ul>
        <li><span>name:</span> <?php echo htmlspecialchars($this->phone['name']); ?></li>
        <li><span>number:</span> <?php echo htmlspecialchars($this->phone['number']); ?></li>
        <li><span>address:</span> <?php echo htmlspecialchars($this->phone['address']); ?></li>
        <li><span>email:</span> <?php echo htmlspecialchars($this->phone['email']); ?></li>
    <?php if (! empty($this->costumFields)) : ?>
    <?php    foreach($this->costumFields as $field) : ?>
        <li><span><?php echo htmlspecialchars($field['field_name']) . ':'; ?></span>
            <?php echo htmlspecialchars($field['field_value']); ?>
        </li>
    <?php endforeach; ?>
    <?php endif; ?>
    </ul>  
</div>
<div class="panel">
    <div>
        <a href="/logged/phones/update"><button type="button">Update</button></a>
    </div>
</div>