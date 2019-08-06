<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/controllers/Api.php';

require APPPATH . '/libraries/BaseController.php';

header("Access-Control-Allow-Origin: http://localhost:8081");
header("Access-Control-Allow-Headers: Authorization, Content-Type, Origin");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/x-www-form-urlencoded");

/**
 * Class : Project (Project)
 * Detail channel IoT System
 * @author : Dita
 * @version : 1.0
 * @since : 14 Juli 2019
 */
class User extends BaseController
{
    function __construct()
    {
        parent::__construct();

        //$this->load->helper(['jwt', 'authorization']);
        $this->load->model('user_model');
    }
/* 
    function index_get()
    {
        $projectId = $this->uri->segment(3, 0);
        $userId = $this->global['userId'] ;
        // If the id parameter doesn't exist return all the users

        if ($projectId!=0) {
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
                'items' => 0,
                'message' => 'No project were found, please add one.'
            ], 200); // NOT_FOUND (404) being the HTTP response code
        }
    }
 */
    function addNewUser()
    {

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = array(
            'userId' => uniqid('id_'),
            'api_key' => $this->_generate_key(),
            'name' => ucwords(strtolower($name)),
            'email' => $email,
            'password' => getHashedPassword($password),
        );


        $result = $this->user_model->addNewUser($user);
        if ($result == true) {
            $message = [
                'message' => 'Added new User!'
            ];

            $this->response($message, 200); // NO_CONTENT (204) being the HTTP response code

        } else {
            $message = [
                'message' => 'cannot add user!'
            ];

            $this->response($message, 200); // NO_CONTENT (204) being the HTTP response code

        }
    }
/* 
    function index_put()
    {
        $id = $this->put('projectId');
        $project = $this->put();
        $userId = $this->global['userId'] ;

        var_dump($project);

        if ($id == null) {
            $message = [
                'message' => 'Project ID not Found!'
            ];
            $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // NO_CONTENT (204) being the HTTP response code
        } else {
            $find = $this->project_model->projectList($userId, $id);
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

    } */

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

}
?>