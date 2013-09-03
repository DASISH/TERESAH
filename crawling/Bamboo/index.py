#!/usr/bin/env python
# -*- coding: utf-8 -*-

import bs4
from queryBamboo import queryBamboo
import re

BeautifulSoup = bs4.BeautifulSoup

def getContents(page, query=False):
	ret = []
	
	if isinstance(page, list):
		for p in page:
			ret.append(getContents(p, query))
		return ret
	else:
		BS = BeautifulSoup(page)
		tbody = BS.find_all("tbody")
		
			
		for tr in tbody[0].find_all("tr"):
			a = tr.find("a")
			
			ret.append(a["href"])
			
			if query:
				queryBamboo(a['href'])
		
		return ret
	
def getPager(page):
	BS = BeautifulSoup(page)
	
	#We get the pager from this page
	pager = BS.find("ul", attrs={"class": "pager"})
	
	#We then look for the number of second page (if != 2 it would be useful to know) and the last one
	a = pager.find_all("a")
	
	reg = re.compile("page=(?P<int>[0-9]+)")
	sec, last = a[1]["href"], a[len(a) - 1]["href"]
	
	sec_r = reg.search(sec)
	last_r = reg.search(last)
	
	return int(sec_r.group("int")), int(last_r.group("int"))
	
def init():
	firstURL = "/all"
	page = [queryBamboo(firstURL)]

	#print page
	sec, last = getPager(page[0])
	
	for i in range(sec, last+1):
		print  "field_categories_tid=All&tid=All&sort_by=title&sort_order=ASC&page="+ str(i)
		p = queryBamboo("/all", "field_categories_tid=All&tid=All&sort_by=title&sort_order=ASC&page="+ str(i))
		page.append(p)
		
	return page
#init()

def parsePage(html, page):
	
	BS = BeautifulSoup(html)
	dic = {}
	
	n = BS.find("div", {"property": "dc:title"})
	d = BS.find("div", {"property": "content:encoded"})
	
	
	
	dic["name"] = n.get_text()
	dic["page"] = page
	if d:
		dic["description"] = d.get_text()
	
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
					
	return dic

def parseContent(l):
	extracted = []
	for parent in l:
		for page in parent:
			print page
			path = "./raw/" + page.replace("/", "-") + ".html"
			f = open(path, "rt")
			html = f.read()
			f.close()
			extracted.append(parsePage(html, "http://dirt.projectbamboo.org"+page))
	return extracted


content = getContents(init(), True)

parsed = parseContent(content)

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