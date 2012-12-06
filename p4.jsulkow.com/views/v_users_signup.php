
       <h1>Sign Up Here.</h1>
       
<form id="signup" method='POST' action='/users/p_signup'>
    First Name<br>
    <input type='text' id="firstname" name='first_name'>
       <span id='firstnamemsg'></span>
        
    <br><br>
    
    Last Name
    <br><br>
    <input type='text' id="lastname" name='last_name'>
       <span id='lastnamemsg'></span>
    <br><br>
    
    Email<br>
    <input type='text' id="email" name='email'>
       <span id='emailmsg'></span>
    <br><br>
    
    Password (at least 6 characters)<br>
    <input type='password' id="password" name='password'>
       <span id='passwordmsg'></span>
    <br><br>
    
    <input type='submit'>
    
</form>

<div id="signup_error">
       
</div>



