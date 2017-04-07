#coding=utf-8

import logging
import os.path

class Log(object):
    '''
    日志操作.
    '''
    def __init__(self, filename, level):
        self.filename = filename
        self.level = level

        if self.level == 0:
            self.level = logging.NOTSE
        elif self.level == 1:
            self.level = logging.DEBUG 
        elif self.level == 2:
            self.level = logging.INFO
        elif self.level == 3:
            self.level = logging.WARNING
        elif self.level == 4:
            self.level = logging.ERROR
        else:
            self.level = logging.CRITICAL

        self.logger = logging.getLogger(os.path.basename(self.filename) + '_logger')
        self.logger.setLevel(self.level)

        self.fh = logging.FileHandler(self.filename)
        self.fh.setLevel(self.level)

        self.ch = logging.StreamHandler()
        self.ch.setLevel(self.level)

        self.formatter = logging.Formatter('[%(levelname)s] %(asctime)s %(message)s')
        self.fh.setFormatter(self.formatter)
        self.ch.setFormatter(self.formatter)

        self.logger.addHandler(self.fh)
        self.logger.addHandler(self.ch)

    def debug(self, msg):
        self.logger.debug(msg)

    def info(self, msg):
        self.logger.info(msg)

    def warning(self, msg):
        self.logger.warning(msg)

    def error(self, msg):
        self.logger.error(msg)

    def critical(self, msg):
        self.logger.critical(msg)


