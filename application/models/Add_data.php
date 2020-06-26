<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Add_data extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function add_employee($data){
        return $this->db->insert('users',$data);
    }

    function edit_employee($data)
    {
        return $this->db->update('users', $data, array('users_id' => $data['users_id']));
    }
    
    function delete_employee($data)
    {
        return $this->db->delete('users', $data);
    }

    public function add_leaves($data){
        return $this->db->insert('leaves',$data);
    }
    function delete_leaves($data)
    {
        return $this->db->delete('leaves', $data);
    }

    public function add_student($data){
        return $this->db->insert('student',$data);
    }

    function edit_student($data,$bdate)
    {
      
        return $this->db->update('student', $data, array('student_id' => $data['student_id'],'student_Start' => $bdate));
    }
    
    function delete_student($data)
    {
        return $this->db->delete('student', $data);
    }

    /*
    function add_detail_project($data)
    {
        return $this->db->insert('project', $data);
    }
    function edit_detail_project($data)
    {
        return $this->db->update('project', $data, array('pro_id' => $data['pro_id']));
    }
    function delete_detail_project($data)
    {
        return $this->db->delete('project', $data);
    }

    */
}

/* End of file Add_data.php */
