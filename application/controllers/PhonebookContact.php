<?php
class PhonebookContact extends OperatorController
{
    public function index($page = null)
    {
        $phonebookContact = $this->phonebookcontact->paginate($page);
        if (!$phonebookContact) {
            message('error', 'Tidak ada data!');
        }

        $mainView   = 'phonebook_contact/index';
        $heading    = 'Phonebook Contact';
        $totalRow   = count($this->phonebookcontact->getAll());
        $pagination = $this->phonebookcontact->makePaginationLink(
            site_url('phonebook-contact'),
            2,
            $totalRow
        );
        $this->load->view('template', compact(
            'mainView',
            'heading',
            'phonebookContact',
            'pagination',
            'totalRow'
        ));
    }

    public function create()
    {
        $input = (object) $this->input->post(null, true);
        if (! $_POST) {
            $input = $this->phonebookcontact->getDefaultValues();
            $input = (object) $input;
        }

        $validate = $this->phonebookcontact->validate();
        if (! $validate) {
            $mainView   = 'phonebook_contact/form';
            $heading    = 'Phonebook Contact > Create';
            $formAction = 'phonebookcontact/create';
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

        $insert = $this->phonebookcontact->insert($input);
        if (! $insert) {
            flashMessage('error', 'Data gagal disimpan!');
        } else {
            flashMessage('success', 'Data berhasil disimpan.');
        }

        redirect('phonebook-contact', 'refresh');
    }

    public function edit($id = null)
    {
        $phonebookContact = $this->phonebookcontact->find($id);
        if (! $phonebookContact) {
            flashMessage('error', 'Data tidak ditemukan!');
            redirect('phonebook', 'refresh');
        }

        $input = (object) $this->input->post(null, true);
        if (! $_POST) {
            $input = (object) $phonebookContact;
        }

        $validate = $this->phonebookcontact->validate();
        if (! $validate) {
            $mainView   = 'phonebook_contact/form';
            $heading    = 'Phonebook Contact > Edit';
            $formAction = "phonebookcontact/edit/$id";
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

        $update = $this->phonebookcontact->update($id, $input);
        if (! $update) {
            flashMessage('error', 'Data gagal diupdate!');
        } else {
            flashMessage('success', 'Data berhasil diupdate.');
        }

        redirect('phonebook-contact', 'refresh');
    }

    public function delete()
    {
        $id = $this->input->post('ID', true);

        $phonebookContact = $this->phonebookcontact->find($id);
        if (! $phonebookContact) {
            flashMessage('error', 'Data tidak ditemukan!');
            redirect('phonebook-contact', 'refresh');
        }

        $delete = $this->phonebookcontact->delete($id);
        if (! $delete) {
            flashMessage('error', 'Data gagal dihapus!');
        } else {
            flashMessage('success', 'Data berhasil dihapus.');
        }

        redirect('phonebook-contact', 'refresh');
    }

    /*
    |-----------------------------------------------------------------
    | Callback.
    |-----------------------------------------------------------------
    */
    public function isNoHpUnik()
    {
        $noHp = $this->input->post('Number');
        // Memformat no hp dengan +62
        $noHpFormated = $this->phonebookcontact
                             ->formatPhoneNumber($noHp);
        $id   = $this->input->post('ID');

        // PENTING! Harus memakai DB ($this->db).
        // Kalau memakai instance model ($this->namaModel),
        // error tidak akan muncul.
        $this->db->where('Number', $noHp);
        // Mencocokkan dengan no hp yang terformat juga.
        $this->db->or_where('Number', $noHpFormated);
        !$id || $this->db->where('ID !=', $id);
        $kembar = $this->db->get('pbk')->result();

        if (count($kembar) > 0) {
            $this->form_validation->set_message(
                'isNoHpUnik',
                '%s sudah digunakan.'
            );
            return false;
        }
        return true;
    }
}
