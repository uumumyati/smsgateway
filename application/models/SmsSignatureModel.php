<?php
class SmsSignatureModel extends MY_Model
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
            'field' => 'is_signature',
            'label' => 'Signature?',
            'rules' => 'trim|required'
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
            'is_signature'      => false,
            'TextDecoded'       => ''
        ];
    }

    public function insert($data)
    {
        // Data is_signature tidak perlu disimpan ke database.
        unset($data->is_signature);

        // Menggabungkan pesan dengan signature.
        $signatureMsg = $this->getSignatureMessage();
        $data->TextDecoded = $data->TextDecoded . " $signatureMsg";

        $data->DestinationNumber = $this->formatPhoneNumber(
            $data->DestinationNumber
        );

        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    private function getSignatureMessage()
    {
        $signature = '';
        $query = $this->db->select('message')
                          ->get('signature')
                          ->row();
        if ($query) {
            $signature = $query->message;
        }

        return $signature;
    }
}