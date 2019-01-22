<?php
class Sms extends OperatorController
{
    public function create()
    {
        $input = (object) $this->input->post(null, true);
        if (!$_POST) {
            $input = $this->sms->getDefaultValues();
            $input = (object) $input;
        }

        $validate = $this->sms->validate();
        if (!$validate) {
            $mainView   = 'sms/form';
            $heading    = 'SMS';
            $formAction = 'sms/create';
            $buttonText = 'Send';
            $this->load->view('template', compact(
                'mainView',
                'heading',
                'formAction',
                'input',
                'buttonText'
            ));
            return;
        }

        $insert = $this->sms->insert($input);
        if (!$insert) {
            flashMessage('error', 'SMS gagal dikirim!');
        } else {
            flashMessage('success', 'SMS berhasil dikirim.');
        }

        redirect('sent', 'refresh');
    }
}
