<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Sensor_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function getSensors($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_sensor');
        $this->db->where('topic', $id);
        //$this->db->where('dateTime >= DATE_ADD(NOW(), INTERVAL -5 DAY) ');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function download($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_sensor');
        $this->db->where('topic', $id);
        //$this->db->where('dateTime >= DATE_ADD(NOW(), INTERVAL -5 DAY) ');
        $query = $this->db->get();
        return $query->row();
    }


}
