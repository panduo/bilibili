# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class TestItem(scrapy.Item):
    # define the fields for your item here like:
    # name = scrapy.Field()
    b_cate_id = scrapy.Field()
    title = scrapy.Field()
    play = scrapy.Field()
    intro = scrapy.Field()
    senddate = scrapy.Field()
    url = scrapy.Field()
    pic = scrapy.Field()
    review = scrapy.Field()
    author = scrapy.Field()
    favorites = scrapy.Field()

class CateItem(scrapy.Item):
    p_name = scrapy.Field()
    # pid = scrapy.Field()
    # child = scrapy.Field()


class Cate2Item(scrapy.Item):
    p_name = scrapy.Field()
    name = scrapy.Field()
    tid = scrapy.Field()
    


