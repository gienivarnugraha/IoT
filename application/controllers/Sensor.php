<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/controllers/Api.php';

use Restserver\Libraries\REST_Controller;

header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Headers: Authorization, Content-Type, Origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");

/**
 * Class : Project (Project)
 * Detail channel IoT System
 * @author : Dita
 * @version : 1.0
 * @since : 14 Juli 2019
 */
class Sensor extends Api
{
    function __construct()
    {
        parent::__construct();

        //$this->load->helper(['jwt', 'authorization']);
        $this->load->model('project_model');
        $this->setHeader();
        $this->isLoggedIn();
    }

    function index_get()
    {
        $id = $this->uri->segment(3, 0);
        
        $sensor = $this->project_model->sensorUpdate($id);
        // Check if the users data store contains users (in case the database result returns NULL)
        if (count($sensor) > 0) {
            // Set the response and exit
            return $this->response([
                'status' => 200,
                'items' => $sensor,
                'count' => count($sensor),
            ], 200); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            return $this->response([
                'status' => false,
                'items' => 0,
                'message' => 'No Sensors were found'
            ], 200); // NOT_FOUND (404) being the HTTP response code
        }
    }
}

?>