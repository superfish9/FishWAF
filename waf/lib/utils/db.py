#coding=utf-8

import MySQLdb

class Mysql(object):
    '''
    Mysql数据库操作.
    '''
    def __init__(self, host='127.0.0.1', port=3306, user='', passwd='', name=''):
        self.host = host
        self.port = port
        self.user = user
        self.passwd = passwd
        self.name = name
        self.conn = MySQLdb.connect(host=self.host, port=self.port, user=self.user, passwd=self.passwd, db=self.name)
        self.cur = self.conn.cursor()

    def execute(self, statement, arguments=None):
        while True:
            try:
                if arguments:
                    self.cur.execute(statement, arguments)
                else:
                    self.cur.execute(statement)
                self.conn.commit()
            except:
                self.conn.rollback()
                raise
            else:
                break

        if statement.lstrip().upper().startswith("SELECT"):
            return self.cur.fetchall()

    def __del__(self):
        if self.cur:
            self.cur.close()
            
        if self.conn:
            self.conn.close()



