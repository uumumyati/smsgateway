<?php
class SignatureModel extends CI_Model
{
    protected $table = 'signature';

    public function getValidationRules()
    {
        return [
            [
            'field' => 'message',
            'label' => 'Signature',
            'rules' => 'trim|required|max_length[50]'
            ]
        ];
    }

    public function getDefaultValues()
    {
        return ['message' => ''];
    }

    public function get()
    {
        return $this->db->select('message')
                        ->get($this->table)
                        ->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }

    public function update($input)
    {
        return $this->db->set('message', $input->message)
                        ->update($this->table);
    }

    public function validate()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters(
            '<span class="help-block">',
            '</span>'
        );
        $validationRules = $this->getValidationRules();
        $this->form_validation->set_rules($validationRules);
        return $this->form_validation->run();
    }

}