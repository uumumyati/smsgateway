<?php
class OutboxModel extends MY_Model
{
    protected $table   = 'outbox';
    protected $perPage = 5;

    public function paginate($page)
    {
        $offset = $this->calcRealOffset($page);
        $outbox = $this->db->select(
                                'ID,
                                SendingDateTime,
                                DestinationNumber,
                                TextDecoded'
                            )
                           ->order_by('ID', 'desc')
                           ->limit($this->perPage, $offset)
                           ->get($this->table)
                           ->result();
        $outbox = $this->prepDestinationName($outbox);
        return $outbox;
    }

    protected function prepDestinationName($outbox)
    {
        foreach($outbox as $row) {
            $noHP = $row->DestinationNumber;
            $found = $this->getContactName($noHP);
            if ($found) {
                $nama = $found->Name;
                $row->DestinationNumber = "<span>$nama</span>$noHP";
            } else {
                $row->DestinationNumber = $noHP;
            }
        }
        return $outbox;
    }
}
