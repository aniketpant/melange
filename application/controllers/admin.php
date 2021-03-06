<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
 
  function __construct()
  { 
    parent::__construct();
    if ($this->session->userdata('is_admin') == TRUE && $this->session->userdata('logged_in') == TRUE) {
      $this->session->set_userdata(array('login_flag' => 1));
    }
    else
    {
      $this->session->set_userdata(array('login_flag' => 0));
    }
    $this->load->model('settings_model', 'settings');
    $this->session->set_userdata(array('admin_controls' => TRUE, 'site_name' => $this->settings->get_site_name()));      
  }

  public function index()
  {
    $this->output->cache(3600);
    $data['page_title'] = 'Admin Controls';
    $this->load->view('admin/main', $data);           
  }
  
  public function login()
  {         
    if ($this->session->userdata('login_flag')) {
      redirect('admin/dashboard', 'location');
    }
    else {      
      $data['page_title'] = 'Admin Login';
      $data['error'] = NULL;
      
      $this->form_validation->set_error_delimiters('<div class="alert alert-error"><p>', '</p></div>');
      
      if ($this->form_validation->run('standard/login') == FALSE) //present and validate login form
      {
        $this->load->view('admin/login', $data);
      }
      else
      {
        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');
        
        $check_val = $this->simpleloginsecure->login($user_name, $password);

        $data['check_val'] = $check_val;
        
        if (!$check_val)
        {
          $data['error'] = 'Incorrect username or password. Please try again.';
          $this->load->view('admin/login', $data);
        }                        
        else
        {
          $this->load->model('user_model', 'user');
          $user_role = $this->user->get_user_role($user_name);
          if ($user_role == 2 || $user_role == 3)
          {
            $this->session->set_userdata(array('logged_in' => TRUE, 'is_admin' => TRUE));
            redirect('admin/dashboard', 'location');
          }
          else
          {
            $this->session->set_userdata(array('logged_in' => FALSE, 'is_admin' => FALSE));
            $this->load->view('admin/login', $data);
          }
        }
      }
    }              
  }
  
  public function dashboard()
  {  
    if ($this->session->userdata('login_flag')) {
      $data['page_title'] = 'Dashboard';
      $this->load->model('admin_model', 'admin');
      $data['site_name'] = $this->settings->get_site_name();
      $data['year'] = $this->settings->get_year();
      $this->load->view('admin/dashboard', $data);
    }
    else {
      redirect('404', 'location');
    }                
  }
  
  public function settings()
  { 
    if ($this->session->userdata('login_flag'))
    {
      $data['page_title'] = 'Settings';
      $this->load->model('admin_model', 'admin');
      $this->load->model('settings_model', 'settings');
      $data['site_name'] = $this->settings->get_site_name();
      $data['year'] = $this->settings->get_year();
      $data['guest_account_flag'] = $this->admin->check_guest_account_exist();
      $data['error'] = null;
      
      $this->form_validation->set_error_delimiters('<div class="alert alert-error"><p>', '</p></div>');
      
      if ($this->form_validation->run('admin/settings') == FALSE) {
        $this->load->view('admin/settings', $data);
      }
      else {
        $site_name = $this->input->post('site_name');
        $year = $this->input->post('year');
        $this->admin->update_site_name($site_name);
        $this->admin->update_year($year);
        $this->load->view('admin/settings', $data);                    
      }
    }
    else
    {
      redirect('404', 'location');
    }
  }
  
  public function export($type) {
    if ($this->session->userdata('login_flag'))
    {
      $this->load->model('admin_model', 'admin');
      $this->admin->export_data($type);
    }
    else
    {
      redirect('404', 'location');
    }     
  }
  
  public function make_admin($user_name)
  {          
    if ($this->session->userdata('login_flag')) {
      $data['page_title'] = 'Make Admin';
      $this->load->model('admin_model', 'admin');
      $this->load->model('user_model', 'user');
      $id = $this->user->get_user_id($user_name);
      $this->admin->make_admin($id);
      $data['user_name'] = $user_name;
      $this->load->view('admin/make_admin', $data);
    }
    else
    {
      redirect('404', 'location');
    }          
  }
  
  public function reset_password($user_name)
  {          
    if ($this->session->userdata('login_flag')) {
      $data['page_title'] = 'Password Reset';
      $this->load->model('user_model', 'user');
      if (isset($user_name))
      {
        $this->load->model('user_model', 'user');
        $user_pass = $this->user->get_random_password();
        $this->simpleloginsecure->new_password($user_name, $user_pass);
        $data['user_name'] = $user_name;
        $data['user_pass'] = $user_pass;
        $this->load->view('admin/password_reset', $data);
      }
      else
      {
        redirect('admin/dashboard', 'location');
      }
    }
    else {
      redirect('404', 'location');
    }          
  }
  
  public function create_guest_account()
  {
    if ($this->session->userdata('login_flag'))
    {
      $this->load->model('user_model', 'user');
      $user_name = 'guest';
      $password = 'password';
      $this->simpleloginsecure->create($user_name, $password, FALSE);
      $arr_userdetails = array(
        'id_number' => 'Guest',
        'name' => 'Guest',
        'nick' => 'guest',
        'dob' => '29 February 1991',
        'hostel' => 'AH9',
        'roomno' => '000',
        'address' => 'Your mom\'s house',
        'contact' => '9876543210',
        'email' => 'guest@guest.com'
        );
      $this->user->generate_userdetails($user_name, $arr_userdetails);
      
      redirect('admin/dashboard', 'location');
    }
    else
    {
      redirect('404', 'location');
    }
  }
  
  public function logout()
  {
    if ($this->session->userdata('login_flag'))
    {
      $this->simpleloginsecure->logout();
      $data['page_title'] = 'Logged Out';
      $data['type'] = 'admin';
      $this->load->view('messages/logged-out', $data);
    }
    else
    {
      redirect('404', 'location');
    }  
  }
  
}