<?php

class users_controller extends base_controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        Router::redirect("/users/login");
    }
    
    public function signup() {
        
        # Set up the view
        $this->template->content = View::instance("v_users_signup");
        
        # Render the view
        echo $this->template;
    }
    
    public function p_signup() {
       
        # encrypt the password
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
        
        # additional info
        $_POST['created'] = Time::now();
        $_POST['modified'] = Time::now();
        $_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
        
        
        # Put the data in the database
        # call method 'insert', pass it the table name and fields
        DB::instance(DB_NAME)->insert('users', $_POST);
        
        # Send user to the login page
	Router::redirect("/users/login");
    }
    

    public function login($error = NULL) {

	# Setup view
		$this->template->content = View::instance('v_users_login');
        # Pass data to the view
		$this->template->content->error  = $error;
		
	# Render template
		echo $this->template;
	
    }
    
    public function p_login() {
	# Hash submitted password so we can compare it against one in the db
	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
	
	# Search the db for this email and password
	# Retrieve the token if it's available
	$q = "SELECT token 
		FROM users 
		WHERE email = '".$_POST['email']."' 
		AND password = '".$_POST['password']."'";
	
	$token = DB::instance(DB_NAME)->select_field($q);	
				
	# If we didn't get a token back, login failed
	if(!$token) {
			
		# Send them back to the login page

		Router::redirect("/users/login/error");

		
	# But if we did, login succeeded! 
	} else {
			
		# Store this token in a cookie
		@setcookie("token", $token, strtotime('+2 weeks'), '/');
		
		Router::redirect("/users/profile");
					
	}
    }
    
    public function logout() {
        # Generate and save a new token for next login
	$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
	
	# Create the data array we'll use with the update method
	# In this case, we're only updating one field, so our array only has one entry
	$data = Array("token" => $new_token);
	
	# Do the update
	DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
	
	# Delete their token cookie - effectively logging them out
	setcookie("token", "", strtotime('-1 year'), '/');
	
	Router::redirect("/users/login");
    }
    
    public function profile() {
        
	# If user is blank, they're not logged in, redirect to signup/login page
	if(!$this->user) {
		Router::redirect("/users/login");
		
		# Return will force this method to exit here so the rest of 
		# the code won't be executed and the profile view won't be displayed.
		return false;
	}
        
        # Setup view
	$this->template->content = View::instance('v_users_profile');
	$this->template->title   = "Profile of ".$this->user->first_name;
  
        #var_dump($this->user);
        	
	# Render template
	echo $this->template;
    }
    
    public function editProfile() {
        # Setup view
	$this->template->content = View::instance('v_users_editprofile');
		
	# Render template
	echo $this->template;
    }
    
    public function p_editProfile() {
		
	# Unix timestamp of when this user was modified
	$_POST['modified'] = Time::now();
        
        $w = "WHERE user_id = ".$this->user->user_id;
		
	# Insert
	DB::instance(DB_NAME)->update("users", $_POST, $w);
        
        Router::redirect("/users/profile");

    }
    
    public function getProfile ($friend = NULL) {
        
        # Setup view
	$this->template->content = View::instance('v_users_profile');
        
       # Query to retrieve the  person's profile data elements
            $q = "SELECT first_name, last_name, lives_in, job, favorite_poet 
		FROM users
		WHERE user_id = ".$friend;
	
	# Execute our query, storing the results in a variable $person
	$person = DB::instance(DB_NAME)->select_row($q, 'object');
        
        #var_dump($person);
        
        # Pass data to the view
	$this->template->content->user = $person;
               
	$this->template->title   = "Profile of ".$person->first_name;
        	
	# Render template
	echo $this->template;
    }
}