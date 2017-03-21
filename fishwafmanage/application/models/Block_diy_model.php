<?php
class Block_diy_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // 查询block diy
    public function get_block_diy()
    {
        $sql = "SELECT * FROM `block_diy`";
        $query = $this->db->query($sql);
        $result = $query->row();

        return $result ? $result : '';
    }

    // 更新block diy
    public function update_block_diy($data)
    {
        $this->db->update('block_diy', $data);

        return $this->db->affected_rows();
    }
}