"""
    __author__ = Yudie Zhang
    student number = 44048417
    __email__ = yudie.zhang@uq.net.au
    
    This is for academic use.
    
"""

import requests
from bs4 import BeautifulSoup
import re
import csv
import urllib
from selenium import webdriver
from selenium.webdriver import ActionChains
from selenium.webdriver.common.keys import Keys
from time import sleep
import pickle
import os
import json
import random

# Global Variables
PRODUCT_LIST_FILE_NAME = 'dict.csv'
product_list = None
product_list_exists = False

f_tags = open('tags.csv', 'a',newline='')
w_tags = csv.writer(f_tags)
#w_tags.writerow(['Item ID','Tags'])

f_img = open('images.csv', 'a',newline='')
w_img = csv.writer(f_img)
#w_img.writerow(['Item ID','Image Link'])

f_color = open('colors.csv', 'a',newline='')
w_color = csv.writer(f_color)
#w_color.writerow(['Item ID','Color Title','Color Option','Color Style'])

f_size = open('sizes.csv', 'a',newline='')
w_size = csv.writer(f_size)
#w_size.writerow(['Item ID','Size'])

##f_category = open('categories.csv', 'a',newline='')
##w_category = csv.writer(f_category)
###w_category.writerow(['Link','Category','p_img_1','p_img_2'])

f_info = open('item_info.csv', 'a',newline='',errors='ignore')
w_info = csv.writer(f_info)
#w_info.writerow(['n','Item ID','Link','Categories','Item Name','Price','Ori_Price','Description','Product Detail'])

f_review = open('reviews.csv', 'a',newline='')
w_review = csv.writer(f_review)
#w_review.writerow(['Review ID','Item ID','Nickname','Avatar','Rate','Review','Review Pics','Time'])

def createID(len):
    raw = ""
    range1 = range(58, 65) # between 0~9 and A~Z
    range2 = range(91, 97) # between A~Z and a~z

    i = 0
    while i < len:
        seed = random.randint(48, 122)
        if ((seed in range1) or (seed in range2)):
            continue;
        raw += chr(seed);
        i += 1
    return raw

# Use Selenium to run the target page.
class ZAFUL_Crawler():

    def __init__(self):
        self.driver = None
        self.n = 0
        self.x = 0

    def setup(self):
        self.driver = webdriver.Chrome()
        # get the last item index that has been crawled
        exists = os.path.isfile('item_info.csv')
        if exists:
            with open('item_info.csv') as f:
                reader = csv.reader(f, delimiter=',')
                for row in reversed(list(reader)):
                    self.n = int(row[0]) + 1
                    break

