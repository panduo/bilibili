# -*- coding: utf-8 -*-
import scrapy

from bilibili.items import TestItem
import json
from time import strftime, localtime,gmtime
import calendar
import MySQLdb

class Mon():
    def getmon(self,mon,year):
        year = year if year != -1 else strftime("%Y", localtime())
        if mon != -1:
            if mon == 0:
                year = str(int(year)-1)
                mon = 12
            mon = "0%d" % mon if int(mon) < 10 else str(mon)
        else:
            mon = strftime("%m", localtime())
        tmpmon = int(mon)
        day = strftime("%d", localtime())        
        if tmpmon <= 2:
            twomonb = tmpmon + 10
            from_year = str(int(year)-1)
        else:
            twomonb = tmpmon - 2
            from_year = year
        twomonb = "0" + str(twomonb) if (twomonb)<10 else str(twomonb)
        fromdate = from_year + twomonb + '01'
        days = calendar.monthrange(int(year), tmpmon)[1]
             
        to = year + mon + str(days)
        mon = int(twomonb) - 1

        return fromdate,to,mon,from_year

class TestSpider(scrapy.Spider):
    count = 0
    name = "test"
    mon_cls = Mon()
    fromdate,to,mon,year = mon_cls.getmon(-1,-1)
    init_fromdate = fromdate
    init_to = to
    init_year = year
    init_mon = mon
    # allowed_domains = ["www.bilibili.com/"]
    conn = MySQLdb.connect('127.0.0.1','root','123456','bili')
    cur = conn.cursor()
    # cur.execute("select b_cate_id from bili_cate where b_cate_id is not NULL")
    cur.execute("select b_cate_id from bili_cate where b_cate_id in (145,146,147,83)")
    cates = cur.fetchall()
    now_cate_index = 0
    from_cate = cates[now_cate_index][0]
    start_urls = [
        "https://s.search.bilibili.com/cate/search?main_ver=v3&search_type=video&view_type=hot_rank&pic_size=160x100&order=click&copy_right=-1&cate_id=%d&page=1&pagesize=20&time_from=%s&time_to=%s" % (from_cate,fromdate,to)
    ]
    def parse(self, response):
        jdict = json.loads(response.body)
        jresult = jdict['result']
        page = int(jdict['page'])
        if 'b_cate_index' not in response.meta:
            b_cate_index = self.now_cate_index
        else:
            b_cate_index = response.meta['b_cate_index']
        b_cate_id = self.cates[b_cate_index][0]
        for sel in jresult:
            item = TestItem()
            item['b_cate_id'] = b_cate_id
            item['title'] = sel['title']
            item['play'] = sel['play']
            item['intro'] = sel['description']
            item['senddate'] = sel['pubdate']
            item['url'] = sel['arcurl']
            item['pic'] = sel['pic']
            item['review'] = sel['review']
            item['author'] = sel['author']
            item['favorites'] = sel['favorites']
            yield item

        if self.count >= 140:
            self.count = 20
            page = 1
            mon_cls = Mon()
            fromdate,to,mon,year = mon_cls.getmon(self.mon,self.year)
            self.fromdate = fromdate
            self.to = to
            self.mon = mon
            self.year = year
        else:
            page = page + 1
            self.count = self.count + 20
            fromdate = self.fromdate
            to = self.to
            year = self.year
        next = "https://s.search.bilibili.com/cate/search?main_ver=v3&search_type=video&view_type=hot_rank&pic_size=160x100&order=click&copy_right=-1&cate_id=%d&page=%d&pagesize=20&time_from=%s&time_to=%s" % (b_cate_id,page,fromdate,to)
        if int(year) >= 2010:
            yield scrapy.http.Request(next,meta={'b_cate_index':b_cate_index},callback=self.parse)
        else:
            self.year = self.init_year
            self.mon = self.init_mon
            self.fromdate = self.init_fromdate
            self.to = self.init_to
            self.now_cate_index = self.now_cate_index + 1
            next = "https://s.search.bilibili.com/cate/search?main_ver=v3&search_type=video&view_type=hot_rank&pic_size=160x100&order=click&copy_right=-1&cate_id=%d&page=%d&pagesize=20&time_from=%s&time_to=%s" % (b_cate_id,page,self.init_fromdate,self.init_to)
            yield scrapy.http.Request(next,meta={'b_cate_index':b_cate_index+1},callback=self.parse)
    

