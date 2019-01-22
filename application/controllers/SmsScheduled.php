<?php
class SmsScheduled extends OperatorController
{
    public function index($page = null)
    {
        $schedule = $this->smsscheduled->orderBy('ID', 'desc')
                                       ->where('status', 'belum')
                                       ->paginate($page);
        if (!$schedule) {
            message('error', 'Tidak ada data!');
        }

        // Cek jika ada scheduled sms, kirimkan.
        if ($schedule) {
            $this->smsscheduled->runDaemon();
        }

        $mainView   = 'sms_scheduled/index';
        $heading    = 'Scheduled SMS';
        $totalRow   = count(
            $this->smsscheduled->where('status', 'belum')->getAll()
        );
        $pagination = $this->smsscheduled->makePaginationLink(
            site_url('sms-scheduled'),
            2,
            $totalRow
        );
        $this->load->view('template', compact(
            'mainView',
            'heading',
            'schedule',
            'pagination',
            'totalRow'
        ));
    }

    public function create()
    {
        $input = (object) $this->input->post(null, true);
        if (!$_POST) {
            $input = $this->smsscheduled->getDefaultValues();
            $input = (object) $input;
        }

        $validate = $this->smsscheduled->validate();
        if (!$validate) {
            $mainView   = 'sms_scheduled/form';
            $heading    = 'Scheduled SMS > Create';
            $formAction = 'sms-scheduled/create';
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

        $insert = $this->smsscheduled->insert($input);
        if (!$insert) {
            flashMessage('error', 'SMS gagal dikirim!');
        } else {
            flashMessage('success', 'SMS berhasil dikirim.');
        }

        redirect('sms-scheduled', 'refresh');
    }

    public function delete()
    {
        $id = $this->input->post('ID', true);

        $schedule = $this->smsscheduled->find($id);
        if (!$schedule) {
            flashMessage('error', 'Data tidak ditemukan!');
            redirect('sms-scheduled', 'refresh');
        }

        $delete = $this->smsscheduled->delete($id);
        if (! $delete) {
            flashMessage('error', 'Data gagal dihapus!');
        } else {
            flashMessage('success', 'Data berhasil dihapus.');
        }

        redirect('sms-scheduled', 'refresh');
    }
}
