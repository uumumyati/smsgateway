<?php
class AdminController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Data yang berkaitan dengan login.
        $username = $this->session->userdata('username');
        $level    = $this->session->userdata('level');
        $isLogin  = $this->session->userdata('isLogin');

        if (!$isLogin) {
            redirect(base_url());
            return;
        }

        if ($level !== 'admin') {
            redirect(base_url());
            return;
        }
    }
}
