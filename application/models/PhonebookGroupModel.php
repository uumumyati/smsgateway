<?php
class PhonebookGroupModel extends MY_Model
{
    protected $table = 'pbk_groups';

    public function getValidationRules()
    {
        return [
            [
            'field' => 'Name',
            'label' => 'Nama Group',
            'rules' => 'trim|required|callback_isGroupUnik'
            ]
        ];
    }

    public function getDefaultValues()
    {
        return ['Name' => ''];
    }

    public function delete($id)
    {
        $deletePbkGroup = $this->db->where("$this->table.ID", $id)
                                   ->delete($this->table);
        $deletePbk      = $this->db->where("pbk.GroupID", $id)
                                   ->delete('pbk');

        if ($deletePbkGroup && $deletePbk) {
            return true;
        }
        return false;
    }
}