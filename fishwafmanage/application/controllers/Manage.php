<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('global_config_model');
        $this->load->model('ip_rule_model');
        $this->load->model('block_default_model');
        $this->load->model('block_diy_model');
        $this->load->model('delay_block_model'); 
        $this->load->model('blocked_ip_by_delay_rule_model');
        $this->load->model('reports_model');
        $this->load->model('users_model');
    }

    // 获取用户登陆状态
    private function is_login()
    {
        $logged_in = $this->session->userdata('logged_in');
        return $logged_in;
    }

    // 判断是否为CSRF
    private function is_csrf($req_referer)
    {
        if ($req_referer == '')
        {
            return TRUE;
        }
        $site_domain = parse_url(site_url())['host'];
        $req_parsed = parse_url($req_referer);
        if (isset($req_parsed['host']))
        {
            $req_domain = parse_url($req_referer)['host'];
            return $site_domain !== $req_domain ? TRUE : FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function index()
    {
        if ($this->is_login() !== TRUE)
        {
            redirect('/login', 'location', 302);
            return;
        }
        $this->dashboard();
        return;
    }

    public function dashboard()
    {
        if ($this->is_login() !== TRUE)
        {
            redirect('/login', 'location', 302);
            return;
        }

        $data = $this->input->post();
        if ($data != array())
        {   
            // 处理csrf
            $req_referer = $this->input->server('HTTP_REFERER');
            if ($this->is_csrf($req_referer) === TRUE)
            {
                $resp = array(
                    'status' => '1',
                    'message' => 'csrf'
                );
                echo json_encode($resp);
                return;
            }

            if (isset($data['act']) && $data['act'] == 'remove')
            {
                // 删除blocked ip by delay rule
                if ($this->blocked_ip_by_delay_rule_model->remove_blocked_ip_by_delay_rule($data['id']) == -1)
                {
                    $resp = array(
                        'status' => '2',
                        'message' => 'remove fail'
                    );
                    echo json_encode($resp);
                    return;
                }
                else
                {
                    $resp = array(
                        'status' => '0',
                        'message' => 'remove success'
                    );
                    echo json_encode($resp);
                    return;
                }
            }
        }

        // 获取global config
        $global_config = $this->global_config_model->get_global_config();

        if ($global_config != '')
        {
            $is_open = $global_config->is_open == 1 ? 'open' : 'close';
            $is_debug = $global_config->is_debug == 1 ? 'open' : 'close';
            $blocked_ip = $global_config->blocked_ip == 1 ? 'open' : 'close';
            $dummy_protection = $global_config->dummy_protection == 1 ? 'open' : 'close';

            $start = isset($data['start']) ? intval($data['start']) : 0;
            $count = isset($data['count']) ? intval($data['count']) : 10;

            // 获取blocked ip by delay rule
            $blocked_ip_by_delay_rule = $this->blocked_ip_by_delay_rule_model->get_blocked_ip_by_delay_rule($start, $count);

            $page_data = array(
                'is_open' => $is_open,
                'is_debug' => $is_debug,
                'blocked_ip' => $blocked_ip,
                'dummy_protection' => $dummy_protection,

                'blocked_ip_by_delay_rule' => $blocked_ip_by_delay_rule
            );
            $this->load->view('dashboard', $page_data);
        }
        else
        {
            show_error('error', 500, ' - - ');
            return;
        }
    }

    public function reports()
    {
        if ($this->is_login() !== TRUE)
        {
            redirect('/login', 'location', 302);
            return;
        }

        $data = $this->input->post();
        if ($data != array())
        {   
            if (isset($data['act']) && $data['act'] == 'get_request')
            {
                // 获取request
                $request = $this->reports_model->get_request($data['id']);
                $message = str_replace(PHP_EOL, '</br>', htmlspecialchars($request));
                
                $resp = array(
                    'status' => '0',
                    'message' => $message
                );
                echo json_encode($resp);
                return;
            }

            if (isset($data['start_time']) || isset($data['end_time']))
            {
                $start = isset($data['start_time']) && $data['start_time'] != '' ? $data['start_time'] : '1999-01-01';
                $end = isset($data['end_time']) && $data['end_time'] != '' ? $data['end_time'] : '2999-12-31';
                $start_time = strtotime($start . '00:00:00');
                $end_time = strtotime($end. '23:59:59');

                // 根据时间查询
                $reports = $this->reports_model->get_reports_by_time($start_time, $end_time);

                $page_data = array(
                    'reports' => $reports
                );
                $this->load->view('reports', $page_data);
                return;
            }
        }

        // 获取reports
        $reports = $this->reports_model->get_reports(0, 30);

        $page_data = array(
            'reports' => $reports
        );
        $this->load->view('reports', $page_data);
    }

    public function settings()
    {
        if ($this->is_login() !== TRUE)
        {
            redirect('/login', 'location', 302);
            return;
        }

        // 获取global config
        $global_config = $this->global_config_model->get_global_config();
        
        // 获取block default
        $block_default = $this->block_default_model->get_block_default();

        // 获取block diy
        $block_diy = $this->block_diy_model->get_block_diy();

        // 获取delay block
        $delay_block = $this->delay_block_model->get_delay_block();

        if ($global_config != '' && $block_default != '' && $block_diy != '' && $delay_block != '')
        {
            $real_ip = $global_config->real_ip;
            $real_port = $global_config->real_port;
            $is_open = $global_config->is_open == 1 ? 'open' : 'close';
            $is_debug = $global_config->is_debug == 1 ? 'open' : 'close';

            $white_ip = $global_config->white_ip == 1 ? 'open' : 'close';
            $black_ip = $global_config->black_ip == 1 ? 'open' : 'close';

            $sqli = $global_config->sqli == 1 ? 'open' : 'close';
            $file_extension = $global_config->file_extension == 1 ? 'open' : 'close';
            $file_content = $global_config->file_content == 1 ? 'open' : 'close';
            $file_length = $global_config->file_length == 1 ? 'open' : 'close';
            $caidao = $global_config->caidao == 1 ? 'open' : 'close';
            $url_length = $global_config->url_length == 1 ? 'open' : 'close';
            $body_length = $global_config->body_length == 1 ? 'open' : 'close';
            $whiteuri = $global_config->whiteuri == 1 ? 'open' : 'close';
            $url_content = $global_config->url_content == 1 ? 'open' : 'close';
            $body_content = $global_config->body_content == 1 ? 'open' : 'close';
            $header_content = $global_config->header_content == 1 ? 'open' : 'close';

            $limit_per_10_seconds = $global_config->limit_per_10_seconds == 1 ? 'open' : 'close';
            $limit_for_block = $global_config->limit_for_block == 1 ? 'open' : 'close';
            $blocked_ip = $global_config->blocked_ip == 1 ? 'open' : 'close';
            $xss_protection = $global_config->xss_protection == 1 ? 'open' : 'close';
            $csrf_protection = $global_config->csrf_protection == 1 ? 'open' : 'close';
            $dummy_protection = $global_config->dummy_protection == 1 ? 'open' : 'close';

            $file_extension_allow = explode(',|,|,|', $block_default->file_extension);
            $file_length_max = $block_default->file_length;
            $url_length_max = $block_default->url_length;
            $body_length_max = $block_default->body_length;
            $uri_list = explode(',|,|,|', $block_default->uri_list);
            $except_extension = explode(',|,|,|', $block_default->except_extension);

            $url_content_not_allow = explode(',|,|,|', $block_diy->url_content);
            $body_content_not_allow = explode(',|,|,|', $block_diy->body_content);
            $header_content_not_allow = explode(',|,|,|', $block_diy->header_content);

            $limit_per_10_seconds_max = $delay_block->limit_per_10_seconds;
            $limit_for_block_max = $delay_block->limit_for_block;

            // 获取ip rule
            $white_ip_list = $this->ip_rule_model->get_ip_rule('white');
            $black_ip_list = $this->ip_rule_model->get_ip_rule('black');

            $page_data = array(
                'real_ip' => $real_ip,
                'real_port' => $real_port,
                'is_open' => $is_open,
                'is_debug' => $is_debug,
                'white_ip' => $white_ip,
                'black_ip' => $black_ip,
                'sqli' => $sqli,
                'file_extension' => $file_extension,
                'file_content' => $file_content,
                'file_length' => $file_length,
                'caidao' => $caidao,
                'url_length' => $url_length,
                'body_length' => $body_length,
                'whiteuri' => $whiteuri,
                'url_content' => $body_content,
                'body_content' => $body_content,
                'header_content' => $header_content,
                'limit_per_10_seconds' => $limit_per_10_seconds,
                'limit_for_block' => $limit_for_block,
                'blocked_ip' => $blocked_ip,
                'xss_protection' => $xss_protection,
                'csrf_protection' => $csrf_protection,
                'dummy_protection' => $dummy_protection,

                'white_ip_list' => $white_ip_list,
                'black_ip_list' => $black_ip_list,

                'file_extension_allow' => $file_extension_allow,
                'file_length_max' => $file_length_max,
                'url_length_max' => $url_length_max,
                'body_length_max' => $body_length_max,
                'uri_list' => $uri_list,
                'except_extension' => $except_extension,

                'url_content_not_allow' => $url_content_not_allow,
                'body_content_not_allow' => $body_content_not_allow,
                'header_content_not_allow' => $header_content_not_allow,

                'limit_per_10_seconds_max' => $limit_per_10_seconds_max,
                'limit_for_block_max' => $limit_for_block_max
            );
            $this->load->view('settings', $page_data);
        }
        else
        {
            show_error('error', 500, ' - - ');
            return;
        }
    }

    public function global_config()
    {
        if ($this->is_login() !== TRUE)
        {
            redirect('/login', 'location', 302);
            return;
        }

        $data = $this->input->post();
        if ($data != array())
        {   
            // 处理csrf
            $req_referer = $this->input->server('HTTP_REFERER');
            if ($this->is_csrf($req_referer) === TRUE)
            {
                $resp = array(
                    'status' => '1',
                    'message' => 'csrf'
                );
                echo json_encode($resp);
                return;
            }

            // 更新global config
            if ($this->global_config_model->update_global_config($data) == -1)
            {
                $resp = array(
                    'status' => '2',
                    'message' => 'update fail'
                );
                echo json_encode($resp);
                return;
            }
            else
            {
                $resp = array(
                    'status' => '0',
                    'message' => 'update success'
                );
                echo json_encode($resp);
                return;
            }
        }

        // 获取global config
        $global_config = $this->global_config_model->get_global_config();

        if ($global_config != '')
        {
            $real_ip = $global_config->real_ip;
            $real_port = $global_config->real_port;
            $is_open = $global_config->is_open == 1 ? 'open' : 'close';
            $is_debug = $global_config->is_debug == 1 ? 'open' : 'close';

            $white_ip = $global_config->white_ip == 1 ? 'open' : 'close';
            $black_ip = $global_config->black_ip == 1 ? 'open' : 'close';

            $sqli = $global_config->sqli == 1 ? 'open' : 'close';
            $file_extension = $global_config->file_extension == 1 ? 'open' : 'close';
            $file_content = $global_config->file_content == 1 ? 'open' : 'close';
            $file_length = $global_config->file_length == 1 ? 'open' : 'close';
            $caidao = $global_config->caidao == 1 ? 'open' : 'close';
            $url_length = $global_config->url_length == 1 ? 'open' : 'close';
            $body_length = $global_config->body_length == 1 ? 'open' : 'close';
            $whiteuri = $global_config->whiteuri == 1 ? 'open' : 'close';
            $url_content = $global_config->url_content == 1 ? 'open' : 'close';
            $body_content = $global_config->body_content == 1 ? 'open' : 'close';
            $header_content = $global_config->header_content == 1 ? 'open' : 'close';

            $limit_per_10_seconds = $global_config->limit_per_10_seconds == 1 ? 'open' : 'close';
            $limit_for_block = $global_config->limit_for_block == 1 ? 'open' : 'close';
            $blocked_ip = $global_config->blocked_ip == 1 ? 'open' : 'close';
            $xss_protection = $global_config->xss_protection == 1 ? 'open' : 'close';
            $csrf_protection = $global_config->csrf_protection == 1 ? 'open' : 'close';
            $dummy_protection = $global_config->dummy_protection == 1 ? 'open' : 'close';

            $page_data = array(
                'real_ip' => $real_ip,
                'real_port' => $real_port,
                'is_open' => $is_open,
                'is_debug' => $is_debug,
                'white_ip' => $white_ip,
                'black_ip' => $black_ip,
                'sqli' => $sqli,
                'file_extension' => $file_extension,
                'file_content' => $file_content,
                'file_length' => $file_length,
                'caidao' => $caidao,
                'url_length' => $url_length,
                'body_length' => $body_length,
                'whiteuri' => $whiteuri,
                'url_content' => $body_content,
                'body_content' => $body_content,
                'header_content' => $header_content,
                'limit_per_10_seconds' => $limit_per_10_seconds,
                'limit_for_block' => $limit_for_block,
                'blocked_ip' => $blocked_ip,
                'xss_protection' => $xss_protection,
                'csrf_protection' => $csrf_protection,
                'dummy_protection' => $dummy_protection
            );
            $this->load->view('global_config', $page_data);
        }
        else
        {
            show_error('error', 500, ' - - ');
            return;
        }
    }

    public function ip_rule()
    {
        if ($this->is_login() !== TRUE)
        {
            redirect('/login', 'location', 302);
            return;
        }

        $data = $this->input->post();
        if ($data != array())
        {   
            // 处理csrf
            $req_referer = $this->input->server('HTTP_REFERER');
            if ($this->is_csrf($req_referer) === TRUE)
            {
                $resp = array(
                    'status' => '1',
                    'message' => 'csrf'
                );
                echo json_encode($resp);
                return;
            }

            if (isset($data['act']) && $data['act'] == 'remove')
            {
                // 删除ip rule
                if ($this->ip_rule_model->remove_ip_rule($data['id']) == -1)
                {
                    $resp = array(
                        'status' => '2',
                        'message' => 'remove fail'
                    );
                    echo json_encode($resp);
                    return;
                }
                else
                {
                    $resp = array(
                        'status' => '0',
                        'message' => 'remove success'
                    );
                    echo json_encode($resp);
                    return;
                }
            }
            else
            {
                // 增加ip rule
                if ($this->ip_rule_model->add_ip_rule($data) == -1)
                {
                    $resp = array(
                        'status' => '2',
                        'message' => 'add fail'
                    );
                    echo json_encode($resp);
                    return;
                }
                else
                {
                    $resp = array(
                        'status' => '0',
                        'message' => 'add success'
                    );
                    echo json_encode($resp);
                    return;
                }
            }
        }

        // 获取ip rule
        $white_ip_list = $this->ip_rule_model->get_ip_rule('white');
        $black_ip_list = $this->ip_rule_model->get_ip_rule('black');

        $page_data = array(
            'white_ip_list' => $white_ip_list,
            'black_ip_list' => $black_ip_list
        );
        $this->load->view('ip_rule', $page_data);
    }

    public function block_rule()
    {
        if ($this->is_login() !== TRUE)
        {
            redirect('/login', 'location', 302);
            return;
        }

        $data = $this->input->post();
        if ($data != array())
        {   
            // 处理csrf
            $req_referer = $this->input->server('HTTP_REFERER');
            if ($this->is_csrf($req_referer) === TRUE)
            {
                $resp = array(
                    'status' => '1',
                    'message' => 'csrf'
                );
                echo json_encode($resp);
                return;
            }

            $data_2 = array();
            foreach ($data as $k => $v)
            {
                if ($k === 'type'){
                    continue;
                }
                $data_2[$k] = str_replace(PHP_EOL, ',|,|,|', $v);
                if (substr($data_2[$k], -6) === ',|,|,|')
                {
                    $data_2[$k] = substr($data_2[$k], 0, -6);
                }
            }

            if ($data['type'] === 'block_default')
            {
                // 更新block default
                if ($this->block_default_model->update_block_default($data_2) == -1)
                {
                    $resp = array(
                        'status' => '2',
                        'message' => 'update fail'
                    );
                    echo json_encode($resp);
                    return;
                }
                else
                {
                    $resp = array(
                        'status' => '0',
                        'message' => 'update success'
                    );
                    echo json_encode($resp);
                    return;
                }
            }

            if ($data['type'] === 'block_diy')
            {
                // 更新block default
                if ($this->block_diy_model->update_block_diy($data_2) == -1)
                {
                    $resp = array(
                        'status' => '2',
                        'message' => 'update fail'
                    );
                    echo json_encode($resp);
                    return;
                }
                else
                {
                    $resp = array(
                        'status' => '0',
                        'message' => 'update success'
                    );
                    echo json_encode($resp);
                    return;
                }
            }
        }

        // 获取block default
        $block_default = $this->block_default_model->get_block_default();

        // 获取block diy
        $block_diy = $this->block_diy_model->get_block_diy();

        if ($block_default != '' && $block_diy != '')
        {
            $sqli = explode(',|,|,|', $block_default->sqli);
            $file_extension = explode(',|,|,|', $block_default->file_extension);
            $file_content = explode(',|,|,|', $block_default->file_content);
            $file_length = $block_default->file_length;
            $caidao = explode(',|,|,|', $block_default->caidao);
            $url_length = $block_default->url_length;
            $body_length = $block_default->body_length;
            $uri_list = explode(',|,|,|', $block_default->uri_list);
            $except_extension = explode(',|,|,|', $block_default->except_extension);

            $url_content = explode(',|,|,|', $block_diy->url_content);
            $body_content = explode(',|,|,|', $block_diy->body_content);
            $header_content = explode(',|,|,|', $block_diy->header_content);

            $page_data = array(
                'sqli' => $sqli,
                'file_extension' => $file_extension,
                'file_content' => $file_content,
                'file_length' => $file_length,
                'caidao' => $caidao,
                'url_length' => $url_length,
                'body_length' => $body_length,
                'uri_list' => $uri_list,
                'except_extension' => $except_extension,

                'url_content' => $url_content,
                'body_content' => $body_content,
                'header_content' => $header_content
            );
            $this->load->view('block_rule', $page_data);
        }
        else
        {
            show_error('error', 500, ' - - ');
            return;
        }
    }

    public function delay_rule()
    {
        if ($this->is_login() !== TRUE)
        {
            redirect('/login', 'location', 302);
            return;
        }

        $data = $this->input->post();
        if ($data != array())
        {   
            // 处理csrf
            $req_referer = $this->input->server('HTTP_REFERER');
            if ($this->is_csrf($req_referer) === TRUE)
            {
                $resp = array(
                    'status' => '1',
                    'message' => 'csrf'
                );
                echo json_encode($resp);
                return;
            }

            // 更新delay block
            if ($this->delay_block_model->update_delay_block($data) == -1)
            {
                $resp = array(
                    'status' => '2',
                    'message' => 'update fail'
                );
                echo json_encode($resp);
                return;
            }
            else
            {
                $resp = array(
                    'status' => '0',
                    'message' => 'update success'
                );
                echo json_encode($resp);
                return;
            }
        }

        // 获取delay block
        $delay_block = $this->delay_block_model->get_delay_block();

        if ($delay_block != '')
        {
            $limit_per_10_seconds = $delay_block->limit_per_10_seconds;
            $limit_for_block = $delay_block->limit_for_block;

            $page_data = array(
                'limit_per_10_seconds' => $limit_per_10_seconds,
                'limit_for_block' => $limit_for_block
            );
            $this->load->view('delay_rule', $page_data);
        }
        else
        {
            show_error('error', 500, ' - - ');
            return;
        }
    }

    public function user_setting()
    {
        if ($this->is_login() !== TRUE)
        {
            redirect('/login', 'location', 302);
            return;
        }

        $data = $this->input->post();
        if ($data != array())
        {   
            // 处理csrf
            $req_referer = $this->input->server('HTTP_REFERER');
            if ($this->is_csrf($req_referer) === TRUE)
            {
                $resp = array(
                    'status' => '1',
                    'message' => 'csrf'
                );
                echo json_encode($resp);
                return;
            }
           
            if (isset($data['old_password']) && isset($data['new_password']) && isset($data['confirm_password']))
            {
                $username = $this->session->userdata('username');
                $old_passhash = $this->users_model->get_a_passhash($username);
                if (password_verify($data['old_password'], $old_passhash) && $data['new_password'] == $data['confirm_password'])
                {
                    if ($this->users_model->change_password($username, password_hash($data['new_password'], PASSWORD_DEFAULT)) == -1)
                    {
                        $resp = array(
                            'status' => '2',
                            'message' => 'update fail'
                        );
                        echo json_encode($resp);
                        return;
                    }
                    else
                    {
                        $resp = array(
                            'status' => '0',
                            'message' => 'update success'
                        );
                        echo json_encode($resp);
                        return;
                    }
                }
                else
                {
                    $resp = array(
                            'status' => '3',
                            'message' => 'update fail'
                        );
                    echo json_encode($resp);
                    return;
                }
            }
        }
        $this->load->view('user_setting');
    }
}
