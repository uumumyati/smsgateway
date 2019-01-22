<?php
class Account extends OperatorController
{
    public function index()
    {
        $id      = $this->session->userdata('userID');
        $account = $this->account->find($id);
        if (!$account) {
            redirect('logout', 'refresh');
        }

        $mainView = 'account/index';
        $heading  = 'Account';
        $this->load->view('template', compact(
            'mainView',
            'heading',
            'account'
        ));
    }

    public function edit()
    {
        $id      = $this->session->userdata('userID');
        $account = $this->account->find($id);
        if (!$account) {
            redirect('logout', 'refresh');
        }

        $input = (object) $this->input->post(null, true);
        if (!$_POST) {
            $input = (object) $account;
            $input->password = '';
        }

        $validate = $this->account->validate();
        if (!$validate) {
            $mainView   = 'account/form';
            $heading    = 'Account > Edit';
            $formAction = "account/edit";
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

        // Hapus passConf, tidak perlu disimpan ke database.
        unset($input->passConf);

        $update = $this->account->update($id, $input);
        if (!$update) {
            flashMessage('error', 'Data gagal diupdate!');
        } else {
            flashMessage('success', 'Data berhasil diupdate.');
            $this->session->set_userdata(
                'username',
                $input->username
            );
        }

        redirect('account', 'refresh');
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
}
