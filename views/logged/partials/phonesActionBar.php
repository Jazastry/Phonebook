<div>
    <a href="/logged/groups/addPhone/<?php 
        if(! empty($this->phone['id']) ) { echo $this->phone['id']; } ?>" method="POST">       
        <button type="button">Add to group</button>
    </a>    
    <a href="/logged/phones/update/<?php
        if(! empty($this->phone['id']) ) { $this->phone['id']; } ?>">
        <button>Update</button>
    </a>
</div>

