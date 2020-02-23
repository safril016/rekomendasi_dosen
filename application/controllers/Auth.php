<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		$origin['menu_list_id'] = 'auth_login';
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password','password','trim|required');
		if ($this->form_validation->run() == true)
		{
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				
				$data_param['username'] = $username;

				$user = $this->m_user->ambil_data( $data_param )->row();
				// password_verify( $password, $user->password );
				// var_dump( password_verify( $password, $user->password ) ); die;
				
				// return;
				if ( $user && password_verify( $password, $user->password ) )
				{
						$this->session->set_flashdata('alert', 'Login Berhasil' );
						$session = array(
							'id' => $user->id,
							'username' => $user->username,
						);
						$this->session->set_userdata( $session );
						redirect('dashboard');
				}
				else
				{
						// if the login was un-successful
						// redirect them back to the login page
						$this->session->set_flashdata('alert', 'Login Gagal, Silahkan cek Username dan Password' );

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
		$session = array();
		$this->session->unset_userdata( $session );
		$this->session->sess_destroy();
		redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
	}
}
