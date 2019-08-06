<?php

defined('BASEPATH') or exit('No direct script access allowed');

//  This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;
/**
 * Keys Controller
 * This is a basic Key Management REST controller to make and delete keys
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Api extends REST_Controller
{

    protected $name = '';
    protected $userId = '';
    protected $key = '';
    protected $global = array();

    
    /* CORS !!IMPORTANT
    1. set on rest.php 
        check_cors to true
        allow_any_cors_domain to false
        allowed_cors_origins to host
    2. set these header
    */
    function setHeader()
    {
        header("Access-Control-Allow-Origin: http://localhost:8081");
        header("Access-Control-Allow-Headers: Authorization, Content-Type, Origin");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Credentials: true");
    }

    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $header = $this->input->request_headers();
        if (isset($header['Authorization'])) {
            $key = $header['Authorization'];
            $this->load->model('login_model');
            $user = $this->login_model->_get_key($key);
            if (count($user) <= 0) {
                $this->response([
                    'status' => false,
                    'message' => 'Invalid User API key'
                ], 400); // BAD_REQUEST (400) being the HTTP response code
                return false;
            } else {
                $this->name = $user['name'];
                $this->key = $user['api_key'];
                $this->userId = $user['userId'];
                $this->global['name'] = $user['name'];
                $this->global['key'] = $user['api_key'];
                $this->global['userId'] = $user['userId'];
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Unauthorized! Please Login'
            ], 400); // BAD_REQUEST (400) being the HTTP response code
            return false;
        }

    }


    protected function _generate_key()
    {
            // Generate a random salt
        $salt = base_convert(bin2hex($this->security->get_random_bytes(64)), 16, 36);

            // If an error occurred, then fall back to the previous method
        if ($salt === false) {
            $salt = hash('sha256', time() . mt_rand());
        }

        $new_key = substr($salt, 0, config_item('rest_key_length'));

        return $new_key;
    }


}
