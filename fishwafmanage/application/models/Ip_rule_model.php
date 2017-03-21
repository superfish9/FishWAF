<?php
class Ip_rule_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // 查询ip rule
    public function get_ip_rule($type)
    {
        $sql = "SELECT `id`, `path`, `ip` FROM `ip_rule` WHERE `type` = ?";
        $query = $this->db->query($sql, array($type));
        $result = $query->result_array();

        return $result;
    }

    // 删除ip rule
    public function remove_ip_rule($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('ip_rule');

        return $this->db->affected_rows();
    }

    // 增加ip rule
    public function add_ip_rule($data)
    {
        $this->db->insert('ip_rule', $data);

        return $this->db->affected_rows();
    }

}