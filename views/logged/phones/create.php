<h1><?php if(! empty($this->title)) {echo $this->title;} ?></h1>
<form id="phonesCreateForm" method="POST">
    <h3>Create new record</h3>    
    <label for="name">Name</label>
    <input type="text" name="name"/>    
    <label for="number">Phone Number</label>
    <input type="tel" name="number"/>
    <label for="email">Email</label>
    <input type="email" name="email"/>
    <label for="address">Address</label>
    <input type="text" name="address"/>
    <div>
        <button id="addCustom" type="button">Add custom field</button>
        <button id="removeCustom" type="button">Remove custom field</button>
    </div> 
</form>
<div class="panel">
    <div>
        <button type="submit" form="phonesCreateForm">Create</button>
        <a href="/logged/phones"><button type="button">Cancel</button></a>
    </div>
</div>