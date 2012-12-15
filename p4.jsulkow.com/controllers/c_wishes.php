<?php

class wishes_controller extends base_controller {

	public function __construct() {
		parent::__construct();
		
		# Make sure user is logged in if they want to use anything in this controller
		if(!$this->user) {
			# Send user to the login page
			Router::redirect("/users/login");
		}
		
	}
        
        public function add() {

		# Setup view
		$this->template->content = View::instance('v_wishes_add');
		$this->template->title   = "Add To Your WishList";
			
		# Render template
		echo $this->template;
	
	}
	
	public function p_add() {
		
		# Associate this item with this user
		$_POST['user_id']  = $this->user->user_id;
		
		# Unix timestamp of when this item was created / modified
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		
		DB::instance(DB_NAME)->insert('wishes', $_POST);
		
		# Don't really need to use Ajax for this, just reload the page
		Router::redirect("/wishes/index");
	}
	
	public function index() {
		
		# Set up view
		$this->template->content = View::instance('v_wishes_index');
		$this->template->title   = $this->user->first_name."'s Wish List";
		
		$q = "SELECT item_name, created 
			FROM wishes
			WHERE user_id = ".$this->user->user_id."
			ORDER BY created desc";
		
		$wishes = DB::instance(DB_NAME)->select_rows($q);
		#var_dump($wishes);

		
		# Pass data to the view
		$this->template->content->wishes = $wishes;
		
		# Render view
		echo $this->template;
	
	}
}