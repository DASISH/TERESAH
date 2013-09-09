#!/usr/bin/env python
# -*- coding: utf-8 -*-

import bs4
from queryAH import queryAH
import re

BeautifulSoup = bs4.BeautifulSoup

#Get content of a page
def getContents(page, query=False):
	ret = []
	
	#If it is a list : list is used for getting indexpage
	if isinstance(page, list):
		for p in page:
			ret.append(getContents(p, query))
		return ret
	else:
		BS = BeautifulSoup(page)
		div = BS.find("div", attrs={"class" : "view-icttools"})
		tbody = div.find_all("tbody")
		
			
		for tr in tbody[0].find_all("tr"):
			a = tr.find("a")
			
			hr = a["href"]
			hr = hr.replace("/tools/", "")
			
			ret.append(hr)
			
			if query:
				queryAH(hr)
		
		return ret

#Get int representation of second and last page
def getPager(page):
	BS = BeautifulSoup(page)
	
	
	#We get the pager from this page
	pager = BS.find("ul", attrs={"class": "pager"})
	
	#Then we look for all a[href]
	a = pager.find_all("a")
	
	reg = re.compile("page=(?P<int>[0-9]+)")
	sec, last = a[1]["href"], a[len(a) - 1]["href"]
	
	sec_r = reg.search(sec)
	last_r = reg.search(last)
		
	return int(sec_r.group("int")), int(last_r.group("int"))

#Get all index pages
def init():
	firstURL = ""
	page = [queryAH(firstURL, "page=0")]

	sec, last = getPager(page[0])
	
	for i in range(sec, last+1):
		p = queryAH("", "page="+ str(i))
		page.append(p)
	return page

#print init()
def die(error_message):
    raise Exception(error_message)
	
#Return content from a class
def parseClass(BS, claSS, obj, name):
	
	feature = BS.find("div", {"class": claSS})
	if feature:
		fieldItem = feature.find_all("div", {"class" : "field-item"})
		if len(fieldItem) > 1:
			if name == "features":
				die("in fieldItem")
			strFeat= list()
			for div in fieldItem:
				strFeat.append(div.get_text())
			#TEST
		else:
			itemFeat = feature.find_all("p")
			
			if itemFeat:
				#Split on \n AND \u2022 for features only
				if name == "features" and len(itemFeat) == 1:
					
					strFeat = itemFeat[0].get_text()
					if strFeat.count(u'\u2022') > 0 :
						strFeat = strFeat.replace(u"\n", "").replace(u"\t", "")
						tmp = strFeat.split(u"\u2022")
					else:
						strFeat = strFeat.replace(u"*", "")
						tmp = strFeat.split(u"\n")
					
					strFeat = list()
					for i in tmp:
						if len(i) > 2:
							strFeat.append(i)
							
				else:
					strFeat = ""
					for p in itemFeat:
						strFeat += p.get_text()
			else:
				if name == "features":
					strFeat = list()
					#print fieldItem[0].find_all("li")
					for i in fieldItem[0].find_all("li"):
						strFeat.append(i.get_text())
					#print strFeat
					#print BS.prettify()
					#die(claSS + "not in itemFeat")
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
	#print(BS.prettify(formatter="html"))
	dic = {}
	
	#print BS
	
	#print BS.findAll("h1", {"id": "title"})
	n = BS.find("div", {"id": "branding"})
	
	
	dic["name"] = n.get_text()
	dic["page"] = page
	
	dic = parseClass(BS, "field-name-field-short-description", dic, "description")
	dic = parseClass(BS, "field-name-field-tool-features", dic, "features")
	dic = parseClass(BS, "field-name-field-tool-creator", dic, "creator")
	dic = parseClass(BS, "field-name-field-tool-publisher", dic, "publisher")
	#Taxonomies
	dic = parseClass(BS, "field-name-taxonomy-vocabulary-31", dic, "specifications")
	dic = parseClass(BS, "field-name-taxonomy-vocabulary-5", dic, "tags")
	dic = parseClass(BS, "field-name-taxonomy-vocabulary-32", dic, "platform")
	dic = parseClass(BS, "field-name-taxonomy-vocabulary-33", dic, "licence")
	
	dic = parseClass(BS, "field-name-taxonomy-vocabulary-10", dic, "dataCapture")
	dic = parseClass(BS, "field-name-taxonomy-vocabulary-14", dic, "practice")
	dic = parseClass(BS, "field-name-taxonomy-vocabulary-11", dic, "dataEnhancement")
	dic = parseClass(BS, "field-name-taxonomy-vocabulary-29", dic, "lifeCycle")
	
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
			extracted.append(parsePage(html, "http://www.arts-humanities.net"+page))
			
	return extracted

#print init()
content = getContents(init(), True)
#print content
parsed = parseContent(content)

def convertXML(obj):
	f = open("./output/A&H.xml", "wt")
	f.write("<?xml version=\"1.0\"?>\n")
	
	f.write("<data>\n")
	for o in obj:
		#print o
		f.write("\t<element>\n")
		for key in o:
			keyz = key.strip().replace(" ", "")
			if isinstance(o[key], list):
				for oz in o[key]:
					oz = oz.strip()
					str = "\t\t<"+keyz+">"+oz+"</"+keyz+">\n"
					f.write(str.encode("utf-8"))
			else:
				oz = o[key]
				oz = oz.strip()
				str = "\t\t<"+keyz+">"+oz+"</"+keyz+">\n"
				f.write(str.encode("utf-8"))
		f.write("\t</element>\n")
	f.write("</data>\n")
	
convertXML(parsed)