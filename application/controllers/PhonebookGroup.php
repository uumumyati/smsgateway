<?php
class PhonebookGroup extends OperatorController
{
    public function index()
    {
        $phonebookGroup = $this->phonebookgroup->orderBy('Name')
                                               ->getAll();
        if (! $phonebookGroup) {
            message('error', 'Tidak ada data!');
        }

        $mainView = 'phonebook_group/index';
        $heading  = 'Phonebook Group';
        $this->load->view('template', compact(
            'mainView',
            'heading',
            'phonebookGroup'
        ));
    }

    public function create()
    {
        $input = (object) $this->input->post(null, true);
        if (! $_POST) {
            $input = $this->phonebookgroup->getDefaultValues();
            $input = (object) $input;
        }

        $validate = $this->phonebookgroup->validate();
        if (! $validate) {
            $mainView   = 'phonebook_group/form';
            $heading    = 'Phonebook Group > Create';
            $formAction = 'phonebook-group/create';
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

        $insert = $this->phonebookgroup->insert($input);
        if (! $insert) {
            flashMessage('error', 'Data gagal disimpan!');
        } else {
            flashMessage('success', 'Data berhasil disimpan.');
        }

        redirect('phonebook-group', 'refresh');
    }

    public function edit($id = null)
    {
        $phonebookGroup = $this->phonebookgroup->find($id);
        if (! $phonebookGroup) {
            flashMessage('error', 'Data tidak ditemukan!');
            redirect('phonebook-group', 'refresh');
        }

        $input = (object) $this->input->post(null, true);
        if (! $_POST) {
            $input = (object) $phonebookGroup;
        }

        $validate = $this->phonebookgroup->validate();
        if (! $validate) {
            $mainView   = 'phonebook_group/form';
            $heading    = 'Phonebook Group > Edit';
            $formAction = "phonebook-group/edit/$id";
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

        $update = $this->phonebookgroup->update($id, $input);
        if (! $update) {
            flashMessage('error', 'Data gagal diupdate!');
        } else {
            flashMessage('success', 'Data berhasil diupdate.');
        }

        redirect('phonebook-group', 'refresh');
    }

    public function delete()
    {
        $id = $this->input->post('ID', true);

        $phonebookGroup = $this->phonebookgroup->find($id);
        if (! $phonebookGroup) {
            flashMessage('error', 'Data tidak ditemukan!');
            redirect('phonebook-group', 'refresh');
        }

        $delete = $this->phonebookgroup->delete($id);
        if (! $delete) {
            flashMessage('error', 'Data gagal dihapus!');
        } else {
            flashMessage('success', 'Data berhasil dihapus.');
        }

        redirect('phonebook-group', 'refresh');
    }

    /*
    |-----------------------------------------------------------------
    | Callback.
    |-----------------------------------------------------------------
    */
    public function isGroupUnik()
    {
        $namaGroup = $this->input->post('Name');
        $id        = $this->input->post('ID');

        // PENTING! Harus memakai DB ($this->db).
        // Kalau memakai instance model ($this->namaModel),
        // error tidak akan muncul.
        $this->db->where('Name', $namaGroup);
        !$id || $this->db->where('ID !=', $id);
        $kembar = $this->db->get('pbk_groups')->result();

        if (count($kembar) > 0) {
            $this->form_validation->set_message(
                'isGroupUnik',
                '%s sudah digunakan.'
            );
            return false;
        }
        return true;
    }
}
