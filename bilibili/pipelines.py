# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/en/latest/topics/item-pipeline.html
import time
import MySQLdb
from bilibili.items import Cate2Item
from bilibili.items import CateItem
from bilibili.items import TestItem
class BilibiliPipeline(object):
    def open_spider(self,spider):
        self.conn = MySQLdb.connect('127.0.0.1','root','123456','bili')
        self.cur = self.conn.cursor()
    def process_item(self, item, spider):
        play = int(item['play'] if item['play'] != '--' else 0)
        try:
            sql = "select id from videos where title = '%s' and author = '%s'" % (item['title'],item['author'])
            self.cur.execute(sql)
            is_exist = int(self.cur.fetchone()[0])
        except Exception, e:
            is_exist = 0
            print e
        if is_exist != 0 :
            sql = "update videos set play = %d,review = %d,favorites = %d where id = %d" % (play,item['review'],item['favorites'],is_exist)
        else:
            sql = "insert into videos (b_cate_id,title,play,intro,senddate,url,pic,review,author,favorites) "
            sql = sql + " values (%d,'%s',%d,'%s','%s','%s','%s',%d,'%s',%d)"
            
            sql = sql % (int(item['b_cate_id']),item['title'],play,item['intro'],item['senddate'],item['url'],item['pic'],int(item['review']),item['author'],int(item['favorites']))
        try:
            # print sql
            self.cur.execute(sql)
        except Exception, e:
            print e
        self.conn.commit()
    def close_spider(self,spider):
        pass
        self.cur.close()
        self.conn.close()

class CatePipeline(object):
    def open_spider(self,spider):
        self.conn = MySQLdb.connect('127.0.0.1','root','123456','bili')
        self.cur = self.conn.cursor()
    def process_item(self, item, spider):
        try:
            p_name = item['p_name']
            child = item['child']
        except Exception, e:
            p_name = ''
            child = {}
        try:
            self.cur.execute("insert into cate (name) values ('%s')" % p_name)
        except Exception, e:
            raise e
        
        self.conn.commit()
        pid = self.cur.lastrowid
        print "xxxxxxxxxxxxxxxxxxxxxxxxxxx"
        if pid:
            child_cates = zip(child['href'].split(','),child['name'].split(','))
            
            for href,name in child_cates:
                print href,name
                if href == '' or name == '':
                    continue
                try:
                    self.cur.execute("insert into cate (name,level,href,pid) values ('%s',2,'%s',%d)" % (name,href,pid))    
                except Exception, e:
                    print e
            self.conn.commit()
                

    def close_spider(self,spider):
        self.cur.close()
        self.conn.close()
    	   

class Cate2Pipeline(object):
    items = []
    def open_spider(self,spider):
        self.conn = MySQLdb.connect('127.0.0.1','root','123456','bili')
        self.cur = self.conn.cursor()
    def process_item(self, item, spider):
        print "zzzzzzzzzzzzzzzzzzzzzzzz"
        return
        if isinstance(item,Cate2Item):
            try:
                p_name = item['p_name']
                name = item['name']
                tid = item['tid']
            except Exception, e:
                pass

            if name in self.items or name == '全部':
                return
            else:
                self.items.append(name)

            try:
                self.cur.execute("select id from cate where name = '%s'" % p_name)
                print "select id from cate where name = '%s'" % p_name
                pid = self.cur.fetchone()[0]
                print pid
                if pid is None or pid <= 0:
                    return
            except Exception, e:
                print e

            try:
                self.cur.execute("insert into cate (name,b_cate_id,pid) values ('%s',%d,%d)" % (name,tid,pid))
            except Exception, e:
                print e
            
            self.conn.commit()
        elif isinstance(item,CateItem):
            try:
                p_name = item['p_name']
                self.cur.execute("insert into cate (name) values ('%s')" % p_name)
            except Exception, e:
                print e
            self.conn.commit()

    def close_spider(self,spider):
        self.cur.close()
        self.conn.close()
         