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
				// echo $this->input->post('identity');
				// echo $this->input->post('user_password');
				$identity_mode = ( is_numeric( $this->input->post('identity') ) ) ? "phone" : NULL;
				// return;
				if ( $this->ion_auth->login( $this->input->post('identity'), $this->input->post('user_password') , FALSE, $identity_mode  ))
				{
						//if the login is successful
						//redirect them back to the home page
						$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->ion_auth->messages() ) );

						// echo $this->ion_auth->messages();return;

						if( $this->ion_auth->is_admin()) redirect(site_url('/admin'));

						if( $this->ion_auth->in_group( 'uadmin' ) ) redirect(site_url('/uadmin'));
						if( $this->ion_auth->in_group( 'school_admin' ) ) redirect(site_url('/school_admin'));
						if( $this->ion_auth->in_group( 'teacher' ) ) redirect(site_url('/teacher'));
						if( $this->ion_auth->in_group( 'student' ) ) redirect(site_url('/student/test'));

						redirect( site_url('/user') , 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
				}
				else
				{
						// if the login was un-successful
						// redirect them back to the login page
						$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->ion_auth->errors() ) );

						// echo $this->ion_auth->errors();return;

						redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
				}
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
