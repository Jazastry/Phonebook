<div>
    <a href="/logged/groups/addPhone/<?php 
        if(! empty($this->phone['id']) ) { echo htmlspecialchars($this->phone['id']); } ?>">       
        <button type="button">Manage Phone Groups</button>
    </a>    
    <a href="/logged/phones/update/<?php
        if(! empty($this->phone['id']) ) { echo htmlspecialchars($this->phone['id']); } ?>">
        <button>Update</button>
    </a>
</div>

