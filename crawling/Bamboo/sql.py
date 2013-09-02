#!/usr/bin/env python
# -*- coding: utf-8 -*-

from bs4 import BeautifulSoup

def getObjects(path):
	f = open(path)
	R = f.read()
	f.close()

	#We have R with contents of the XML

	BS = BeautifulSoup(R)
	id = 0
	dic = {}
	ids = {}
	for E in BS.find_all("element"):
		id += 1 
		ids[id] = {}
		for T in E.find_all(True):
		
			if T.name in dic:
				if T.name not in ids[id]:
					ids[id][T.name] = set()

				if T.string in dic[T.name]:
					#print dic[T.name][T.string]
					ids[id][T.name].add(dic[T.name][T.string])
					
				else:
					#print dic[T.name][T.string]
					dic[T.name][T.string] = len(dic[T.name]) + 1
					ids[id][T.name].add(dic[T.name][T.string])
					
			else:
			
				dic[T.name] = { T.string : 1}
				ids[id][T.name] = set()
				ids[id][T.name].add(1)
				

	#print dic
	return dic, ids
	
dic, ids = getObjects("./output/bamboodirt.xml")

#This synonym Table is used for external/relative entries such as keywords or platform (Tool > has_XYZ > XIZ)
table = {"tags" : "Keyword", "developer" : "Developer", "platform" : "Platform"}
#status,description,license,tags,webpage,costbracket,name,platform,cost,dependson,page,categories,developer}

for T in dic:
	if T in table:
	
		print T;