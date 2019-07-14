import MySQLdb
import numpy as np
import math
import torch
import sys
from pytorch_pretrained_bert import BertTokenizer, BertModel, BertForMaskedLM
#
## OPTIONAL: if you want to have more information on what's happening, activate the logger as follows
#import logging
#logging.basicConfig(level=logging.INFO)

# Load pre-trained model tokenizer (vocabulary)
tokenizer = BertTokenizer.from_pretrained('bert-base-uncased')

mydb = MySQLdb.connect(
  host="localhost",
  user="root",
  passwd="",
  db="fashiondb"
)
mycursor = mydb.cursor()
num = 0
sql_clear = "DELETE FROM result"
mycursor.execute(sql_clear)
mydb.commit()

params = sys.argv[1:]

for each in params:
    if num == 0:
        text = "[CLS] "+each+" [SEP]"
        num = num + 1
        
        tokenized_text = tokenizer.tokenize(text)
        len_token = len(tokenized_text)
        segments_ids = []
        while len_token>0:
            # Define sentences indices associated to different sentences
            segments_ids.append(0)
            len_token = len_token-1
            
    elif num%2 != 0:
        text = each+" [SEP]"
        num = num + 1
        
        tokens = tokenizer.tokenize(text)
        for item in tokens:
            tokenized_text.append(item)
        len_token = len(tokens)
        while len_token>0:
            segments_ids.append(1)
            len_token = len_token-1
            
    elif num%2 == 0:
        text = each+" [SEP]"
        num = num + 1
        
        tokens = tokenizer.tokenize(text)
        for item in tokens:
            tokenized_text.append(item)
        len_token = len(tokens)
        while len_token>0:
            segments_ids.append(0)
            len_token = len_token-1
    
# Convert token to vocabulary indices
indexed_tokens = tokenizer.convert_tokens_to_ids(tokenized_text)
#print(str(len(tokenized_text))+","+str(len(segments_ids)))

# Convert inputs to PyTorch tensors
tokens_tensor = torch.tensor([indexed_tokens])
segments_tensors = torch.tensor([segments_ids])

# Load pre-trained model (weights)
model = BertModel.from_pretrained('bert-base-uncased')
model.eval()

# Predict hidden states features for each layer
with torch.no_grad():
    encoded_layers, _ = model(tokens_tensor, segments_tensors)
    encoded = encoded_layers[11].view(-1,768)
    encoded = torch.mean(encoded, 0, True)
    #print(segments_tensors.view(-1).numpy())
    
    kw_vec = str(encoded.view(-1).numpy())

sql_vec = "SELECT * FROM vec limit 1000"
mycursor.execute(sql_vec)
result = mycursor.fetchall()

i = 0
sum_product = 0
sum_weight = 0
sum_key = 0
vec_list = []
selected_list = []
result_ranking = []
dict_rank = {}

selected = kw_vec.replace("[","").replace("]","").replace("\n","")
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

uploaded = 0        
zip_rank = zip(dict_rank.values(),dict_rank.keys())
for each in zip_rank:
    result_ranking.append(each)
top_result_ranking = sorted(result_ranking, reverse = True)
for item in top_result_ranking:
    if item[0]>0.0025:
        sql_result = "INSERT INTO result (productID,similarity) VALUES (%s,%s)"
        val = (item[1],item[0])
        mycursor.execute(sql_result, val)
        mydb.commit()
        uploaded = 1
if uploaded != 1:
    count = 0
    for item in top_result_ranking:
        count = count + 1
        if count>66 and count<=82 and item[1]!="UEZmgl1WEgBaytNLdnAh" and item[1]!="TmFKR2rt6RTI2clg77F9":
            sql_result = "INSERT INTO result (productID,similarity) VALUES (%s,%s)"
            val = (item[1],item[0])
            mycursor.execute(sql_result, val)
            mydb.commit()
mycursor.close()
mydb.close()
            
