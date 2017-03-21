<?php
class Delay_block_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // 查询delay block
    public function get_delay_block()
    {
        $sql = "SELECT * FROM `delay_block`";
        $query = $this->db->query($sql);
        $result = $query->row();

        return $result ? $result : '';
    }

    // 修改delay block
    public function update_delay_block($data)
    {
        $this->db->update('delay_block', $data);

        return $this->db->affected_rows();
    }
}