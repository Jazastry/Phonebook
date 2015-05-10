<h1><?php if(! empty($this->title)) {echo $this->title;} ?></h1>
<div class='mainList'>
    <ul>
        <li><span>name:</span> <?php echo htmlspecialchars($this->phone['name']); ?></li>
        <li><span>number:</span> <?php echo htmlspecialchars($this->phone['number']); ?></li>
        <li><span>address:</span> <?php echo htmlspecialchars($this->phone['address']); ?></li>
        <li><span>email:</span> <?php echo htmlspecialchars($this->phone['email']); ?></li>
        
        <!-- ASSIGN CUSTOM FIELDS -->
    <?php if (! empty($this->costumFields)) : ?>
    <?php    foreach($this->costumFields as $field) : ?>
        <li><span><?php echo htmlspecialchars($field['field_name']) . ':'; ?></span>
            <?php echo htmlspecialchars($field['field_value']); ?>
        </li>
    <?php endforeach; ?>
    <?php endif; ?>
        
        <!-- ASSIGN GROUPS -->        
    <?php if (! empty($this->groups)) : ?>
        <li><span>groups:</span> 
    <?php     foreach($this->groups as $group) {
             echo htmlspecialchars($group['name']) . ', ';
         }
     endif;?>  
        </li>
    </ul>  
</div>
<div class="panel">
    <div>
        <a href="/logged/phones/update/<?php echo htmlspecialchars($this->phone['id']); ?>"><button type="button">Update</button></a>
        <a href="/logged/phones"><button type="button">Back</button></a>
    </div>
</div>