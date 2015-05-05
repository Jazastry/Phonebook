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
        <button type="submit">Submit</button>
        <a href="/phones"><button type="button">Cancel</button></a>
    </div> 
</form>
<div class="panel">
    <button id="addCustom" type="button">Add custom field</button>
    <button id="removeCustom" type="button">Remove custom field</button>
</div>