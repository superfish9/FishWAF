<?php
class Reports_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // 查询reports
    public function get_reports($start, $num)
    {
        $sql = "SELECT * FROM `reports` ORDER BY `time` DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($start, $num));
        $result = $query->result_array();

        return $result;
    }

    // 获取request
    public function get_request($id)
    {
        $sql = "SELECT `request` FROM `reports` WHERE `id` = ?";
        $query = $this->db->query($sql, array($id));
        $result = $query->row();

        return $result ? $result->request : '';
    }

    // 根据时间段查询
    public function get_reports_by_time($start_time, $end_time)
    {
        $sql = "SELECT * FROM `reports` WHERE `time` > ? AND `time` < ? ORDER BY `time` DESC";
        $query = $this->db->query($sql, array($start_time, $end_time));
        $result = $query->result_array();

        return $result;
    }

}