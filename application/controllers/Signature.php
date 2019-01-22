<?php
class Signature extends OperatorController
{
    public function index()
    {
        // Cek apakah signature sudah ada di table "signature"?
        $signature = '';
        $query     = $this->signature->get();
        if ($query) {
            $signature = $query->message;
        }

        // Create atau edit berdasarkan ada ata tidaknya signature.
        if ($signature) {
            $this->edit();
            return;
        } else {
            $this->create();
            return;
        }
    }

    // Hanya akan dilakukan sekali, ketika aplikasi pertama kali
    // dipakai. Selanjutnya adalah edit.
    private function create()
    {
        $input = (object) $this->input->post(null, true);
        if (!$_POST) {
            $input = (object) $this->signature->getDefaultValues();
        }

        $validate = $this->signature->validate();
        if (!$validate) {
            $mainView   = 'signature/form';
            $heading    = 'Signature > Create';
            $formAction = "signature";
            $buttonText = 'Create';
            $this->load->view('template', compact(
                'mainView',
                'heading',
                'formAction',
                'input',
                'buttonText'
            ));
            return;
        }

        $insert = $this->signature->insert($input);
        if (!$insert) {
            flashMessage('error', 'Data gagal disimpan!');
        } else {
            flashMessage('success', 'Data berhasil disimpan.');
        }

        redirect('signature', 'refresh');
    }

    private function edit()
    {
        $input = (object) $this->input->post(null, true);
        if (!$_POST) {
            $input = (object) $this->signature->get();
        }

        $validate = $this->signature->validate();
        if (!$validate) {
            $mainView   = 'signature/form';
            $heading    = 'Signature > Edit';
            $formAction = "signature";
            $buttonText = 'Update';
            $this->load->view('template', compact(
                'mainView',
                'heading',
                'formAction',
                'input',
                'buttonText'
            ));
            return;
        }

        $insert = $this->signature->update($input);
        if (!$insert) {
            flashMessage('error', 'Data gagal diupdate!');
        } else {
            flashMessage('success', 'Data berhasil diupdate.');
        }

        redirect('signature', 'refresh');
    }
}
