<?php
class User extends AdminController
{
    public function index()
    {
        $user = $this->user->getAll();
        if (!$user) {
            message('error', 'Tidak ada data!');
        }

        $mainView = 'user/index';
        $heading  = 'User';
        $this->load->view('template', compact(
            'mainView',
            'heading',
            'user'
        ));
    }

    public function create()
    {
        $input = (object) $this->input->post(null, true);
        if (!$_POST) {
            $input = $this->user->getDefaultValues();
            $input = (object) $input;
        }

        $validate = $this->user->validate();
        if (!$validate) {
            $mainView   = 'user/form';
            $heading    = 'User > Create';
            $formAction = 'user/create';
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

        // Enkripsi password.
        $input->password = md5($input->password);

        $insert = $this->user->insert($input);
        if (!$insert) {
            flashMessage('error', 'Data gagal disimpan!');
        } else {
            flashMessage('success', 'Data berhasil disimpan.');
        }

        redirect('user', 'refresh');
    }

    public function edit($id = null)
    {
        $user = $this->user->find($id);
        if (!$user) {
            flashMessage('error', 'Data tidak ditemukan!');
            redirect('user', 'refresh');
        }

        $input = (object) $this->input->post(null, true);
        if (!$_POST) {
            $input = (object) $user;
            $input->password = '';
        }

        $validate = $this->user->validate();
        if (!$validate) {
            $mainView   = 'user/form';
            $heading    = 'User > Edit';
            $formAction = "user/edit/$id";
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

        // Enkripsi password.
        if (!empty($input->password)) {
            $input->password = md5($input->password);
        } else {
            unset($input->password);
        }

        $update = $this->user->update($id, $input);
        if (!$update) {
            flashMessage('error', 'Data gagal diupdate!');
        } else {
            flashMessage('success', 'Data berhasil diupdate.');
        }

        redirect('user', 'refresh');
    }

    public function delete()
    {
        $id = $this->input->post('ID', true);

        $user = $this->user->find($id);
        if (!$user) {
            flashMessage('error', 'Data tidak ditemukan!');
            redirect('user', 'refresh');
        }

        $delete = $this->user->delete($id);
        if (!$delete) {
            flashMessage('error', 'Data gagal dihapus!');
        } else {
            flashMessage('success', 'Data berhasil dihapus.');
        }

        redirect('user', 'refresh');
    }

    /*
    |-----------------------------------------------------------------
    | Callback.
    |-----------------------------------------------------------------
    */
    public function isUsernameUnik()
    {
        $username = $this->input->post('username');
        $id       = $this->input->post('ID');

        $this->db->where('username', $username);
        !$id || $this->db->where('ID !=', $id);
        $kembar = $this->db->get('user')->result();

        if (count($kembar) > 0) {
            $this->form_validation->set_message(
                'isUsernameUnik',
                '%s sudah digunakan.'
            );
            return false;
        }
        return true;
    }

    public function isPasswordRequired()
    {
        // Ketika edit, password TIDAK "required".
        $isEdit = $this->uri->segment(2);
        if ($isEdit == 'edit') {
            return true;
        }

        // Ketika create, password "required".
        $password = $this->input->post('password', true);
        if (empty($password)) {
            $this->form_validation->set_message(
                'isPasswordRequired',
                '%s harus diisi.'
            );
            return false;
        }
    }
}
