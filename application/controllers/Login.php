<?php
class Login extends MY_Controller
{
	public function index()
    {
        $input = (object) $this->input->post(null, true);
        if (! $_POST) {
            $input = (object) $this->login->getDefaultValues();
        }

        if (! $this->login->validate()) {
            $this->load->view('login/form', compact('input'));
            return;
        }

        if ($this->login->login($input)) {
            redirect(base_url(), 'refresh');
        }

        flashMessage(
            'error',
            'Username atau password salah.
             Atau akun anda sedang diblokir.'
        );
        redirect('login', 'refresh');
	}

	public function logout()
	{
        $this->login->logout();
        redirect(base_url(), 'refresh');
	}
}
