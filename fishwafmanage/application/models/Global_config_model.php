<?php
class Global_config_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // 查询global config
    public function get_global_config()
    {
        $sql = "SELECT * FROM `global_config`";
        $query = $this->db->query($sql);
        $result = $query->row();

        return $result ? $result : '';
    }

    // 更新global config
    public function update_global_config($data)
    {
        $this->db->update('global_config', $data);

        return $this->db->affected_rows();
    }

}