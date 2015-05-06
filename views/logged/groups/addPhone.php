<h1><?php if(! empty($this->title)) {echo $this->title;} ?></h1>
<h3>
    <span class="text-s">the phone of </span>
    <?php if(! empty($this->phone['name'])) {echo $this->phone['name'];} ?>
</h3>
<form class="checkForm" method="POST" id="addPhoneToGroups">
    
    <!-- SAVE PHONE_ID -->
    <input type="hidden" name="phone_id" value="<?php if(! empty($this->phone['id'])) { echo $this->phone['id'];} ?>"/>
    
    <ul>
        <?php foreach ($this->groups as $group) : ?>              
            <li>
                
                <!-- PRINT GROUP NAME -->
                <span><?php echo $group['name']; ?></span>
                
                 <!-- ASSIGN CHECK TO PHONE ASSIGNED GROUPS --> 
                <input type="checkbox" name="<?php
                
                 //   ASSIGN GROUP-DATA TO INPUT
                    echo 'group_id' . $group['id'] ?>" value="<?php
                        echo $group['id'] ?>" <?php 
                            if (! empty( $group['checked'] ) ) {
                                echo 'checked';
                            }
                        ?>/>
            </li>            
        <?php endforeach;?>
    </ul>
</form>
<div class="panel">
    <div>
        <button type="submit" form="addPhoneToGroups">Add phone to selected groups</button>
    </div>
</div>