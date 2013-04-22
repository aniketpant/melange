<?php

class Admin_model extends CI_Model {
        
  function __construct()
  {
    parent::__construct();
  }

  function update_site_name($site_name)
  {
    $this->db->where('setting', 'site_name');
    $this->db->update('admin_settings', array('value' => $site_name));
  }

  function update_year($year)
  {
    $this->db->where('setting', 'year');
    $this->db->update('admin_settings', array('value' => $year));
  }

  function export_data($type)
  {
    $this->load->helper('csv');
    if ($type == 'userdata')
    {
      $this->db->select('user_name AS id, id_number, name, nick, dob, hostel, roomno, address, contact, email')->from('user_master')->join('user_details', 'iduser_master = user_master_iduser_details');
      $result = $this->db->get();
      echo query_to_csv($result, TRUE, 'melange_userdata_'.date('d_m_Y').'.csv');
    }
    else if ($type == 'testimonials')
    {
      $result = $this->db->query('SELECT content, um1.user_name AS testimonial_for, um2.user_name AS testimonial_by FROM user_master AS um1, user_master AS um2, testimonials, user_details AS ud1, user_details AS ud2 WHERE testimonial_for = ud1.iduser_details AND testimonial_by = ud2.iduser_details AND um1.iduser_master = ud1.user_master_iduser_details AND um2.iduser_master = ud2.user_master_iduser_details AND is_public = 1 AND is_approved = 1');
      echo query_to_csv($result, TRUE, 'melange_testimonials_'.date('d_m_Y').'.csv');
    }     
  }
        
  function make_admin($id)
  {
    $result = $this->db->get_where('user_roles', array('user_master_iduser_roles' => $id));
    if (!$result->first_row()->user_role)
    {
      $this->db->where('user_master_iduser_roles', $id);
      $this->db->update('user_roles', array('user_role' => 3));
    }
  }

  function check_guest_account_exist()
  {
    $result = $this->db->get_where('user_master', array('user_name' => 'guest'));
    return ($result->num_rows())?TRUE:FALSE;           
  }
        
}