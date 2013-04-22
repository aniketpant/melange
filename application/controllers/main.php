<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
   
        function __construct() {
            
                parent::__construct();
                $this->load->model('settings_model', 'settings');
                $this->session->set_userdata(array('admin_controls' => FALSE, 'site_name' => $this->settings->get_site_name()));
                
        }

	public function index() {
            
                $data['page_title'] = 'Home';
                $this->output->cache(3600);
		$this->load->view('standard/main', $data);       
	}
        
	public function login() {
            
                if ($this->session->userdata('logged_in')) {
                    redirect('user', 'location');
                }
                else {      
                    $data['page_title'] = 'Login';
                    $data['error'] = NULL;
                    
                    $this->form_validation->set_error_delimiters('<div class="alert alert-error"><p>', '</p></div>');
                    
                    if ($this->form_validation->run('standard/login') == FALSE) {
                        $this->load->view('standard/login', $data);
                    }
                    else {
                        $user_name = $this->input->post('user_name');
                        $password = $this->input->post('password');
                        
                        $check_val = $this->simpleloginsecure->login($user_name, $password);

                        $data['check_val'] = $check_val;
                        
                        if (!$check_val) {
                            $data['error'] = 'Incorrect username or password. Please try again.';
                            $this->session->set_userdata(array('logged_in' => FALSE));
                            $this->load->view('standard/login', $data);
                        }
                        else {
                            $this->load->model('user_model', 'user');
                            $id = $this->user->get_user_id($user_name);
                            if ($this->user->check_account_verified($id)) {
                                $this->session->set_userdata(array('logged_in' => TRUE));
                                redirect('user', 'location');
                            }
                            else {
                                $data['page_title'] = 'Account Not Verified';
                                $this->session->set_userdata(array('logged_in' => FALSE));
                                $this->load->view('messages/account_not_verified', $data);
                            }
                        }
                    }
                }
                
        }
        
	public function register() {
            
                $data['page_title'] = 'Register';
                $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
                $data['error'] = NULL;
                if ($this->form_validation->run('standard/signup') == FALSE) //validate registration data
                {
                    $this->load->view('standard/register', $data);
		}
                else 
                {
                    $user_name = $this->input->post('user_name');
                    $password = $this->input->post('password');
                    
                    $this->load->model('user_model', 'user');
                    
                    //check if user_name already registered.
                    $check_val = $this->user->check_user_name_exists($user_name);
                    
                    if($check_val)
                    {
                        $data['error'] = "This username is already registered with us.";
                        $this->output->cache(5);
                        $this->load->view('standard/register', $data);
                    }
                    
                    else // proceed with registration
                    {
                        $registration_val = $this->simpleloginsecure->create($user_name, $password, FALSE);
                        if ($registration_val) {
                            $this->user->generate_verification_key($user_name);
                            $this->user->send_verification_mail($user_name);
                            $this->user->generate_userdetails($user_name);
                            $this->load->view('messages/registration_success');
                        }
                        else {
                            $this->load->view('messages/registration_problem');
                        }
                    }
                }
                
	}
        
        public function forgot_password() {
            
                $data['page_title'] = 'Forgot Your Password';
                $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
                $data['error'] = NULL;
                if ($this->form_validation->run('standard/forgot_password') == FALSE) //validate registration data
                {
                    $this->load->view('standard/forgot_password', $data);
		}
                else 
                {
                    $user_name = $this->input->post('user_name');
                    $this->load->model('user_model', 'user');
                    $check_val = $this->user->check_user_name_exists($user_name);
                    if ($check_val) {
                        $new_password = $this->user->get_random_password();
                        $this->simpleloginsecure->new_password($user_name, $new_password);
                        $this->user->send_new_password($user_name, $new_password);
                        redirect('main/password_sent', 'location');
                    }
                    else {
                        $data['error'] = 'The username you gave is not registered with us.';
                        $this->load->view('standard/forgot_password', $data);
                    }
                }
                
        }
        
        public function password_sent() {
            
                $data['page_title'] = 'Password Sent';
                $this->load->view('messages/password_sent', $data);
                
        }
}