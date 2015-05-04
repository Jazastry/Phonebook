<div class='phones'>
    <ul>
        <li><span>Name:</span> <?php echo htmlspecialchars($this->phone['name']); ?></li>
        <li><span>Number:</span> <?php echo htmlspecialchars($this->phone['number']); ?></li>
        <li><span>Address:</span> <?php echo htmlspecialchars($this->phone['address']); ?></li>
        <li><span>Email:</span> <?php echo htmlspecialchars($this->phone['email']); ?></li>
    <?php if (! empty($this->costumFields)) : ?>
    <?php    foreach($this->costumFields as $field) : ?>
        <li><span><?php echo htmlspecialchars($field['field_name']); ?></span>
            <?php echo htmlspecialchars($field['field_value']); ?>
        </li>
    <?php endforeach; ?>
    <?php endif; ?>
    </ul>
    <a href="/phones/update/<?php echo $this->phone['id']; ?>">
        <button type="button">Update</button>
    </a>   
</div>