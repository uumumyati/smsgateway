<?php
class Polling extends OperatorController
{
    public function index($page = null)
    {
        // Proses data polling dari sms secara otomatis.
        $this->polling->runDaemon();

        // Tampilkan hasil polling.
        $polling      = $this->polling->getAll();
        $polling      = $this->polling->prepData($polling);
        $jumlahVoting = $this->polling->getJumlahVoting()
                                      ->jumlah_voting;
        $mainView     = 'polling/index';
        $heading      = 'Polling';
        $this->load->view('template', compact(
            'mainView',
            'heading',
            'polling',
            'jumlahVoting'
        ));
    }

}
