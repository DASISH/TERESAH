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
	rev = {}
	ids = {}
	for E in BS.find_all("element"):
		id += 1 
		ids[id] = {}
		for T in E.find_all(True):
		
			if T.name in dic:
				if T.name not in ids[id]:
					ids[id][T.name] = list()

				if T.string in dic[T.name]:
					#print dic[T.name][T.string]
					ids[id][T.name].append(dic[T.name][T.string])
					
				else:
					#print dic[T.name][T.string]
					i = len(dic[T.name]) + 1
					dic[T.name][T.string] = i
					rev[T.name][i] = T.string
					ids[id][T.name].append(dic[T.name][T.string])
					
			else:
			
				dic[T.name] = { T.string : 1}
				rev[T.name] = { 1 : T.string }
				ids[id][T.name] = list()
				ids[id][T.name].append(1)
				

	#print dic
	return dic, ids, rev
	
dic, ids, rev = getObjects("./output/bamboodirt.xml")

#This synonym Table is used for external/relative entries such as keywords or platform (Tool > has_XYZ > XIZ)
tableNID = {"tags" : "Keyword", "platform" : "Platform", "categories" : "Tool_type"} # Without int UID stuff
tableWID = {"developer" : "Developer"} #With int UID Stuff
#status,description,license,tags,webpage,costbracket,name,platform,cost,dependson,page,categories,developer
#status,description,license,tags,webpage,costbracket,name,platform,cost,dependson,page,categories,developer

for T in dic:
	if T in tableNID:
		for E in dic[T]:
			print "INSERT INTO " + tableNID[T] + " VALUES ('" + E + "');"
	elif T in tableWID:
		for E in dic[T]:
			#print dic[T]
			print "INSERT INTO " + tableWID[T] + " VALUES ('" + str(dic[T][E]) + "', '" + E + "');"
	else:
		pass
		#print T;

for E in ids:
	print "INSERT INTO Tool VALUES ("+str(E)+", '"+ rev["name"][ids[E]["name"][0]] +"')"
	s = "INSERT INTO Description VALUES ('', '"+ rev["name"][ids[E]["name"][0]] +"', "
	
	if "description" in ids[E] and ids[E]["description"][0] in rev["description"]:
		print ids[E]["description"][0]
	
		s += " '"+ str(rev["description"][ids[E]["description"][0]]) +"', "
	else:
		s += " '', "
	
	#No version in BambooDirt
	s += " '', "
	
	
	if "webpage" in ids[E]:
		s += " '"+ rev["webpage"][ids[E]["webpage"][0]] +"', "
	else:
		s += " '', "
		
	#No availableFrom in BambooDirt
	s += " '', "
	s += " 'DATE', 'USER_UID', 'author',  "
	
	if "license" in ids[E]:
		s += " '"+ rev["license"][ids[E]["license"][0]] +"', "
	else:
		s += " '', "
		
	if "categories" in ids[E]:
		s += " '"+ rev["categories"][ids[E]["categories"][0]] +"', "
	else:
		s += " '', "
		
	#No Application_type in BambooDirt
	s += " '', "
	
	#TOOL UID +  USERS_UID
	print E
	s += str(E) + ", 'USER_UID' "
		
	print s+");"