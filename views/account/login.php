<form name="loginForm" method="POST">
    <h3>Login Form</h3>
    <input type="hidden" name="formToken" value="<?php echo $_SESSION['formToken']; ?>"
    <label for="username">User Name</label>
    <input type="tyext" name="username"/>
    <label for="password">Password</label>
    <input type="password" name="password"/>
    <div>
        <button type="submit">Submit</button>
        <a href="/"><button type="button">Cancel</button></a>
    </div>     
</form>

