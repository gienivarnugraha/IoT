<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    //function projectList($searchText = '', $page, $segment)
    function projectList($userId, $projectId=null )
    {
        if($projectId!=null){
            $this->db->select('*');
            $this->db->where('projectId', $projectId);
        } else {
            $this->db->select('
                                apiKey,
                                projectId, 
                                projectName, 
                                projectDesc,
                                topic, 
                                sensor1Name, 
                                sensor2Name, 
                                sensor3Name,
                                sensor4Name
                                ');
        }
        $this->db->from('tbl_project');
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewProject($project)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_project', $project);
        $this->db->trans_complete();

        return $this->db->trans_status();
    }
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editProject($project, $projectId)
    {
        $update = $this->db->where('projectId', $projectId);
        $update = $this->db->update('tbl_project', $project);
    }
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteProject($projectId)
    {
        $this->db->where('projectId', $projectId);
        $this->db->delete('tbl_project');
        
        return $this->db->affected_rows();
    }

    function sensorUpdate($id)
    {
        $this->db->select('sensor1Value,sensor2Value,sensor3Value,sensor4Value,dateTime');
        $this->db->from('tbl_sensor');
        $this->db->where('topic', $id);
        $query = $this->db->get();
        $count = $query->num_rows();
        if ($count > 0){
            return $query->result_array()[$count-1];
        } else {
            return $query->result_array();
        }
    }

}

