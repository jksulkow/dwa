<html>
<head></head>
<body>
    <div class="middle">
    
        <div class="text"><?=$user->first_name?>'s profile on <span class="raven">Raven</span> 
        </div>
        
        <div class="aboutme">
        I live in <span class= "aboutinfo"><?=$user->lives_in?></span><br>
        My job: <span class= "aboutinfo"><?=$user->job?> </span><br>
	My favorite poet: <span class= "aboutinfo"><?=$user->favorite_poet?></span>
        </div>

    </div>

</body>
</html>