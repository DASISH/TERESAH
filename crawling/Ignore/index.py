#!/usr/bin/env python
# -*- coding: utf-8 -*-

from bs4 import BeautifulSoup
from difflib import get_close_matches
import io

def getNames():
	files = {}
	names = list()
	dir = ["../Bamboo/output/bamboodirt.xml", "../ArtsHumanities/output/A&H.xml", "../HistoryOnline/output/HistoryOnline.xml"]
	for path in dir:
		#Open the file
		F = open(path, "rt")
		#Create the new entry in names
		files[path] = list()
		#Get the BS of the file
		BS = BeautifulSoup(F.read())
		#Close a file
		F.close()
		
		for name in BS.findAll("name"):
			files[path].append(name.string)
			names.append(name.string)
	return files, names
	
#files, names = getNames()

def largeIgnore(names):
	f = io.open("./output/large.csv", "wt", encoding='utf-8')
	for word in names:
		if len(word) > 45:
			f.write(word+"\n")
			print word
	f.close()
	
#largeIgnore(names)

def getIgn(path):
	z = list()
	F = io.open(path, "rt")
	for l in F:
		z.append(l)
	return z
	
igns = getIgn("./input/manual.csv")

def synXML(igns):
	included = list()
	str = u""
	
	
	f = open("./output/ignore.xml", "wt")
	f.write(u"<?xml version=\"1.0\"?>\n")
	
	f.write(u"<data>\n")
	
	for lis in igns:
		f.write(u"<ignore>"+ lis.replace(u"\n", "")+"</ignore>\n")
	
	
	f.write(u"</data>\n")
	
synXML(igns)