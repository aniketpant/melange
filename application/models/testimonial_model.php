<?php

class Testimonial_model extends CI_Model {
        
        function __construct() {
                parent::__construct();
        }
        
        function add_testimonial($data) {
                $this->db->insert('testimonials', $data);
        }
        
        function show_all_testimonials($id, $is_approved = 1) {
                $this->db->select('idtestimonials, content, name, testimonial_by')->from('testimonials')->join('user_details', 'testimonials.testimonial_by = user_details.iduser_details')->where(array('testimonial_for' => $id, 'is_approved' => $is_approved));
                $result = $this->db->get();
                return $result->result();    
        }
        
        function show_testimonials($id, $visibility = 'public', $is_approved = 1) {
                if ($visibility == 'public') {
                    $value = 1;
                }
                else if ($visibility == 'private') {
                    $value = 0;
                }
                $this->db->select('idtestimonials, content, name, testimonial_by')->from('testimonials')->join('user_details', 'testimonials.testimonial_by = user_details.iduser_details')->where(array('testimonial_for' => $id, 'is_approved' => $is_approved, 'is_public' => $value));
                $result = $this->db->get();
                return $result->result();            
        }
        
        function change_visibility($id, $user_id, $value) {
                $this->db->where(array('idtestimonials' => $id, 'testimonial_for' => $user_id));
                $this->db->update('testimonials', array('is_approved' => 1, 'is_public' => $value));
        }
        
        function delete_testimonial($id, $user_id) {
                $this->db->delete('testimonials', array('idtestimonials' => $id));                
        }
    
}

?>