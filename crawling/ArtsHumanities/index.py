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

#Return content from a class
def parseClass(BS, claSS, obj, name):
	
	feature = BS.find("div", {"class": claSS})
	if feature:
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
	#print(BS.prettify(formatter="html"))
	dic = {}
	
	#print BS
	
	#print BS.findAll("h1", {"id": "title"})
	n = BS.find("div", {"id": "branding"})
	
	
	print n
	dic["name"] = n.get_text()
	dic["page"] = page
	
	dic = parseClass(BS, "field-name-field-short-description", dic, "description")
	dic = parseClass(BS, "field-name-field-tool-features", dic, "features")
	dic = parseClass(BS, "field-name-field-tool-creator", dic, "creator")
	dic = parseClass(BS, "field-name-field-tool-publisher", dic, "publisher")
	
	"""
	pan = BS.find("fieldset", {"id":"node_item_full_group_description"})
	
	#S = BeautifulSoup(pan)
	if pan:
		#fields = pan.findAll("section", {"class" : "field"})
		if pan.findAll("section"):
			for field in pan.findAll("section"):
				#print field
				t = field.find("h2", {"class" : "field-label"})
				te = t.get_text()#.replace(":", "").strip()
				
				v = field.find(True, {"class" : "field-items"})
				
				if v.name == "ul":
					dic[te] = []
					for li in v.find_all("li"):
						dic[te].append(li.get_text().strip())
						
				elif te.count("Platform") > 0:
					dic[te] = []
					for li in v.find_all("div"):
						dic[te].append(li.get_text().strip())
						
				else:
					dic[te] = v.get_text()
	"""	
	return dic

#Get every page
def parseContent(l):
	extracted = []
	for parent in l:
		for page in parent:
			print page
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
print parsed
"""
def convertXML(obj):
	f = open("./output/bamboodirt.xml", "wt")
	f.write("<?xml version=\"1.0\"?>\n")
	
	f.write("<data>\n")
	for o in obj:
		print o
		f.write("\t<element>\n")
		for key in o:
			keyz = key.strip().replace(":", "").replace(" ", "")
			if isinstance(o[key], list):
				for oz in o[key]:
					str = "\t\t<"+keyz+">"+oz+"</"+keyz+">\n"
					f.write(str.encode("utf-8"))
			else:
				str = "\t\t<"+keyz+">"+o[key]+"</"+keyz+">\n"
				f.write(str.encode("utf-8"))
		f.write("\t</element>\n")
	f.write("</data>\n")
	
convertXML(parsed)
"""