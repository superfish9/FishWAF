#coding=utf-8

from lib.utils.db import Mysql
import config.db_config as conf

class Getconf(object):
    '''
    从数据库中获取WAF配置.
    '''
    def __init__(self):
        self.mysql = Mysql(conf.db_host, conf.db_port, conf.db_user, conf.db_pass, conf.db_name)

    def get_global_config(self, column):
        statement = 'select ' + column + ' from global_config'
        result = self.mysql.execute(statement)
        return result[0][0]

    def get_ip_rule(self, rule_type, target_ip):
        statement = 'select path from ip_rule where type=%s and ip=%s'
        arguments = (rule_type, target_ip)
        result = self.mysql.execute(statement, arguments)

        path_list = []
        for i in result:
            path_list.append(i[0])
        return path_list

    def get_block_default(self, column):
        statement = 'select ' + column + ' from block_default'
        result = self.mysql.execute(statement)
        return result[0][0].split(conf.rule_sep)

    def get_block_diy(self, column):
        statement = 'select ' + column + ' from block_diy'
        result = self.mysql.execute(statement)
        return result[0][0].split(conf.rule_sep)

    def get_delay_block(self, column):
        statement = 'select ' + column + ' from delay_block'
        result = self.mysql.execute(statement)
        return result[0][0].split(conf.rule_sep)

    def get_blocked_ip_by_delay_rule(self):
        statement = 'select ip from blocked_ip_by_delay_rule'
        result = self.mysql.execute(statement)

        ip_list = []
        for i in result:
            ip_list.append(i[0])
        return ip_list



