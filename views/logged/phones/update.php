<form method="POST">
    <h3>Create new record</h3>
    <label for="name">Name</label>
    <input type="text" name="name" value="<?php htmlspecialchars($this->phone['']) ?>"/>
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
