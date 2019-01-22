<?php
class SentModel extends MY_Model
{
    protected $table   = 'sentitems';
    protected $perPage = 5;

    public function paginate($page)
    {
        $offset = $this->calcRealOffset($page);
        $sent = $this->db->select(
                            'ID,
                            DestinationNumber,
                            SendingDateTime,
                            Status,
                            TextDecoded'
                          )
                         ->order_by('ID', 'desc')
                         ->limit($this->perPage, $offset)
                         ->get($this->table)
                         ->result();
        $sent = $this->prepDestinationName($sent);
        $sent = $this->prepStatus($sent);
        return $sent;
    }

    private function prepDestinationName($sent)
    {
        foreach($sent as $row) {
            $noHP = $row->DestinationNumber;
            $found = $this->getContactName($noHP);
            if ($found) {
                $nama = $found->Name;
                $row->DestinationNumber = "<span>$nama</span>$noHP";
            } else {
                $row->DestinationNumber = $noHP;
            }
        }
        return $sent;
    }

    private function prepStatus($sent)
    {
        $statusType = [
            'SendingOK'         => 'Pending',
            'SendingOKNoReport' => 'OK',
            'SendingError'      => 'Failed',
            'DeliveryOK'        => 'Delivered',
            'DeliveryFailed'    => 'Failed',
            'DeliveryPending'   => 'Pending',
            'DeliveryUnknown'   => 'Pending',
            'Error'             => 'Failed'
        ];

        foreach ($sent as $row) {
            $row->Status = $statusType[$row->Status];
        }

        return $sent;
    }
}
