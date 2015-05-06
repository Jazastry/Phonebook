<h1><?php if(! empty($this->title)) {echo $this->title;} ?></h1>
<form  method="POST">
    <h3>Create new group</h3>    
    <label for="name">Name</label>
    <input type="text" name="name"/> 
    <div>
        <button type="submit">Submit</button>
        <a href="/phones"><button type="button">Cancel</button></a>
    </div> 
</form>