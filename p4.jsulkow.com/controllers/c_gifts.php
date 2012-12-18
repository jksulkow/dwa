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
		$this->template->title   = "Add A New Giftee";
			
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
	
	
	# p4 - modified to use Ajax and JSON
	public function p_addgift() {
					
		# Unix timestamp of when the gift was created / modified
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		
		# save the recipient_occasion_id into a variable
		#$r_o_id = $_POST['recipient_occasion_id'];
		
		# insert the data into the database
		# returns the id of the row
		$giftid = DB::instance(DB_NAME)->insert('gifts', $_POST);
		
		$q2 = "SELECT g.recipient_occasion_id, g.gift_name, g.location, g.got_it, g.gift_id
		FROM gifts g
		where g.gift_id =".$giftid;
		
		$newgift = DB::instance(DB_NAME)->select_row($q2);
		
		# Build a query of this recipient-occasion's gifts
		#$q = "SELECT g.recipient_occasion_id, g.gift_name, g.location, g.got_it, g.gift_id
		#FROM gifts g
		#WHERE g.recipient_occasion_id = ".$listitems[$i]["recipient_occasion_id"];
		
		#$gifts = DB::instance(DB_NAME)->select_rows($q);
		
		# format as JSON to use in javascript/ajax
		echo json_encode($newgift);
		
	}
	
	public function p_editgift() {
		
		$g_id = $_POST['gift_id'];
		
		# Unix timestamp of when the gift was modified
		$_POST['modified'] = Time::now();
		
		$got_it;
		if(!isset($_POST['got_it'])){
			$_POST['got_it'] = 0;
		}
		
		DB::instance(DB_NAME)->update('gifts', $_POST, "WHERE gift_id =".$g_id);
		
		$q2 = "SELECT g.recipient_occasion_id, g.gift_name, g.location, g.got_it, g.gift_id
		FROM gifts g
		where g.gift_id =".$g_id;
		
		$newgift = DB::instance(DB_NAME)->select_row($q2);
		
		echo json_encode($newgift);
		
		#Router::redirect("/gifts/");
	}
	
	public function p_editdone() {
		$giftee_id = $_POST['recipient_occasion_id'];
		
		
		DB::instance(DB_NAME)->update('recipients_occasions', $_POST, "WHERE recipient_occasion_id =".$giftee_id);
		Router::redirect("/gifts/");
	}
	
	#p4 -- added delete function
	public function p_deletegift() {
		$g_id = $_POST['gift_id'];
		#echo "gift id is $g_id";
		
		DB::instance(DB_NAME)->delete('gifts', "WHERE gift_id =".$g_id);
		Router::redirect("/gifts/");
	}
	
	public function index() {
		
		# If user is blank, they're not logged in, redirect to signup/login page
		if(!$this->user) {
			Router::redirect("/users/login");
			
			# Return will force this method to exit here so the rest of 
			# the code won't be executed and the profile view won't be displayed.
			return false;
		}
	
		# Set up view
		$this->template->content = View::instance('v_javascript_gifthelper');
		$this->template->title   = $this->user->first_name."'s GIFTR";
		 
		
		# Build a query of this user's recipients-occasions 
		$q1 = "SELECT ro.recipient_occasion_id, r.nickname, ro.is_done, o.occasion_name
			FROM recipients r
			JOIN users_recipients ur ON ur.recipient_id = r.recipient_id
			JOIN recipients_occasions ro ON ro.user_recipient_id = ur.user_recipient_id
			JOIN occasions o ON o.occasion_id = ro.occasion_id	
			WHERE ur.user_id = ".$this->user->user_id;
		
		# Execute query, storing the results in a variable $listitems
		$listitems = DB::instance(DB_NAME)->select_rows($q1);
		
		# Add an element to each item in $listitems, where the new element is an array of gifts
		
		for ($i = 0; $i < count($listitems); $i++) {
		
			# Build a query of each recipient-occasion's gifts
			$q2 = "SELECT g.recipient_occasion_id, g.gift_name, g.location, g.got_it, g.gift_id
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
		$this->template->content->listlength = count($listitems);
		
		# Render view
		echo $this->template;
	
	}
	
	# A recipient may be another user.  View users whom you may want to gift.
	public function find_friends() {
	
		# Set up the view
		$this->template->content = View::instance("v_gifts_friends");
		$this->template->title   = "Find Friends";
		
		# Build our query to get all the potential recipients who are users
		$q = "SELECT r.*, u.first_name, u.last_name
			FROM recipients r
			JOIN users u on u.user_id = r.user_id
			WHERE r.user_id <> ".$this->user->user_id;
			
		# Execute the query & store the result array in the variable $recipients
		$recipients = DB::instance(DB_NAME)->select_rows($q);
		
		# Who is the user already friends with
		$q = "SELECT * 
			FROM users_recipients
			WHERE user_id = ".$this->user->user_id;
			
		# Execute this query with the select_array method
		$friends = DB::instance(DB_NAME)->select_array($q, 'recipient_id');
		
		#var_dump($friends);
				
		# Pass recipients and friends to the view
		$this->template->content->recipients   = $recipients;
		$this->template->content->friends = $friends;
	
		# Render the view
		echo $this->template;
	}
	
	# Make another user your giftee
	public function friend($friend_user_id = NULL) {
	
		# Create an array of the user's and other user's IDs.
		$data['user_id'] = $this->user->user_id;
		$data['recipient_id'] = $friend_user_id;
	
		$user_recipient = DB::instance(DB_NAME)->insert("users_recipients", $data);
		
		# Create a relationship between the recipient and the occasion
		# Temporary: the db contains one occasion, Christmas.  Hard-coded for now.
		$recip_occasion = array("user_recipient_id" => $user_recipient, "occasion_id" => '2');
		DB::instance(DB_NAME)->insert('recipients_occasions', $recip_occasion);
	
		Router::redirect("/gifts/find_friends");
	}
	
	# Remove another user from being your giftee
	public function unfriend($recipient_id = NULL) {
		# Delete this relationship. This requires first deleting rows from other tables
		# where there is a foreign key constraint.
		
		$q = "SELECT user_recipient_id FROM users_recipients
		WHERE user_id = ".$this->user->user_id." AND
		recipient_id = ".$recipient_id;
		
		$user_recipient = DB::instance(DB_NAME)->select_field($q);
		
		$q2 = "SELECT recipient_occasion_id FROM recipients_occasions
		WHERE user_recipient_id = ".$user_recipient;
		
		$recipient_occasion = DB::instance(DB_NAME)->select_field($q);
		
		# Delete related rows from gifts table.
		$where_condition = 'WHERE recipient_occasion_id = '.$recipient_occasion;
		DB::instance(DB_NAME)->delete('gifts', $where_condition);
		
		# Delete related rows from recipients_occasions table
		$where_condition = 'WHERE user_recipient_id = '.$user_recipient;
		DB::instance(DB_NAME)->delete('recipients_occasions', $where_condition);
		
		# Delete user-giftee relationship
		DB::instance(DB_NAME)->delete('users_recipients', $where_condition);
	
		Router::redirect("/gifts/find_friends");
		
	}
	
}