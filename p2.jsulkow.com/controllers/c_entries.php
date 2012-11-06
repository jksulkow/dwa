<?php
class entries_controller extends base_controller {

        public function __construct() {
                parent::__construct();
        } 
        
        public function create_new_entry() {
        
	        # Set up the view
	        $this->template->content = View::instance("v_users_createentry");
	        
	        # Render the view
	        echo $this->template;
    	}
        
        public function p_create_new_entry() {
	                
	        # A form for creating new blog entries should submit to this method
	        # This method should take the $_POST data submitted and add it to the database
	        print_r($_POST);
	        $POST['created'] = Time::now();
	        
	        # Load user from DB
			$q = "SELECT user_id
	                        FROM users
				WHERE token = '".$this->token."'
				LIMIT 1";	
	        $POST['user_id'] = $q;
	                 
	        echo 'Your quote is posted.';       
        }
                        
}