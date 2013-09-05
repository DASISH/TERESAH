#!/usr/bin/env python
# -*- coding: utf-8 -*-

from bs4 import BeautifulSoup
from queryHO import queryHO
import re

#getPager is useless :/

def getContents(page, query=False):#Page is either a list of html contents or a string containing html contents
	ret = []
	#If it is a list, we check everyco
	
	
	if isinstance(page, list):
		for p in page:
			ret.append(getContents(p, query))
		return ret
	else:
		BS = BeautifulSoup(page)
		div = BS.find("div", {"id" : "view-id-tools_main-page_2"})
		tbody = div.find("tbody")
			
		for tr in tbody.find_all("tr"):
			a = tr.find("a")
			
			ret.append(a["href"])
			
			if query:
				queryHO(a['href'])
		
		return ret
	
def init():
	firstURL = "history-online/tools/list"
	page = []

	p = queryHO(firstURL, "field_jisc_category_value=All&field_availability_value_many_to_one=All&field_active_development_value_many_to_one=All&field_operating_system_value_many_to_one=All&field_purpose_value_many_to_one=All")
	page.append(p)
		
	return page

#print init()
content = getContents(init(), True)

###Parsing Functions
#Return content from a class
def parseClass(BS, claSS, obj, name):
	
	feature = BS.find("div", {"class": claSS})
	if feature:
		fieldItem = feature.find_all("div", {"class" : "field-item"})
		if len(fieldItem) >= 1:
			strFeat= list()
			for div in fieldItem:
				#print div
				string = list(div.stripped_strings)
				strFeat.append(string[1])
			#TEST
		else:
			itemFeat = feature.find_all("p")
			
			if itemFeat:
					strFeat = ""
					for p in itemFeat:
						strFeat += p.get_text()
			else:
					itemFeat = feature.find("div", {"class" : "field-items"})
					strFeat = itemFeat.get_text()
		obj[name] = strFeat
		
	return obj

#Get contents from a description page
def parsePage(html, page):
	
	#PreParse html for avoiding issue
	style = re.compile("<style( .*)/style>")
	html = style.sub("", html)
	BS = BeautifulSoup(html)
	dic = {}
	
	n = BS.find("h1", {"class": "title"})
	
	
	dic["name"] = n.get_text()
	dic["page"] = page
	
	nodeTool = BS.find("div", {"class" :"node-type-tool"})
	content = nodeTool.find("div", {"class" :"content"})
	if content.p :
		dic["description"] = content.p.get_text()
	
	#dic = parseClass(BS, "field-name-field-short-description", dic, "description")
	dic = parseClass(BS, "field-field-jisc-category", dic, "category")
	dic = parseClass(BS, "field-field-web-link", dic, "homepage")
	dic = parseClass(BS, "field-field-availability", dic, "availability")
	dic = parseClass(BS, "field-field-other-software", dic, "otherSoftware")
	dic = parseClass(BS, "field-field-difficulty", dic, "advanced")
	dic = parseClass(BS, "field-field-user-community", dic, "userCommunity")
	dic = parseClass(BS, "field-field-price-text", dic, "price")
	dic = parseClass(BS, "field-field-active-development", dic, "development")
	dic = parseClass(BS, "field-field-purpose", dic, "purpose")
	dic = parseClass(BS, "field-field-operating-system", dic, "os")
	
	return dic

#Get every page
def parseContent(l):
	extracted = []
	for parent in l:
		for page in parent:
			path = "./raw/" + page.replace("/", "-") + ".html"
			f = open(path, "rt")
			html = f.read()
			f.close()
			extracted.append(parsePage(html, "http://www.history.ac.uk/"+page))
			
	return extracted

#We get the parsed
parsed = parseContent(content)

def convertXML(obj):
	f = open("./output/HistoryOnline.xml", "wt")
	f.write("<?xml version=\"1.0\"?>\n")
	
	f.write("<data>\n")
	for o in obj:
		#print o
		f.write("\t<element>\n")
		for key in o:
			keyz = key.strip().replace(":", "").replace(" ", "")
			if isinstance(o[key], list):
				for oz in o[key]:
					str = "\t\t<"+keyz+">"+oz+"</"+keyz+">\n"
					f.write(str.encode("utf-8"))
			else:
				#print keyz
				str = "\t\t<"+keyz+">"+o[key]+"</"+keyz+">\n"
				f.write(str.encode("utf-8"))
		f.write("\t</element>\n")
	f.write("</data>\n")
	
convertXML(parsed)