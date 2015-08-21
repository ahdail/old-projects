<?php
class ClickM extends Model
{
    function clickAtual ($id)
    {
        $this->db->select('click');
        $this->db->from('banner');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }
    function update ($id)
    {
        $this->db->set('click', 'click+1', FALSE);
        $this->db->update('banner', NULL, "id = {$id}");
    }
}
?>