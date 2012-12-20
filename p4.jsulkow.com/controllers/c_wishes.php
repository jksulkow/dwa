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
		$this->template->content->wishlist = View::instance('v_wishes_list');
		
		# Query to retrieve the  person's profile data elements
		$q = "SELECT u.first_name, w.item_name, w.created
			FROM users u
			LEFT OUTER JOIN wishes w ON u.user_id = w.user_id
			WHERE u.user_id = ".$this->user->user_id;
			
		# Query to get count of wish list items.
		# To be used in a conditional statement for displaying the wish list
		$q2 = "SELECT COUNT(*)
			FROM wishes w 
			WHERE w.user_id = ".$this->user->user_id;
	
	# Execute our query, storing the results in a variable 
	$wishes = DB::instance(DB_NAME)->select_rows($q);
	
	$countw = DB::instance(DB_NAME)->select_field($q2);
        
        #var_dump($countw);
        
        # Pass data to the view
	$this->template->content->wishlist->wishes = $wishes;
	$this->template->content->wishlist->countw = $countw;
		
		# Render view
		echo $this->template;
	
	}
	
	public function getWishList ($giftee = NULL) {
        
        # Setup view
	$this->template->content = View::instance('v_wishes_list');
	
	if ($giftee == NULL) {
		$giftee = $this->user->user_id;
	}
	
	#var_dump($giftee);
        
       # Query to retrieve the  person's profile data elements
            $q = "SELECT u.first_name, w.item_name, w.created
			FROM users u
			LEFT OUTER JOIN wishes w ON u.user_id = w.user_id
			WHERE u.user_id = ".$giftee;
			
	# Query to get count of wish list items.
	# To be used in a conditional statement for displaying the wish list
		$q2 = "SELECT COUNT(*)
			FROM wishes w 
			WHERE w.user_id = ".$giftee;
	
	# Execute our query, storing the results in a variable 
	$wishes = DB::instance(DB_NAME)->select_rows($q);
	
	$countw = DB::instance(DB_NAME)->select_field($q2);
        
        #var_dump($countw);
        
        # Pass data to the view
	$this->template->content->wishes = $wishes;
	$this->template->content->countw = $countw;
	
	#$this->template->title   = "WishList of ".$giftee->first_name;
        	
	# Render template
	echo $this->template;
    }
}