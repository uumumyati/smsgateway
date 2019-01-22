<?php
class Home extends MY_Controller
{
    public function index()
    {
        $mainView = 'home/index';
        $this->load->view('template', compact('mainView'));
    }
}
