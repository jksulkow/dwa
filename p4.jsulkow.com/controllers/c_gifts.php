<?php

class gifts_controller extends base_controller {

	public function __construct() {
		parent::__construct();
		
		# Make sure user is logged in if they want to use anything in this controller
		if(!$this->user) {
			# Send user to the login page
			Router::redirect("/users/login");
		}
		
	}
	
	public function addrecipient() {
	
		# Setup view
		$this->template->content = View::instance('v_gifts_addrecipient');
		$this->template->title   = "Add A New Recipient";
			
		# Render template
		echo $this->template;
	
	}
	
	public function p_addrecipient() {
					
		# Unix timestamp of when the recipient was created / modified
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		
		# Insert and save returned ID in a variable
		$recipient =
		DB::instance(DB_NAME)->insert('recipients', $_POST);
		#var_dump($recipient);
		
		# Create an array containing the recipient ID and user ID.
		$user_recip = array("recipient_id" =>$recipient, "user_id"=>$this->user->user_id);
		#var_dump($user_recip);
		
		# Create a relationship between the user and the recipient
		# Also store the returned ID in a variable.
		$user_recipient =
		DB::instance(DB_NAME)->insert('users_recipients', $user_recip);
		
		# Create a relationship between the recipient and the occasion
		# Temporary: the db contains one occasion, Christmas.  Hard-coded for now.
		$recip_occasion = array("user_recipient_id" => $user_recipient, "occasion_id" => '2');
		DB::instance(DB_NAME)->insert('recipients_occasions', $recip_occasion);
		
		Router::redirect("/gifts/");
	
	}
	
	public function addgift() {
		
		# the recipient_occasion_id for the gift is passed in
	
		# Setup view
		$this->template->content = View::instance('v_gifts_addgift');
		$this->template->title   = "Add A Gift Idea";
			
		# Render template
		echo $this->template;
	
	}
	
	public function p_addgift() {
					
		# Unix timestamp of when the gift was created / modified
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		
		# insert the data into the database
		DB::instance(DB_NAME)->insert('gifts', $_POST);
		
		Router::redirect("/gifts/");
	}
	
	public function index() {

	# Set up view
	$this->template->content = View::instance('v_javascript_gifthelper');
	$this->template->title   = "My Gift Helper Shopping List";
	
	# Specify what JS/CSS files we need to load in the view
		$client_files = Array(
			"/js/gifthelper.js"
			);
	# Load the above specified files
		$this->template->client_files = Utils::load_client_files($client_files);		
	
	# Build a query of this user's recipients-occasions 
	$q1 = "SELECT ro.recipient_occasion_id, r.nickname, ro.is_done, o.occasion_name
		FROM recipients r
		JOIN users_recipients ur ON ur.recipient_id = r.recipient_id
		JOIN recipients_occasions ro ON ro.user_recipient_id = ur.user_recipient_id
		JOIN occasions o ON o.occasion_id = ro.occasion_id	
		WHERE ur.user_id = ".$this->user->user_id;
	
	# Execute our query, storing the results in a variable $listitems
	$listitems = DB::instance(DB_NAME)->select_rows($q1);
	
	# Add an element to each item in $listitems, where the new element is an array of gifts
	#
	for ($i = 0; $i < count($listitems); $i++) {
		
		# Build a query of each recipient-occasion's gifts
		$q2 = "SELECT g.recipient_occasion_id, g.gift_name, g.location, g.got_it
		FROM gifts g
		JOIN recipients_occasions ro ON ro.recipient_occasion_id = g.recipient_occasion_id
		JOIN users_recipients ur ON ur.user_recipient_id = ro.user_recipient_id
		WHERE ro.recipient_occasion_id = ".$listitems[$i]["recipient_occasion_id"]." AND
		ur.user_id = ".$this->user->user_id;
		
		#var_dump($q2);
		
		$listitems[$i]["gifts"]= DB::instance(DB_NAME)->select_rows($q2);
		#var_dump($listitems);
	}
	
	
	# Pass data to the view
	$this->template->content->listitems = $listitems;
	
	# Render view
	echo $this->template;
	
	}
	
}