##    def crawl_urls(self):
##        driver = self.driver
##        
##        title = ""
##        catg_dict = {}
##        subcatg_dict = {}
##        homepage_url = "https://au.zaful.com/"
##        homepage = requests.get(homepage_url)
##        soup = BeautifulSoup(homepage.content,"html.parser")
##        soup.prettify()
##
##        # Create url&categories list.
##        nav_list = soup.find(id = 'nav-list')
##        nav_item = nav_list.find_all(class_ = 'nav-item')
##        for nav in nav_item:
##            catg_list = []
##            nav_div = nav.find(class_ = 'nav-title')
##            nav_title = nav_div.find(class_ = 'text').contents[0]
##            nav_url = nav_div.attrs['href']
##            
##            driver.get(nav_url)
##            while True:
##                p_list = driver.find_element_by_id("js_proList")
##                p_item = p_list.find_elements_by_class_name("logsss_event_ps")
##                for elem in p_item:
##                    p_link = elem.find_element_by_css_selector("div.img-hover-wrap>a").get_attribute("href")
##                    p_imgs = elem.find_element_by_class_name("img-hover-wrap").find_elements_by_tag_name('img')
##                    p_img_1 = p_imgs[0].get_attribute('data-original')
##                    try:
##                        p_img_2 = p_imgs[1].get_attribute('data-original')
##                        w_category.writerow([p_link,nav_title,p_img_1,p_img_2])
##                    except:
##                        w_category.writerow([p_link,nav_title,p_img_1,''])
##                try:
##                    next_page = driver.find_element_by_css_selector("div.page-wrap>p.listspan>a:nth-last-child(1)")
##                    if next_page.get_attribute("class") != "disabled":
##                        next_page_url = next_page.get_attribute("href")
##                        driver.get(next_page_url)
##                        continue
##                    else:
##                        break
##                except:
##                    break
##            #assert "No results found." not in driver.page_source
##            
##            menu_item = nav.find_all(class_ = 'menu-item')
##            for each in menu_item:
##                sub_item = each.find_all('a')
##                for item in sub_item:
##                    item_title = item.contents[0]
##                    try:
##                        item_url = item.attrs['href']
##                    except KeyError:
##                        item_url = None
##
##                    subcatg_dict.update({item_url:item_title})
##                            
##                    if item.attrs['class'] == ['text', 'elf-b']:
##                        if title != "":
##                            catg_dict.update({title:subcatg_list})
##                        subcatg_list = []
##                        title = item_title
##                        catg_list.append(item_title)
##                    elif item.attrs['class'] == ['text']:
##                        subcatg_list.append(item_title)
##            catg_dict.update({nav_title:catg_list})
##        catg_dict.update({title:subcatg_list})
##
##        for key in subcatg_dict:
##            subcatg = subcatg_dict[key]
##            if key != None:
##                driver.get(key)
##                while True:
##                    try:
##                        p_list = driver.find_element_by_id("js_proList")
##                        p_item = p_list.find_elements_by_class_name("logsss_event_ps")
##                        for elem in p_item:
##                            p_link = elem.find_element_by_css_selector("div.img-hover-wrap>a").get_attribute("href")
##                            p_imgs = elem.find_element_by_class_name("img-hover-wrap").find_elements_by_tag_name('img')
##                            p_img_1 = p_imgs[0].get_attribute('data-original')
##                            try:
##                                p_img_2 = p_imgs[1].get_attribute('data-original')
##                                w_category.writerow([p_link,subcatg,p_img_1,p_img_2])
##                            except:
##                                w_category.writerow([p_link,subcatg,p_img_1,''])
##                        next_page = driver.find_element_by_css_selector("div.page-wrap>p.listspan>a:nth-last-child(1)")
##                    except:
##                        break
##                    if next_page.get_attribute("class") != "disabled":
##                        next_page_url = next_page.get_attribute("href")
##                        driver.get(next_page_url)
##                        continue
##                    else:
##                        break

    def crawl_detail(self):
        item_dict = {}
        keys = []
        with open("dict.csv", "rb") as f:
            item_dict = pickle.load(f)
        product_list_length = len(item_dict)
        print(len(item_dict))

        for key in item_dict:
            keys.append(key)
        
        n = self.n
        x = self.x
        while True:
            link = keys[n]
            print("start to crawl no.", n, " url:", link)
            driver = self.driver
            driver.get(link)
            page = requests.get(link)
            soup = BeautifulSoup(page.content,"html.parser")
            soup.prettify()
            
            product_ID = createID(20)
            categories = item_dict[link]
            if categories != "":
                # Get product's tags.
                try:
                    tag_div = soup.find(id = 'js_pageRecommend')
                    result_tags = tag_div.find(class_ = 'clearfix js-related-word list-inner')
                    tag_wrap = result_tags.find_all('a')
                    for a_tag in tag_wrap:
                        tag = a_tag.contents[0]
                        w_tags.writerow([product_ID, tag])
                except:
                    if n == product_list_length - 1:
                        break
                    else:
                        n += 1
                        continue

                # Get product's images.
                img_div = soup.find(class_ = 'goods-gallery fl pr')
                imgs_thumb = img_div.find(class_ = 'img-thumb')
                imgs_li = imgs_thumb.find_all('li')
                for li in imgs_li:
                    img = li.attrs['data-source-img']
                    w_img.writerow([product_ID, img])

                # Get product's info (i.e. name,price,rate,colors,sizes).
                product_div = soup.find(class_ = 'goods-info fr pr')
                
                p_name = product_div.find(class_ = 'js-goods-title').contents[0]
                if ' - ' in p_name:
                    p_name = p_name.rsplit(' - ',1)[0]
                p_price_div = product_div.find(id = 'js-normalPrice')
                p_price = p_price_div.find(class_ = 'shop-price my_shop_price').contents[0].lstrip('AU$')
                p_ori_price = p_price_div.find(class_ = 'market-price')
                if p_ori_price != None:
                    p_ori_price = p_ori_price.find(class_ = 'my_shop_price').contents[0].lstrip('AU$')

                p_detail_div = product_div.find(class_ = 'attr-info mt10 clearfix')
                
                p_color_div = p_detail_div.find(class_ = 'attr-item mb10 clearfix js-attrItem color')
                try:
                    p_colors_wrap = p_color_div.find(class_ = 'attr-option fl pr')
                    p_colors = p_colors_wrap.find_all('p')
                    for color in p_colors:
                        color = color.find('a')
                        color_option = color.find('img')
                        color_title = color.attrs['data-titletype']
                        if color_option == None:
                            color_style = color.attrs['style']
                        else:
                            color_option = color_option.attrs['src']
                            color_style = None
                        w_color.writerow([product_ID,color_title,color_option,color_style])
                   
                    p_size_div = product_div.find(class_ = 'attr-item mb10 clearfix js-attrItem size')
                    p_sizes_wrap = p_size_div.find(class_ = 'attr-option fl pr')
                    p_sizes =  p_sizes_wrap.find_all('a')
                    for size in p_sizes:
                        size_option = size.contents[0]
                        w_size.writerow([product_ID,size_option])
                except:
                    a = 0

                p_desc_div = product_div.find(id = 'js-goodsIntro')
                p_desc_wrap = p_desc_div.find(class_ = 'content')
                p_desc = p_desc_wrap.find(class_ = 'xxkkk2')
                if p_desc != None:
                    p_desc = p_desc.contents[0]
                p_desc_dtl = p_desc_wrap.find(class_ = 'xxkkk20')
                p_desc_dtl = str(p_desc_dtl).replace('<div class="xxkkk20">','')
                p_desc_dtl = p_desc_dtl.replace('</div>','').replace('\n','')
                w_info.writerow([n,product_ID,link,categories,p_name,p_price,p_ori_price,p_desc,p_desc_dtl])

                # Get product's reviews.
                while True:
                    try:
                        review_div = driver.find_element_by_id('js-goodsReviewWrap')
                        reviews_wrap = review_div.find_elements_by_css_selector("[class='item js-reviewItem']")
                        if reviews_wrap != []:
                            num = 0
                            for review in reviews_wrap:
                                num = num + 1
                                review_ID = createID(20)
                                user_info = review.find_element_by_css_selector("[class='user fl']")
                                user = user_info.find_element_by_tag_name('dt').text.lstrip('by ').encode('utf-8')
                                avatar = user_info.find_element_by_tag_name('img').get_attribute('src')
                                review_info = review.find_element_by_css_selector("[class='review fl']")
                                rate = int(review_info.find_element_by_tag_name('i').get_attribute('style').lstrip('width: ').rstrip('%;'))/20
                                text = review_info.find_element_by_class_name('text').text.encode('utf-8')
                                time = review_info.find_element_by_class_name('time').text
                                try:
                                    img = review_info.find_element_by_class_name('js-reviewPic')
                                    img = img.find_element_by_tag_name('img').get_attribute('src')
            ##                            ActionChains(driver).click(img).perform()
            ##                            driver.switch_to_frame(driver.find_element_by_id("xubox_iframe1"))
            ##                            img_pack = driver.find_element_by_id('js-reviewImgThumb')
            ##                            imgs = img_pack.find_elements_by_tag_name('li')
            ##                            for i in imgs:
            ##                                pic = i.get_attribute("data-big-img")
            ##                                w_review.writerow([review_ID,product_ID,user,avatar,rate,text,pic,time])
            ##                            driver.switch_to_default_content()
                                except:
                                    img = None
                                w_review.writerow([review_ID,product_ID,user,avatar,rate,text,img,time])

                            try:
                                page_num = driver.find_element_by_id("js-reviewPage")
                                current = page_num.find_element_by_class_name('current').text
                                next_page = page_num.find_element_by_class_name('next')
                                ActionChains(driver).click(next_page).perform()
                                sleep(5)
                                page_num = driver.find_element_by_id("js-reviewPage")
                                next_current = page_num.find_element_by_class_name('current').text
                                if current == next_current:
                                    break
                            except:
                                break
                        else:
                            break
                    except:
                        break
            # break when no link can be crawled
            if n == product_list_length - 1:
                break
            else:
                n += 1

    # Keep presets
    def tearDown(self):
        self.driver.close()

        f_tags.close()
        f_img.close()
        f_color.close()
        f_size.close()
        #f_category.close()
        f_info.close()
        f_review.close()

