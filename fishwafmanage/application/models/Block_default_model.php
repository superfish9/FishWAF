<?php
class Block_default_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // 查询block default
    public function get_block_default()
    {
        $sql = "SELECT * FROM `block_default`";
        $query = $this->db->query($sql);
        $result = $query->row();

        return $result ? $result : '';
    }

    // 更新block default
    public function update_block_default($data)
    {
        $this->db->update('block_default', $data);

        return $this->db->affected_rows();
    }

}