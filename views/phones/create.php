<form method="POST">
    <h3>Create new record</h3>
    
    <label for="name">Name</label>
    <input type="text" name="name" 
           value="<?php if (! empty($_POST['name'])) 
               {echo htmlspecialchars($_POST['name']);}?>"/>
    
    <label for="number">Phone Number</label>
    <input type="tel" name="number"
           value="<?php if (! empty($_POST['number'])) 
               {echo htmlspecialchars($_POST['number']);}?>"/>
    
    <label for="email">Email</label>
    <input type="email" name="email"
           value="<?php if (! empty($_POST['email'])) 
               {echo htmlspecialchars($_POST['email']);}?>"/>
    
    <label for="address">Address</label>
    <input type="text" name="address"
           value="<?php if (! empty($_POST['address'])){
                    echo htmlspecialchars($_POST['address']);               
               }?>"/>   
    <?php if (! empty($_POST['custom'])) {
            include_once 'custom.php';
    } ?>
    <div>
        <button type="submit">Submit</button>
        <a href="/phones"><button type="button">Cancel</button></a>
    </div> 
</form>
<form action="/phones/custom/1" method="POST">
    <input type="hidden" name="custom" 
       value="<?php if (empty($_POST['custom'])) {
               echo $_POST['custom'] = 1;
            }?>"/>
    <button class="wideBtn" type="submit">Add Custom Field</button>
</form>
<form action="/phones/custom/2" method="POST">
    <button class="wideBtn" type="submit">Remove Custom Field</button>
</form>
