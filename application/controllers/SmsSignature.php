<?php
class SmsSignature extends OperatorController
{
    public function create()
    {
        $input = (object) $this->input->post(null, true);
        if (!$_POST) {
            $input = $this->smssignature->getDefaultValues();
            $input = (object) $input;
        }

        $validate = $this->smssignature->validate();
        if (!$validate) {
            $mainView   = 'sms_signature/form';
            $heading    = 'Signature SMS';
            $formAction = 'sms-signature/create';
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

        $insert = $this->smssignature->insert($input);
        if (!$insert) {
            flashMessage('error', 'SMS gagal dikirim!');
        } else {
            flashMessage('success', 'SMS berhasil dikirim.');
        }

        redirect('sent', 'refresh');
    }
}
