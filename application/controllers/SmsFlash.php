<?php
class SmsFlash extends OperatorController
{
    public function create()
    {
        $input = (object) $this->input->post(null, true);
        if (!$_POST) {
            $input = $this->smsflash->getDefaultValues();
            $input = (object) $input;
        }

        $validate = $this->smsflash->validate();
        if (!$validate) {
            $mainView   = 'sms_flash/form';
            $heading    = 'Flash SMS';
            $formAction = 'sms-flash/create';
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

        $insert = $this->smsflash->insert($input);
        if (!$insert) {
            flashMessage('error', 'SMS gagal dikirim!');
        } else {
            flashMessage('success', 'SMS berhasil dikirim.');
        }

        redirect('sent', 'refresh');
    }
}
