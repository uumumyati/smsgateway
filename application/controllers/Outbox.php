<?php
class Outbox extends OperatorController
{
    public function index($page = null)
    {
        $outbox = $this->outbox->orderBy('ID', 'desc')
                               ->paginate($page);
        if (!$outbox) {
            message('error', 'Tidak ada data!');
        }

        $mainView   = 'outbox/index';
        $heading    = 'Outbox';
        $totalRow   = count($this->outbox->getAll());
        $pagination = $this->outbox->makePaginationLink(
            site_url('outbox'),
            2,
            $totalRow
        );
        $this->load->view('template', compact(
            'mainView',
            'heading',
            'outbox',
            'totalRow',
            'pagination'
        ));
    }

    public function delete()
    {
        $id = $this->input->post('ID', true);

        $outbox = $this->outbox->find($id);
        if (!$outbox) {
            flashMessage('error', 'Data tidak ditemukan!');
            redirect('outbox', 'refresh');
        }

        $delete = $this->outbox->delete($id);
        if (!$delete) {
            flashMessage('error', 'Data gagal dihapus!');
        } else {
            flashMessage('success', 'Data berhasil dihapus.');
        }

        redirect('outbox', 'refresh');
    }
}
