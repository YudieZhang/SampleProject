import pandas as pd
import matplotlib.pyplot as plt

df=pd.read_csv("final_1.csv",encoding='GB2312')
names=df["catg"].value_counts()
plt.rcParams['figure.figsize']=(60.0,4.0)
plt.rcParams['figure.dpi']=200

font={
   'family':'SimHei',
   'weight':'bold',
   'size':'15'
}
plt.rc('font',**font)
plt.bar(names.index[0:15],names.values[0:15],fc='b')
