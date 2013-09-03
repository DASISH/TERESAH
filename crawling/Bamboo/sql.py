#!/usr/bin/env python
# -*- coding: utf-8 -*-

from bs4 import BeautifulSoup
import io
def getObjects(path):
	f = io.open(path, "rt", encoding='utf-8')
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

#This function dumps our dictionnary into json to check their usability
def checkWrite(dic, ids, rev):
	import json
	
	f = open("./tests/dic", "wt")
	f.write(json.dumps(dic))
	f.close()
	
	f = open("./tests/rev", "wt")
	f.write(json.dumps(rev))
	f.close()
	
	f = open("./tests/ids", "wt")
	f.write(json.dumps(ids))
	f.close()
	
checkWrite(dic, ids, rev)

def prs(str):
	if not str is None:
		if "'" in str:
			str = str.replace("'", "\\'")
		return str
	else:
		return u""

def sqlify(dic, ids, rev):
	#This synonym Table is used for external/relative entries such as keywords or platform (Tool > has_XYZ > XIZ)
	tableNID = {"tags" : "Keyword", "platform" : "Platform", "categories" : "Tool_type"} # Without int UID stuff
	tableWID = {"developer" : "Developer"} #With int UID Stuff
	#status,description,license,tags,webpage,costbracket,name,platform,cost,dependson,page,categories,developer
	#status,description,license,tags,webpage,costbracket,name,platform,cost,dependson,page,categories,developer
	
	NID = list()
	WID = list()
	connect = list()
	licence = list()
	
	for T in dic:
		if T in tableNID:
			for E in dic[T]:
				NID.append("INSERT IGNORE INTO " + tableNID[T] + " VALUES ('" + prs(E) + "');")
		elif T in tableWID: 
			for E in dic[T]:
				#print dic[T]
				if T == "developer":
					WID.append("INSERT IGNORE INTO " + tableWID[T] + " VALUES ('" + str(dic[T][E]) + "', '" + prs(E) + "', '');")
				else:
					WID.append("INSERT IGNORE INTO " + tableWID[T] + " VALUES ('" + str(dic[T][E]) + "', '" + prs(E) + "');")
		elif T == "license":
			for E in dic[T]:
				licence.append("INSERT IGNORE INTO Licence VALUES ('" + str(dic[T][E]) + "', '" + prs(E) + "', 1 , 'NOBUG');")
		else:
			pass
			#print T;
	
	
	ins = list()
	tool = list()
	for E in ids:
		name = prs(rev["name"][ids[E]["name"][0]])
		tool.append("INSERT IGNORE INTO Tool VALUES ('"+str(E)+"', '"+ name[:80] +"');")
		s = u"INSERT IGNORE  INTO Description VALUES ('', '"+ prs(rev["name"][ids[E]["name"][0]]) +"', "
		
		if "description" in ids[E] and ids[E]["description"][0] in rev["description"]:
		
			desc = prs(rev["description"][ids[E]["description"][0]])
			s += " '"
			s += desc 
			s += "', "
		else:
			s += " '', "
		
		#No version in BambooDirt
		s += " '', "
		
		
		if "webpage" in ids[E]:
			s += " '"+ prs(rev["webpage"][ids[E]["webpage"][0]]) +"', "
		else:
			s += " '', "
			
		#No availableFrom in BambooDirt
		s += " CURDATE(), "
		s += " CURDATE(), 1, 1,  "
		
		if "license" in ids[E]:
			s += " '"+ str(ids[E]["license"][0]) +"', "
		else:
			s += " NULL, "
			
		if "categories" in ids[E]:
			s += " '"+ prs(rev["categories"][ids[E]["categories"][0]]) +"', "
		else:
			s += " NULL, "
			
		#No Application_type in BambooDirt
		s += " 'Harvested', "
		
		#TOOL UID +  USERS_UID
		s += str(E) + ", 1 "
			
		ins.append(s+");")
	
		if "developer" in ids[E]:
			for dev in ids[E]["developer"]:
				connect.append("INSERT IGNORE INTO Tool_has_Developer VALUES ("+str(E)+", "+str(dev)+");")
				
		#tableNID = {"tags" : "Keyword", "platform" : "Platform", "categories" : "Tool_type"} # Without int UID stuff
		if "platform" in ids[E]:
			for dev in ids[E]["platform"]:
				connect.append("INSERT IGNORE INTO Tool_has_Platform VALUES ("+str(E)+", '"+prs(rev["platform"][dev])+"');")
		if "tags" in ids[E]:
			for dev in ids[E]["tags"]:
				connect.append("INSERT IGNORE INTO Tool_has_Keyword VALUES ("+str(E)+", '"+prs(rev["tags"][dev])+"');")
	
	fSQL = io.open("./sql/NID.sql", "wt", encoding='utf-8')
	fSQL.write("\n".join(NID))
	fSQL.close()
	
	fSQL = io.open("./sql/WID.sql", "wt", encoding='utf-8')
	fSQL.write("\n".join(WID))
	fSQL.close()
	
	fSQL = io.open("./sql/tool.sql", "wt", encoding='utf-8')
	fSQL.write("\n".join(tool))
	fSQL.close()
	
	fSQL = io.open("./sql/descriptions.sql", "wt", encoding='utf-8')
	fSQL.write("\n".join(ins))
	fSQL.close()
	
	fSQL = io.open("./sql/connect.sql", "wt", encoding='utf-8')
	fSQL.write("\n".join(connect))
	fSQL.close()
	
	fSQL = io.open("./sql/licence.sql", "wt", encoding='utf-8')
	fSQL.write("\n".join(licence))
	fSQL.close()
sqlify(dic, ids, rev)