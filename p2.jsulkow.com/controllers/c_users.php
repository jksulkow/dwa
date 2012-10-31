<?php

class users_controller extends base_controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        echo "Welcome to the Users department";
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
        
        # Create a view fragment with the posts index
        #$view_fragment = View::instance('v_posts_index');
	
        # Display the posts index
        #echo $view_fragment;
        
    	# Load CSS / JS
		$client_files = Array(
				"/views/applicationstyle.css",
				"/js/users.js",
	            );
	
        $this->template->client_files = Utils::load_client_files($client_files);   
        	
	# Render template
	echo $this->template;
    }
}