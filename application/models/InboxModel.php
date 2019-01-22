<?php
class InboxModel extends MY_Model
{
    protected $table   = 'inbox';
    protected $perPage = 5;

    public function paginate($page)
    {
        $offset = $this->calcRealOffset($page);
        $inbox = $this->db->select('ID,
                                    ReceivingDateTime,
                                    SenderNumber,
                                    TextDecoded'
                           )
                          ->order_by('ID', 'desc')
                          ->limit($this->perPage, $offset)
                          ->get($this->table)
                          ->result();
        $inbox = $this->prepSenderName($inbox);
        return $inbox;
    }

    protected function prepSenderName($inbox)
    {
        foreach($inbox as $row) {
            $noHP = $row->SenderNumber;
            $found = $this->getContactName($noHP);
            if ($found) {
                $nama = $found->Name;
                $row->SenderNumber = "<span>$nama</span>$noHP";
            } else {
                $row->SenderNumber = $noHP;
            }
        }
        return $inbox;
    }
}