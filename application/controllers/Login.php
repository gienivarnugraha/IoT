<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

header("Access-Control-Allow-Origin: http://localhost:8081");
header("Access-Control-Allow-Headers: Authorization, Content-Type, Origin");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/x-www-form-urlencoded");

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Login extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        //$this->load->helper(['jwt', 'authorization']);
        $this->load->model('login_model');
    }

    /**
     * This function used to logged in user
     */
    public function login()
    {   
/*         $input = $this->input->post();
        if(count($input) < 2 ) {
            $this->response([
                'hehe'=>$this->input->post(),
                'status' => FALSE,
                'message' => 'Invalid Route'
            ], 200); // BAD_REQUEST (400) being the HTTP response code
        } else { */
              // Extract user data from POST request
            /* var_dump( json_decode( file_get_contents('php://input') ) ) ;
            $input = $this->input->post();
            var_dump($input); */

            $email      = $this->input->post("email",false);
            $password   = $this->input->post("password",false);

            $result = $this->login_model->loginMe($email, $password);

            // Check if valid user
            if ($result==null) {
                $this->response([
                    'msg' => 'Invalid username or password!',
                    'status'=>400
                ], 400); //parent::HTTP_NOT_FOUND
            }
            else {
                $id = $result[0]->userId;
                $key    = $this->_generate_key();
                if($this->login_model->_key_exist($key)){
                    $this->login_model->_update_key($key);
                } 
                else {
                    $this->login_model->_insert_key($id, $key);
                }
                $status = 200;
                $response = [
                    'status' => $status,
                    'key' => $key,
                    'name' => $result[0]->name,
                    'userId' => $result[0]->userId,
                    'email' => $result[0]->email,
                ];
                $this->response($response, $status); 
            }
        /* } */
    }


    /**
     * Remove a key from the database to stop it working
     *
     * @access public
     * @return void
     */
    public function logout()
    {
        $key =$this->input->request_headers()['Authorization'];

        // Does this key exist?
        if (!$this->login_model->_key_exist($key))
        {
            // It doesn't appear the key exists
            $this->response([
                'status' => FALSE,
                'message' => 'Invalid API key'
            ], 400); // BAD_REQUEST (400) being the HTTP response code
        }

        // Destroy it
        $this->login_model->_delete_key($key);

        // Respond that the key was destroyed
        $this->response([
            'status' => TRUE,
            'message' => 'Logout Success'
            ], 200); // NO_CONTENT (204) being the HTTP response code
    }



    
    /* Helper Methods */

    private function _generate_key()
    {
        // Generate a random salt
        $salt = base_convert(bin2hex($this->security->get_random_bytes(64)), 16, 36);

        $new_key = substr($salt, 0, 40);
        
        return $new_key;
    }

}

?>