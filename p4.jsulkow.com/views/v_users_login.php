
 <div class="middle">

    <div>Log In To Start</div>
    
<form method='POST' action='/users/p_login'>
      
    Email<br>
    <input type = 'text' name='email'>
        
    <br><br>
	
	Password<br>
	<input type='password' name='password'>

	<br><br>
        
        <? if($error): ?>
	    <div class='error'>
		Login failed. Please check your email and password and try again.
	    </div>
	    <br>
	<? endif; ?>
	
	<input type='submit'>
    
</form>

 </div>