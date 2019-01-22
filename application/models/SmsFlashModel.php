<?php
class SmsFlashModel extends MY_Model
{
    protected $table = 'outbox';

    public function getValidationRules()
    {
        return [
            [
            'field' => 'DestinationNumber',
            'label' => 'Nomor HP',
            'rules' => 'trim|required|numeric'
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

        // Set sebagai flash.
        $data->Class = 0;

        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}