<h1><?php if(! empty($this->title)) {echo $this->title;} ?></h1>
<form id="phonesCreateForm" method="POST">
    <h3>Create new group</h3>    
    <label for="name">Name</label>
    <input type="text" name="name"/>
</form>
<div class="panel">
    <div>
        <button type="submit" form="phonesCreateForm">Create</button>
        <a href="/logged/groups"><button type="button">Cancel</button></a>
    </div>
</div>