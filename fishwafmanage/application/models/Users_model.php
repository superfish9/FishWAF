<?php
class Users_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // 查询某个用户的密码哈希
    public function get_a_passhash($username)
    {
        $sql = "SELECT `password` FROM `users` WHERE `username` = ?";
        $query = $this->db->query($sql, array($username));
        $result = $query->row();
        
        return $result ? $result->password : '';
    }

    // 修改密码
    public function change_password($username, $new_password)
    {
        $this->db->where('username', $username);
        $data = array(
            'password' => $new_password
        );
        $this->db->update('users', $data);

        return $this->db->affected_rows();
    }

}