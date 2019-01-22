<?php
class SmsModel extends MY_Model
{
    protected $table = 'outbox';

    public function getValidationRules()
    {
        return [
            [
            'field' => 'DestinationNumber',
            'label' => 'Nomor HP',
            'rules' => 'trim|required|numeric|max_length[15]'
            ],
            [
            'field' => 'TextDecoded',
            'label' => 'Isi SMS',
            'rules' => 'trim|required|max_length[160]'
            ]
        ];
    }

    public function getDefaultValues()
    {
        return [
            'DestinationNumber' => '',
            'TextDecoded'       => ''
        ];
    }

    public function insert($data)
    {
        $data->DestinationNumber = $this->formatPhoneNumber(
            $data->DestinationNumber
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}