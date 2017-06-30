#coding=utf8
import scrapy

from bilibili.items import CateItem

class CateSpider(scrapy.Spider):
    count = 0
    name = "cate"
    
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
    	for sel in response.xpath('//div[@class="menu-wrapper"]/ul/li'):
            count = count + 1
            if count > 13:
                break
            item = CateItem()
            p_name = sel.xpath('a[1]/em/text()').extract()[0]
            pid = 0
            item['pid'] = pid
            item['p_name'] = p_name
            tmp = {'name':'','href':''}
            for child in sel.xpath('ul[1]/li'):
                if child.xpath('a[1]/b/text()').extract()[0] is None:
                    continue
                tmp['name'] = tmp['name']+','+child.xpath('a[1]/b/text()').extract()[0]
                tmp['href'] = tmp['href']+','+child.xpath('a[1]/@href').extract()[0]
            item['child'] = tmp    
            yield item
        # yield scrapy.http.Request(next,callback=self.parse)