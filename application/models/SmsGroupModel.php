<?php
class SmsGroupModel extends MY_Model
{
    protected $table = 'outbox';

    public function getValidationRules()
    {
        return [
            [
            'field' => 'GroupID',
            'label' => 'Group',
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
            'GroupID'     => '',
            'TextDecoded' => ''
        ];
    }

    public function insert($input)
    {
        $groupId = $input->GroupID;
        $pesan   = $input->TextDecoded;

        // Get destination numbers.
        $destinationNumbers = $this->getDestinationNumber($groupId);

        // Prepare data.
        $data = $this->prepData($destinationNumbers, $pesan);

        // Insert / send multiple sms.
        $this->db->insert_batch('outbox', $data);
        return $this->db->affected_rows();
    }

    private function getDestinationNumber($groupID)
    {
        return $this->db->select('Number')
                        ->from('pbk')
                        ->where('GroupID', $groupID)
                        ->get()
                        ->result();
    }

    private function prepData($destNumbers, $pesan)
    {
        $data = [];
        foreach($destNumbers as $row) {
            $data[] = [
                'DestinationNumber' => $row->Number,
                'TextDecoded'       => $pesan
            ];
        }

        return $data;
    }
}
