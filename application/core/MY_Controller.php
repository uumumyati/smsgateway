<?php
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load model, jika ada.
        $model = strtolower(get_class($this));
        if (file_exists(APPPATH . 'models/' . $model . 'Model.php')) {
            $this->load->model($model . 'Model', $model, true);
        }

        // Data yang berkaitan dengan login.
        $username = $this->session->userdata('username');
        $level    = $this->session->userdata('level');
        $isLogin  = $this->session->userdata('isLogin');

        // Load global data untuk view. Untuk mempersingkat
        // pemanggilan variabel-variabel login.
        $this->load->vars([
            'username' => $username,
            'level'    => $level,
            'isLogin'  => $isLogin
        ]);
    }
}
