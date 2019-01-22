<?php
class PhonebookContactModel extends MY_Model
{
    protected $table   = 'pbk';
    protected $perPage = 5;

    public function getValidationRules()
    {
        return [
            [
                'field' => 'GroupID',
                'label' => 'Group',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'Name',
                'label' => 'Nama',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'Number',
                'label' => 'Nomor HP',
                'rules' => 'trim|required|numeric|callback_isNoHpUnik'
            ]
        ];
    }

    public function getDefaultValues()
    {
        return [
            'GroupID' => '',
            'Name'    => '',
            'Number'  => ''
        ];
    }

    public function paginate($page)
    {
        $offset = $this->calcRealOffset($page);
        return $this->db->select('pbk.ID, pbk.Name, pbk.Number')
                        ->select('pbk_groups.Name as namaGroup')
                        ->from($this->table)
                        ->join('pbk_groups', 'pbk.GroupID = pbk_groups.ID')
                        ->order_by('namaGroup')
                        ->order_by('pbk.Name')
                        ->limit($this->perPage, $offset)
                        ->get()
                        ->result();
    }

    public function insert($data)
    {
        $data->Number = $this->formatPhoneNumber($data->Number);
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $data->Number = $this->formatPhoneNumber($data->Number);
        $this->db->where("$this->table.ID", $id);
        return $this->db->update($this->table, $data);
    }
}
