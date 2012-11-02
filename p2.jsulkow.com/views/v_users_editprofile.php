
    <div class="middle">
    
        <div class="text"><?=$user->first_name?>'s profile on <span class="raven">Raven</span> 
        <br>About Me.
        </div>
        <div class="aboutme">
            <form method='POST' action='/users/p_editProfile'>
        
                I Live In<br>
                <input type='text' name='lives_in'>
                <br>
    
                My Job Is<br>
                <input type='text' name='job'>
                <br>
                   
                Favorite Poet<br>
                
                <input type='text' name='favorite_poet'>
                <br>

            <input type='submit'>
    
        </form>
    </div>
    </div>
