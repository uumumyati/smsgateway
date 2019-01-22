<?php
class SmsGroup extends OperatorController
{
    public function create()
    {
        $input = (object) $this->input->post(null, true);
        if (! $_POST) {
            $input = $this->smsgroup->getDefaultValues();
            $input = (object) $input;
        }

        $validate = $this->smsgroup->validate();
        if (! $validate) {
            $mainView   = 'sms_group/form';
            $heading    = 'Group SMS';
            $formAction = 'sms-group/create';
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

        $insert = $this->smsgroup->insert($input);
        if (! $insert) {
            flashMessage('error', 'SMS gagal dikirim!');
        } else {
            flashMessage('success', 'SMS berhasil dikirim.');
        }

        redirect('sent', 'refresh');
    }
}
