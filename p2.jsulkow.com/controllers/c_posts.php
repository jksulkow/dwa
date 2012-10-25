<?php

class posts_controller extends base_controller {

	public function __construct() {
		parent::__construct();
		
		# Make sure user is logged in if they want to use anything in this controller
		if(!$this->user) {
			die("Members only. <a href='/users/login'>Please log in to use the site.</a>");
		}
		
	}
	
	public function add() {
	
		# Setup view
		$this->template->content = View::instance('v_posts_add');
		$this->template->title   = "Add a new post";
			
		# Render template
		echo $this->template;
	
	}
	
	public function p_add() {
			
		# Associate this post with this user
		$_POST['user_id']  = $this->user->user_id;
		
		# Unix timestamp of when this post was created / modified
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		
		# Insert
		DB::instance(DB_NAME)->insert('posts', $_POST);
		
		# Quick and dirty feedback
		echo "Your post has been added. <a href='/posts/add'>Add another?</a>";
	
	}
	
	public function index() {

	# Set up view
	$this->template->content = View::instance('v_posts_index');
	$this->template->title   = "Posts";
	
	# Build our query
	$q = "SELECT * 
		FROM posts
		JOIN users USING (user_id)";
	
	# Run our query, grabbing all the posts and joining in the users	
	$posts = DB::instance(DB_NAME)->select_rows($q);
	
	# Pass data to the view
	# You can create a variable on the fly and pass it in.
	# posts is the new one; we loaded it with $posts and
	# are passing it to the view.
	$this->template->content->posts = $posts;
	
	# Render view
	echo $this->template;
	}
	
	public function users() {
	#Defines the relationships between users

	# Set up the view
	$this->template->content = View::instance("v_posts_users");
	$this->template->title   = "Users";
	
	# Build our query to get all the users
	$q = "SELECT *
		FROM users";
		
	# Execute the query to get all the users. Store the result array in the variable $users
	$users = DB::instance(DB_NAME)->select_rows($q);
	
	# Build our query to figure out what connections does this user already have? I.e. who are they following
	$q = "SELECT * 
		FROM users_users
		WHERE user_id = ".$this->user->user_id;
		
	# Execute this query with the select_array method
	# select_array will return our results in an array and use the "users_id_followed" field as the index.
	# This will come in handy when we get to the view
	# Store our results (an array) in the variable $connections
	$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
			
	# Pass data (users and connections) to the view
	$this->template->content->users       = $users;
	$this->template->content->connections = $connections;

	# Render the view
	echo $this->template;
	}
	
	public function follow($user_id_followed = NULL) {
	
	$data['created'] = Time::now();
	$data['user_id'] = $this->user->user_id;
	$data['user_id_followed'] = $user_id_followed;
	
	DB::instance(DB_NAME)->insert("users_users", $data);
	
	Router::redirect("/posts/users");
	}
	
	public function unfollow($user_id_followed = NULL) {
		
	}

}