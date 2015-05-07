<div>
    <a href="/logged/home">       
        <button type="button">Home</button>
    </a>    
    <a href="/logged/groups">       
        <button type="button">Groups</button>
    </a>
    <a href="/logged/phones">       
        <button type="button">Phones</button>
    </a> 
    <a href="/logged/groups/addPhone/<?php 
        if(! empty($this->phone['id']) ) { echo htmlspecialchars($this->phone['id']); } ?>">       
        <button type="button">Manage groups</button>
    </a>    
    <a href="/logged/phones/update/<?php
        if(! empty($this->phone['id']) ) { echo htmlspecialchars($this->phone['id']); } ?>">
        <button>Update</button>
    </a>
    <a href="/account/logout">
        <button>Logout</button>
    </a>
</div>

