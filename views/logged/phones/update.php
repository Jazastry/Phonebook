<form id="phonesUpdateForm" method="POST" action="">
    <h3>Update record</h3>
    <input type="hidden" name="phoneId" value="<?php echo htmlspecialchars($this->phone['id']); ?>"/>
    <label for="name">Name</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($this->phone['name']) ?>"/>
    <label for="number">Phone Number</label>
    <input type="tel" name="number" value="<?php echo htmlspecialchars($this->phone['number']); ?>"/>
    <label for="email">Email</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($this->phone['email']); ?>"/>
    <label for="address">Address</label>
    <input type="text" name="address" value="<?php echo htmlspecialchars($this->phone['address']); ?>"/>
    
    <?php 
        $counter = 0;
        if (! empty($this->costumFields)) : 
           foreach($this->costumFields as $field) : 
    ?>
    
    <div class="customField">
        <div>
            <label for="field<?php echo $counter; ?>_name">Field name</label>
            <input type="text" name="field<?php echo $counter; ?>_name" value="<?php echo htmlspecialchars($field['field_name']); ?>"/>
        </div>
        <div>
            <label for="field<?php echo $counter; ?>_value">Field value</label>
            <input type="text" name="field<?php echo $counter; ?>_value" value="<?php echo htmlspecialchars($field['field_value']); ?>"/>
        </div>
    </div>
    
    <?php   
            $counter += 1;
            endforeach; 
        endif;
    ?>   
    <div>
        <button id="addCustom" type="button">Add custom field</button>
        <button id="removeCustom" type="button">Remove custom field</button>
    </div> 
</form>
<div class="panel">
    <div>
        <button type="submit" form="phonesUpdateForm">Update record</button>
        <a href="/logged/phones"><button type="button">Cancel</button></a>
    </div>
</div>