if __name__ == "__main__":
    
    # check if the product_list file exists
    exists = os.path.isfile(PRODUCT_LIST_FILE_NAME)
    if exists:
        # load product_list
        f = open('dict.csv', 'rb')
        product_list = pickle.load(f)
        print("Product list is loaded")
        print("Start to crawl product details...")
        myCrawler = ZAFUL_Crawler()
        myCrawler.setup()
        myCrawler.crawl_detail()
        myCrawler.tearDown()
    else:
        item_dict = {}
        f_category = open('categories.csv', 'r')
        try:
            while True:
                text_line = f_category.readline()
                if text_line:
                    text_line = text_line.replace('\n','')
                    text_line = text_line.replace('  ','')
                    parts = text_line.split(',')
                    if len(parts)==3:
                        url = parts[0]
                        catg = parts[1]
                        img_1 = parts[2]
                        img_2 = ""
                    elif len(parts)==4:
                        url = parts[0]
                        catg = parts[1]
                        img_1 = parts[2]
                        img_2 = parts[3]
                        if url in item_dict:
                            item_list = item_dict[url]
                            if catg not in item_list:
                                item_list.append(catg)
                                item_dict[url] = item_list
                        else:
                            item_list = []
                            item_list.append(catg)
                            item_dict[url] = item_list
                else:
                    break
        finally:
            with open("dict.csv", "wb") as f:
                pickle.dump(item_dict, f)

        print(len(item_dict))

##    # Loading product list ends here
##    print("Start to crawl product details...")
##    myCrawler = ZAFUL_Crawler()
##    myCrawler.setup()
##    #myCrawler.crawl_detail()
##    myCrawler.tearDown()
