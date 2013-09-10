#!/usr/bin/env python
# -*- coding: utf-8 -*-

"""
This file should be used to retrieve crawled data, filter them through synonyms and ignored to finally print object so :

	obj : {
		shortname() : {
			"id" : 6515613,
			"shortname" : "gvbhnjmkvuygbhn",
			"hostName" : {
			},
			"Bamboo" : {
				key : value
			}
		},
		etc.
	}
	
Then these data can be put into sql values
"""

from bs4 import BeautifulSoup
import io
#For test purposes :
import json

#######################################################
#
#
#
#				MINOR FUNCTIONS
#
#
#
#######################################################

def noNT(str):
	return str.replace(u"\n", u"").replace(u"\t", u"")

def shortName(str):
	str = noNT(str.replace(u" ", u"-")).lower()
	return str[:79]

def turnToJson(obj, path):
	f = io.open(path, "wt", encoding='utf-8')
	str = json.dumps(obj, sort_keys=True, indent=4)
	f.write(unicode(str))
	f.close()
	
	
	
#######################################################
#
#
#
#				CORE FUNCTIONS
#
#
#
#######################################################
#We need to get an ignore list first
def getIgnore():
	#We read and store the file contents
	file = io.open("../Ignore/output/ignore.xml", "rt")
	xml = file.read()
	file.close()
	
	#We save every element in a list
	l = list()
	BS = BeautifulSoup(xml)
	
	for ignored in BS.findAll("ignore"):
		str = ignored.string
		l.append(noNT(str))
		
		
	#We return the list
	return l

#We then need a dictionnary of synonyms:
def getSynonym():
	#We read and store the file contents
	file = io.open("../Synonyms/output/synonyms.xml", "rt")
	xml = file.read()
	file.close()
	
	#We save every element in a list
	l = {}
	BS = BeautifulSoup(xml)
	
	#We get every group of synonym
	for el in BS.findAll("element"):
		ref = noNT(el["name"])
		#We get every element in this group of synonym
		for syn in el.findAll("synonym"):
			str = noNT(syn.string)
			if str != ref:
				l[str] = ref
			
	#We return the dictionnary
	return l
	
#Function to turn xml to object :
def turnObj(BS):
	obj = {}
	for child in BS.findChildren():
		if child.name in obj:
			obj[child.name].append(child.string)
		else:
			obj[child.name]  = [child.string]
	return obj
	
	
#We need to get every files we have and parse them
def getObj(ign, syn): # Take ignored list and synonym dictionnary as parameters
	o = {}
	
	dir = ["../Bamboo/output/bamboodirt.xml", "../ArtsHumanities/output/A&H.xml", "../HistoryOnline/output/HistoryOnline.xml"]
	
	translatePath = {"../Bamboo/output/bamboodirt.xml" : "BambooDirt", "../ArtsHumanities/output/A&H.xml" : "ArtsHumanities", "../HistoryOnline/output/HistoryOnline.xml" : "HistoryOnline"}
	
	#We create an INT id
	id = 1
	for path in dir:
		#Open the file
		F = open(path, "rt")
		#Get the BS of the file
		BS = BeautifulSoup(F.read())
		#Close a file
		F.close()
		
		
		#host name
		hostName = translatePath[path]
		
		#We get every element
		for el in BS.findAll("element"):
			#Then we get all its children
			
			name = noNT(el.find("name").string)
			short = shortName(name)
			
			#Then we check if it is in ignored list :
			if name in ign:
				print name + u" is ignored"
			else:
				#We then check if it has a parent synonym
				#If it has, we set the key of the object using shortName(parentName)
				if name in syn:
					key = shortName(syn[name])
					print name + u" has " + syn[name] + u" as a synonym."
				else :
					key = short
					
			#We then check that the key name doesnt exist
			if key in o:
				o[key][hostName] = turnObj(el)
			else:
				o[key] = {"id": id, "shortname" : key}
				o[key][hostName] = turnObj(el)
				id += 1
				
	#return files, names
	return o
	
	
####################################################
#
#
#			EXECUTION PART
#
#
####################################################
"""
ignoredList = getIgnore()
#print ignoredList

synonymList = getSynonym()
#print synonymList

finalObject = getObj(ignoredList, synonymList)

turnToJson(finalObject, "./tests/export.json")
print len(finalObject)
"""