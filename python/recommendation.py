import MySQLdb
import numpy as np
import math

mydb = MySQLdb.connect(
  host="localhost",
  user="root",
  passwd="",
  db="fashiondb"
)
mycursor = mydb.cursor()
num = 0

sql_selected = "SELECT * FROM vec limit 1000"
mycursor.execute(sql_selected)
selected_result = mycursor.fetchall()

sql_vec = "SELECT * FROM vec limit 1000"
mycursor.execute(sql_vec)
result = mycursor.fetchall()

for s_product in selected_result:
    if num>=900 and num<1000:
        i = 0
        sum_product = 0
        sum_weight = 0
        sum_key = 0
        vec_list = []
        selected_list = []
        result_ranking = []
        dict_rank = {}
    
        selected = s_product[1].replace("[","").replace("]","").replace("\n","")
        selected = selected.split(" ")
        for each in selected:
            if each == "":
                each = 0
            selected_list.append(float(each))
                
        for vector in result:
            vec = vector[1].replace("[","").replace("]","").replace("\n","")
            vec = vec.split(" ")
            for each in vec:
                if each == "":
                    each = 0
                vec_list.append(float(each))
                
            product = [vec_list * selected_list for vec_list, selected_list in zip(vec_list, selected_list)]
            for each in product:
                sum_product += each
            for term_w in vec_list:
                sum_weight += pow(term_w,2)
            for key_w in selected_list:
                sum_key += pow(key_w,2)
            denominator = pow(sum_weight,0.5)*pow(sum_key,0.5)
            if sum_product != 0:
                cosine = sum_product/denominator
                dict_rank.update({vector[0]:cosine})
                
        zip_rank = zip(dict_rank.values(),dict_rank.keys())
        for each in zip_rank:
            result_ranking.append(each)
        top_result_ranking = sorted(result_ranking, reverse = True)[0:8]
        for item in top_result_ranking:
            sql_result = "INSERT INTO recommendations (productID,recommendationID,similarity) VALUES (%s,%s,%s)"
            val = (s_product[0],item[1],item[0])
            mycursor.execute(sql_result, val)
            mydb.commit()
        num = num + 1
        print("Finished calculation No."+str(num))
    else:
        num = num + 1
mycursor.close()
mydb.close()
