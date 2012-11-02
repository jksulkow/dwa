<html>
<head></head>
<body>
    <div class="middle">
    
        <div class="text"><?=$user->first_name?>'s profile on <span class="raven">Raven</span> 
        <br>About Me.
        </div>
        <div class="aboutme">
            <form method='POST' action='/users/p_editProfile'>
        
                I Live In
                <span class="profileform"><input type='text' name='lives_in'></span>
                <br>
    
                My Job Is
                <span class="profileform"><input type='text' name='job'></span>
                <br>
                   
                Favorite Poet
                
                <span class="profileform"><input type='text' name='favorite_poet'></span>
                <br>

            <input type='submit'>
    
        </form>
    </div>
    </div>

</body>
</html>