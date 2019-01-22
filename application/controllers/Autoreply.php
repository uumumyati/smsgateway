<?php
class Autoreply extends OperatorController
{
    public function index($page = null)
    {
        $this->autoreply->runDaemon();

        $mainView = 'autoreply/index';
        $heading  = 'Autoreply';
        $this->load->view('template', compact('mainView', 'heading'));
    }
}