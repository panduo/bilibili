#coding=utf8
import scrapy
from bs4 import BeautifulSoup
from bilibili.items import CateItem
from bilibili.items import Cate2Item

class Cate2Spider(scrapy.Spider):
    count = 0
    name = "cate2"
    
    # allowed_domains = ["www.bilibili.com/"]
    start_urls = [
        # "http://www.bilibili.com/Computers/Programming/Languages/Python/Books/",
        # "https://space.bilibili.com/16902659/#!/",
        # "https://www.bilibili.com/video/ent_funny_2.html#!page=1&range=2017-06-16%2C2017-06-23&order=hot",
        # "https://www.douban.com/doulist/1264675/",
        # "http://www.bilibili.com/Computers/Programming/Languages/Python/Resources/"
        "https://www.bilibili.com/video/life.html"
    ]

    def parse(self, response):
        count = 0
        tmp = {'name':'','href':''}
        for sel in response.xpath('//div[@class="menu-wrapper"]/ul/li'):
            count = count + 1
            if count > 13:
                break
            item = CateItem()
            p_name = sel.xpath('a[1]/em/text()').extract()[0]
            # pid = 0
            # item['pid'] = pid
            item['p_name'] = p_name
            yield item


            for child in sel.xpath('ul[1]/li'):
                if child.xpath('a[1]/b/text()').extract()[0] is None:
                    continue
                # tmp['name'] = tmp['name']+','+child.xpath('a[1]/b/text()').extract()[0]
                # tmp['href'] = tmp['href']+','+child.xpath('a[1]/@href').extract()[0]
            # item['child'] = tmp   
                next = "http:"+child.xpath('a[1]/@href').extract()[0]
                yield scrapy.http.Request(next,callback=lambda response, p_name=p_name: self.parse2(response,p_name))
            

        # child_cates = zip(tmp['href'].split(','),tmp['name'].split(','))
        
        # for href,name in child_cates:
        #     if href == '':
        #         continue
        #     self.p_name = p_name
        #     next = "http:"+href
        #     yield scrapy.http.Request(next,callback=self.parse2)

    def parse2(self,response,p_name):
        # print response.xpath('//div[@class="main-inner"]/ul/li').extract()[0]
        # print response.body
        html = BeautifulSoup(response.body,'html.parser')    
        main = html.select('ul.n_num')

        print len(main)
        if main is None or len(main) == 0:
            return
        main = main[0].select('li')
        # print main
        # print "zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz"
        for sel in main:
            try:
                item = Cate2Item()
                item['p_name'] = p_name.strip()

                item['name'] = sel.find('a').get_text()
                item['tid'] = int(sel.get('tid'))
            except Exception, e:
                return

            yield item



