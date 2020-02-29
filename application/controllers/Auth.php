<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		$origin['menu_list_id'] = 'auth_login';
		$this->form_validation->set_rules('identity', 'identity', 'required');
		$this->form_validation->set_rules('user_password','user_password','trim|required');
		if ($this->form_validation->run() == true)
		{	
			
		}else{
				// $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				// if(  validation_errors() || $this->ion_auth->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
				$this->load->view('template/public/header', $origin);
				$this->load->view('template/public/login');
				$this->load->view('template/public/footer');
		}
	}

	public function logout()
	{
		
	}
}
