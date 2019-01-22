<?php
class SmsBroadcast extends OperatorController
{
    public function create()
    {
        $input = (object) $this->input->post(null, true);
        if (!$_POST) {
            $input = $this->smsbroadcast->getDefaultValues();
            $input = (object) $input;
        }

        $validate = $this->smsbroadcast->validate();
        if (!$validate) {
            $mainView   = 'sms_broadcast/form';
            $heading    = 'Broadcast SMS';
            $formAction = 'sms-broadcast/create';
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

        $insert = $this->smsbroadcast->insert($input);
        if (!$insert) {
            flashMessage('error', 'SMS gagal dikirim!');
        } else {
            flashMessage('success', 'SMS berhasil dikirim.');
        }

        redirect('sent', 'refresh');
    }
}
