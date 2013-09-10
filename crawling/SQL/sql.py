#!/usr/bin/env python
# -*- coding: utf-8 -*-





#Key for Bamboo :
#[u'status', u'costbracket', u'name', u'license', u'tags', u'webpage', u'description', u'platform', u'cost', u'dependson', u'page', u'categories', u'developer']










import json
import io

######################################
#
#
#			SIDE FUNCTION
#
#
######################################

def F2Json(path):	#We need the object which has been translated to json in index.py
	f = io.open(path, "rt", encoding="utf-8")
	j = f.read()
	f.close()
	
	return json.loads(j)
	

#######################################
#
#
#			CORE FUNCTIONS
#
#
#######################################	
	
def createInset(obj, host, key, request, id = False):
	if not key in obj[host]:
		obj[ost][key] = set();
		
	
	if id == True:
		id = len(obj) + 1
		request = request.replace(u"#id#", str(id))
		
	obj[host][key].add(request)
	
	return obj, id

def filterObject(data):#We need to
	s = set()
	ins = { "BambooDirt" : {}}
	
	ids = {} # ids[Bamboo][License] = 1
	
	#UID systems
	UID = ["license"]
	
	#Dictionnary for the conversion from host table to DASISH Table
	conv = F2Json("./source/sourceTable.json")
	
	
	
	for element in data:
		tmp = data[element]
		#We insert the tool
		
		ins.append("INSERT INTO Tool VALUES (" + str(tmp["id"]) + " , '" + tmp["shortname"] + "')")
		
		if "BambooDirt" in tmp:
			for key in tmp["BambooDirt"]:
				if key in BambooTags:
				
				elif key in BambooCategories:
				elif key == "license":
	return ins, s



######################################
#
#
#			EXECUTION
#
#
######################################

data = F2Json("./tests/export.json")

data = filterObject(data)
print data