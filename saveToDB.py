import csv
import mysql.connector
import random

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

class dbInsert():
    
    def __init__(self):
        self.mycursor = None

    def setup(self):
        mydb = mysql.connector.connect(
          host="localhost",
          user="root",
          passwd="",
          database="fashiondb"
        )
        self.mycursor = mydb.cursor()

    def execute(self):
        #mycursor = self.mycursor
        sql_products = "INSERT INTO products (productID,productName,categories,price,ori_price,img_first,img_after,description,p_details) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s)"
        sql_images = "INSERT INTO images (productID,imUrl) VALUES (%s,%s)"
        sql_colors = "INSERT INTO colors (productID,color_title,color_option,color_style) VALUES (%s,%s,%s,%s)"
        sql_sizes = "INSERT INTO sizes (productID,size) VALUES (%s,%s)"
        sql_reviews = "INSERT INTO reviews (reviewID,productID,reviewerID,nickname,avatar,rate,reviewText,reviewPics,time) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s)"
        sql_tags = "INSERT INTO tags (productID,tags) VALUES (%s,%s)"

        mydb = mysql.connector.connect(
          host="localhost",
          user="root",
          passwd="",
          database="fashiondb"
        )
        mycursor = mydb.cursor()

        # Save to table products.
##        with open('item_info.csv')as f_info:
##            reader_info = csv.reader(f_info)
##            for parts in reader_info:
##                if len(parts) == 9:
##                    num = parts[0]
##                    ID = parts[1]
##                    url = parts[2]
##                    catg = parts[3]
##                    p_name = parts[4]
##                    
##                    if "SD" in parts[5]:
##                        price = parts[5].replace('SD','')
##                    elif "CAD" in parts[5]:
##                        price = parts[5].replace('CAD','')
##                    elif "GBP" in parts[5]:
##                        price = parts[5].replace('GBP','')
##                    elif "D" in parts[5]:
##                        price = parts[5].replace('D','')
##                    else:
##                        price = parts[5]
##
##                    if "CA$" in parts[6]:
##                        ori_price = parts[6].replace('CA$','')
##                    elif "$" in parts[6]:
##                        ori_price = parts[6].replace('$','')
##                    else:
##                        ori_price = parts[6]
##                    desc = parts[7]
##                    p_details = parts[8]
##                else:
##                    print("Info Error: "+str(len(parts)))
##
##                with open('categories.csv')as f_catg:
##                    reader_catg = csv.reader(f_catg)
##                    for items in reader_catg:
##                        if len(items) == 4:
##                            link = items[0]
##                            img_1 = items[2]
##                            img_2 = items[3]
##                        else:
##                            print("Image Error")
##                        if link == url:
##                            #print(str(ID+", "+p_name+", "+catg+", "+price+", "+ori_price+", "+img_1+", "+img_2+", "+desc+", "+p_details+"\n"))
##                            if ori_price != "":
##                                val = (ID,p_name,catg,float(price),float(ori_price),img_1,img_2,desc,p_details)
##                            else:
##                                val = (ID,p_name,catg,float(price),"",img_1,img_2,desc,p_details)
##                            
##                            mycursor.execute(sql_products, val)
##                            mydb.commit()
##                            break

        # Save to table images.
##        with open('images.csv')as f_img:
##            reader_img = csv.reader(f_img)
##            for parts in reader_img:
##                if len(parts) == 2:
##                    ID = parts[0]
##                    imUrl = parts[1]
##                    val = (ID,imUrl)
##                    mycursor.execute(sql_images, val)
##                    mydb.commit()
##                else:
##                    print("Image Error: "+str(len(parts)))

        # Save to table colors.
        with open('colors.csv')as f_color:
            reader_color = csv.reader(f_color)
            for parts in reader_color:
                if len(parts) == 4:
                    ID = parts[0]
                    title = parts[1]
                    option = parts[2]
                    style = parts[3]
                    val = (ID,title,option,style)
                    mycursor.execute(sql_colors, val)
                    mydb.commit()
                else:
                    print(str(parts))
                    print("Color Error: "+str(len(parts)))

        # Save to table sizes.
        with open('sizes.csv')as f_size:
            reader_size = csv.reader(f_size)
            for parts in reader_size:
                if len(parts) == 2:
                    ID = parts[0]
                    size = parts[1]
                    val = (ID,size)
                    mycursor.execute(sql_sizes, val)
                    mydb.commit()
                else:
                    print("Size Error: "+str(len(parts)))

        # Save to table reviews.
        with open('reviews.csv')as f_review:
            reader_review = csv.reader(f_review)
            for parts in reader_review:
                if len(parts) == 8:
                    reviewID = parts[0]
                    productID = parts[1]
                    reviewerID = createID(20)
                    if "b'" in parts[2]:
                        nickname = parts[2].replace("b'","")
                    else:
                        nickname = parts[2]
                    if "'" in nickname:
                        nickname = nickname.replace("'","")
                    avatar = parts[3]
                    rate = parts[4]
                    if "b'" in parts[5]:
                        review = parts[5].replace("b'","")
                    else:
                        review = parts[5]
                    if "'" in review:
                        review = review.replace("'","")
                    r_pics = parts[6]
                    time = parts[7]
                    val = (reviewID,productID,reviewerID,nickname,avatar,rate,review,r_pics,time)
                    mycursor.execute(sql_reviews, val)
                    mydb.commit()
                else:
                    print("Review Error: "+str(len(parts)))

        # Save to table tags.
        with open('tags.csv')as f_tags:
            reader_tags = csv.reader(f_tags)
            for parts in reader_tags:
                if len(parts) == 2:
                    productID = parts[0]
                    tag = parts[1]
                    val = (productID,tag)
                    mycursor.execute(sql_tags, val)
                    mydb.commit()
                else:
                    print("Tag Error: "+str(len(parts)))

if __name__ == "__main__":
    db = dbInsert()
    db.setup()
    db.execute()
    
