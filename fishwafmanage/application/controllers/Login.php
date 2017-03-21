<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('users_model');
    }

    public function index()
    {
        // 判断用户是否登录
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in === TRUE) {
            redirect('/manage', 'location', 302);
            return;
        }

        // 处理登录请求
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('login');
            return;
        }
        else
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($this->check_login($username, $password) === FALSE)
            {
                $data['error'] = 'login failed';
                $this->load->view('login', $data);
                return;
            }
            else
            {
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('logged_in', TRUE);
                redirect('/manage', 'location', 302);
                return;
            }
        }

        // 登陆页面
        $this->load->view('login');
        return;
    }

    // 验证用户名密码是否正确
    private function check_login($username, $password)
    {
        $passhash = $this->users_model->get_a_passhash($username);
        return password_verify($password, $passhash);
    }

}
