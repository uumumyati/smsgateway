<?php
class Inbox extends OperatorController
{
    public function index($page = null)
    {
        $inbox = $this->inbox->paginate($page);
        if (!$inbox) {
            message('error', 'Tidak ada data!');
        }

        $mainView   = 'inbox/index';
        $heading    = 'Inbox';
        $totalRow   = count($this->inbox->getAll());
        $pagination = $this->inbox->makePaginationLink(
            site_url('inbox'),
            2,
            $totalRow
        );
        $this->load->view('template', compact(
            'mainView',
            'heading',
            'inbox',
            'pagination',
            'totalRow'
        ));
    }

    public function delete()
    {
        $id = $this->input->post('ID', true);

        $inbox = $this->inbox->find($id);
        if (!$inbox) {
            flashMessage('error', 'Data tidak ditemukan!');
            redirect('inbox', 'refresh');
        }

        $delete = $this->inbox->delete($id);
        if (!$delete) {
            flashMessage('error', 'Data gagal dihapus!');
        } else {
            flashMessage('success', 'Data berhasil dihapus.');
        }

        redirect('inbox', 'refresh');
    }
}
