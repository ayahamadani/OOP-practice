<?php

    class UserValidator {
        // setting up vars 
        private $data;
        private $errors = [];
        private static $fields = ['username', 'email'];

        public function __construct($post_data){
            // adding the data variable to $post_data
            $this->data = $post_data;
        }

        public function validateForm() {
            foreach(self::$fields as $field) {
                // using a built in function to handle errors
                // checking if data exists in the input
                if(!array_key_exists($field, $this->data)){
                    // trigger_error generates the error msg
                    trigger_error("'$field' is not present in the data");
                    return;
            }
        }

        $this->validateUsername();
        $this->validateEmail();
        return $this->errors;

    }

    private function validateUsername(){
        // using trim to get rid of possible whitespace
        // accessing the value of the username through the previously assigned data var
        // username is accessed through the name of the input
        $val = trim($this->data['username']);
        
        // adding an error in case the username input was empty
        if(empty($val)) {
            $this->addError('username', 'username must be included');
        } else {
            // adding RGX for the username to be between 6 and 12 chars long and alphanumeric
            // using preg_match() method to use RGX and making the if statement functional only if it returns a false bolean
            if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)){
                $this->addError('username', 'username must be between 6 and 12 chars & alphanumeric');
            }
        }
    }

    private function validateEmail(){
        // using trim to get rid of possible whitespace
        // accessing the value of the email through the previously assigned data var
        // email is accessed through the name of the input
        $val = trim($this->data['email']);
        
        // adding an error in case the email input was empty
        if(empty($val)) {
            $this->addError('email', 'email must be a valid email address');
        } else {
            // using the built in filter_var to validate the email
            if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
                $this->addError('email', 'email must be a valid email address');
            }
        }
    }

    // adding the errors to the errors variable if available
    private function addError($key, $val){
        $this->errors[$key] = $val;
      }

    }
?>