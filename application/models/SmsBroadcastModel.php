<?php
class SmsBroadcastModel extends MY_Model
{
    protected $table = 'outbox';

    public function getValidationRules()
    {
        return [
            [
            'field' => 'DestinationNumbers',
            'label' => 'No HP',
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
            'DestinationNumbers' => '',
            'TextDecoded'        => ''
        ];
    }

    public function insert($input)
    {
        $noHPs = $this->fetchNoHp($input->DestinationNumbers);
        $pesan = $input->TextDecoded;
        $data  = $this->prepData($noHPs, $pesan);

        $this->db->insert_batch('outbox', $data);
        return $this->db->affected_rows();
    }

    private function fetchNoHp($destinationNumbers)
    {
        $noHPs = preg_split('/[\s]/', $destinationNumbers);

        // Cari item array yang empty.
        $keys = array_keys($noHPs, "");

        // Hapus array item yang berisi empty string.
        foreach ($keys as $k) {
            unset($noHPs[$k]);
        }

        return$noHPs;
    }

    private function prepData($noHPs, $pesan)
    {
        $data = [];
        foreach($noHPs as $noHP) {
            $noHP = $this->formatPhoneNumber($noHP);

            $data[] = [
                'DestinationNumber' => $noHP,
                'TextDecoded'       => $pesan
            ];
        }
        return $data;
    }
}
