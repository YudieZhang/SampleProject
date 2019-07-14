import MySQLdb
import numpy as np
import torch
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

sql_products = "SELECT productID,productName,categories,description,p_details FROM products"
mycursor.execute(sql_products)
result = mycursor.fetchall()

num = 0
for each in result:
    # Tokenized input
    catg = each[2].replace("[","").replace("]","").replace("'","").replace(",","")
    desc = each[3].replace("<b>","").replace("</b>","").replace("\n","").replace("<br/>","")
    p_details = each[4].replace("<br/>","").replace("<strong>","").replace("</strong>","")
    
    text = "[CLS] "+each[1]+" [SEP]"
    tokenized_text = tokenizer.tokenize(text)
    len_token = len(tokenized_text)
    segments_ids = []
    while len_token>0:
        # Define sentences indices associated to different sentences
        segments_ids.append(0)
        len_token = len_token-1
    if catg != "":
        text = catg+" [SEP]"
        tokens = tokenizer.tokenize(text)
        for item in tokens:
            tokenized_text.append(item)
        len_token = len(tokens)
        while len_token>0:
            segments_ids.append(1)
            len_token = len_token-1
    if desc != "":
        text = desc+" [SEP]"
        tokens = tokenizer.tokenize(text)
        for item in tokens:
            tokenized_text.append(item)
        len_token = len(tokens)
        while len_token>0:
            segments_ids.append(0)
            len_token = len_token-1
    if desc != "" and p_details != "":
        text = p_details+" [SEP]"
        tokens = tokenizer.tokenize(text)
        for item in tokens:
            tokenized_text.append(item)
        len_token = len(tokens)
        while len_token>0:
            segments_ids.append(1)
            len_token = len_token-1
    elif desc == "" and p_details != "":
        text = p_details+" [SEP]"
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
    
    sql_vec = "INSERT INTO vec (productID,product_vec) VALUES (%s,%s)"
    val = (each[0],encoded.view(-1).numpy())
    mycursor.execute(sql_vec, val)
    mydb.commit()
    num = num+1
    print("entered "+str(num))
mycursor.close()
mydb.close()
