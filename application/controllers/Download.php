<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/controllers/Api.php';

use Restserver\Libraries\REST_Controller;

header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Headers: Authorization, Content-Type, Origin");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");

/**
 * Class : Project (Project)
 * Detail channel IoT System
 * @author : Dita
 * @version : 1.0
 * @since : 14 Juli 2019
 */
class Download extends Api
{
    function __construct()
    {
        parent::__construct();

        //$this->load->helper(['jwt', 'authorization']);
        $this->load->model('sensor_model');
        $this->setHeader();
        $this->isLoggedIn();
    }

    function index_get()
    {
        $id = $this->uri->segment(3, 0);
        

        $sensor = $this->sensor_model->download($id);
        // Check if the users data store contains users (in case the database result returns NULL)

        ini_set('memory_limit', '1024M');
        $filename=date('Y-m-d H:i:s');
        //header info for browser
        $columnHeader = '';  
        $columnHeader = "User Id" . "\t" . "First Name" . "\t" . "Last Name" . "\t";  
        $setData = '';  
          while ($rec = $sensor) {  
            $rowData = '';  
            foreach ($rec as $value) {  
                $value = '"' . $value . '"' . "\t";  
                $rowData .= $value;  
            }  
            $setData .= trim($rowData) . "\n";  
        }  
          
        header("Content-type: application/octet-stream");  
        header("Content-Disposition: attachment; filename=$filename.xls");  
        header("Pragma: no-cache");  
        header("Expires: 0");  

          echo ucwords($columnHeader) . "\n" . $setData . "\n";    
    }
}

?>