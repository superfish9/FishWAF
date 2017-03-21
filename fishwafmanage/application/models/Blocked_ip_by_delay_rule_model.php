<?php
class Blocked_ip_by_delay_rule_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // 查询blocked ip by delay rule
    public function get_blocked_ip_by_delay_rule($start, $num)
    {
        $sql = "SELECT * FROM `blocked_ip_by_delay_rule` ORDER BY `time` DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($start, $num));
        $result = $query->result_array();

        return $result;
    }

    // 删除blocked ip by delay rule
    public function remove_blocked_ip_by_delay_rule($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('blocked_ip_by_delay_rule');

        return $this->db->affected_rows();
    }

}