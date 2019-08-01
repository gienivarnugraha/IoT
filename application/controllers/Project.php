<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/controllers/Api.php';

use Restserver\Libraries\REST_Controller;

header("Access-Control-Allow-Origin: http://localhost:8081");
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
class Project extends Api
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
        $projectId = $this->uri->segment(3, 0);
        $userId = $this->global['userId'] ;
        // If the id parameter doesn't exist return all the users

        if (isset($id)) {
            $project = $this->project_model->projectList($userId,$projectId);
        } else {
            //$project = $this->project_model->projectList($id);
            $project = $this->project_model->projectList($userId);
        }
        // Check if the users data store contains users (in case the database result returns NULL)
        if (count($project) > 0) {
            // Set the response and exit
            return $this->response([
                'status' => 200,
                'columns' => array_keys($project[0]),
                'items' => $project,
                'count' => count($project),
            ], 200); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            return $this->response([
                'status' => false,
                'message' => 'No project were found'
            ], 200); // NOT_FOUND (404) being the HTTP response code
        }
    }

    function index_post()
    {
        if ($this->post() == null) {
            $this->response([
                'status' => false,
                'message' => 'Form cannot be empty'
            ], 200); // BAD_REQUEST (400) being the HTTP response code
            return false;
        }
        $projectName = $this->post('projectName');
        $projectDesc = $this->post('projectDesc');
        $sensor1Name = $this->post('sensor1Name');
        $sensor2Name = $this->post('sensor2Name');
        $sensor3Name = $this->post('sensor3Name');
        $sensor4Name = $this->post('sensor4Name');

        $project = array(
            'projectId' => uniqid('id_'),
            'apiKey' => $this->_generate_key(),
            'projectName' => $projectName,
            'projectDesc' => $projectDesc,
            'sensorId' => uniqid('id_'),
            'userId' => $this->userId,
            'sensor1Name' => $sensor1Name,
            'sensor2Name' => $sensor2Name,
            'sensor3Name' => $sensor3Name,
            'sensor4Name' => $sensor4Name
        );

        $result = $this->project_model->addNewProject($project);
        if ($result == true) {
            $message = [
                'message' => 'Added new project!'
            ];

            $this->response($message, REST_Controller::HTTP_OK); // NO_CONTENT (204) being the HTTP response code

        } else {
            $message = [
                'message' => $this->post()
            ];

            $this->response($message, REST_Controller::HTTP_OK); // NO_CONTENT (204) being the HTTP response code

        }
    }

    function index_put()
    {
        $id = $this->uri->segment(3, 0);
        $project = $this->put();
        if ($id == null) {
            $message = [
                'message' => 'Project ID not Found!'
            ];
            $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // NO_CONTENT (204) being the HTTP response code
        } else {
            $find = $this->project_model->projectList($id);
            if ($find[0]['projectId'] == $id) {
                $this->project_model->editProject($project, $id);
                $message = [
                    'message' => 'Edit project ' . $id . ' successful!'
                ];

                $this->response($message, REST_Controller::HTTP_OK); // NO_CONTENT (204) being the HTTP response code
            } else {
                $message = [
                    'message' => 'Edit project ' . $id . ' Failed!'
                ];

                $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // NO_CONTENT (204) being the HTTP response code

            }
        }

    }

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function index_delete()
    {
        $id = $this->uri->segment(3, 0);
        $userId = $this->global['userId'] ;
        if ($id == null) {
            $message = [
                'message' => 'Project ID not Found!'
            ];
            $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // NO_CONTENT (204) being the HTTP response code
        } 
        // Validate the id.
        if (count($this->project_model->projectList($userId,$id)) <= 0) {
            // Set the response and exit
            $message = [
                'message' => 'ID not found!'
            ];
            $this->response($message, REST_Controller::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $this->project_model->deleteProject($id);

            $message = [
                'id' => $id,
                'message' => 'Deleted the resource on ' . $id
            ];

            $this->response($message, REST_Controller::HTTP_OK); // NO_CONTENT (204) being the HTTP response code

        }

    }
    function sensor_get($id)
    {
        if (isset($id)) {
            $sensor = $this->project_model->sensorUpdate($id);
            if (count($sensor) > 0) {
                return $sensor;
            } else {
                // Set the response and exit
                return $this->response([
                    'status' => false,
                    'message' => 'No sensor were found'
                ], 200); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            die();
        }
        // Check if the users data store contains users (in case the database result returns NULL)

    }
}
/*      
        fetchProject(){
            axios
                .get('/project')
                .then(response=>{
                    this.columns = response.data.columns
                    this.items = response.data.items
                })
                .catch(err=>{
                    console.log(err)
                })
        }, 
        */ 

?>