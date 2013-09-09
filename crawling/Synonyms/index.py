#!/usr/bin/env python
# -*- coding: utf-8 -*-

from bs4 import BeautifulSoup
from difflib import get_close_matches
import io

def getNames():
	files = {}
	names = list()
	dir = ["../Bamboo/output/bamboodirt.xml", "../ArtsHumanities/output/A&H.xml"]
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
"""
def largeSynonyms(names):
	f = io.open("./output/large.csv", "wt", encoding='utf-8')
	for word in names:
		#We create a filtered list so this word is not in the list we compare it with
		names_filtered = [w for w in names if w != word]
		close = get_close_matches(word, names_filtered)
		if len(close) > 0:
			syn_validated = list()
			for syn in close:
				#We ask the user to tell us if it is a synonym or not
				YN = raw_input("Is "+syn+" the same thing as "+word + " [y/n] ?")
				YN = YN.lower()
				if YN == "y":
					syn_validated.append(syn)
					names = [w for w in names if w != syn]
				
				
			if len(syn_validated) > 0:
				f.write(word+";"+";".join(syn_validated)+"\n")
		else:
			f.write(word+"\n")
	f.close()
"""

#largeSynonyms(names)

#http://hetland.org/coding/python/levenshtein.py
def levenshtein(a,b):
    "Calculates the Levenshtein distance between a and b."
    n, m = len(a), len(b)
    if n > m:
        # Make sure n <= m, to use O(min(n,m)) space
        a,b = b,a
        n,m = m,n
        
    current = range(n+1)
    for i in range(1,m+1):
        previous, current = current, [i]+[0]*n
        for j in range(1,n+1):
            add, delete = previous[j]+1, current[j-1]+1
            change = previous[j-1]
            if a[j-1] != b[i-1]:
                change = change + 1
            current[j] = min(add, delete, change)
            
    return current[n]
	
def getSyn(path):
	z = list()
	F = io.open(path, "rt")
	for l in F:
		a = l.split(u";")
		if len(a) > 1:
			z.append(a)
	return z
	

syns = getSyn("./output/large.csv")

def getLevs(synList):
	levs = list()
	for syns in synList:
		for word in syns:
			if word != syns[0]: # If it is not the reference word
			
				#(lensum - levScore) / lensum
				levScore = float(levenshtein(syns[0], word))
				lensum = float(len(word) + len(syns[0]))
				
				#Due to int / float conflict with (x / Z) < 0, we need to float everything
				nom = float(lensum - levScore)
				levRatio = float((lensum - levScore) / lensum)
				levs.append(levRatio)
	return levs
	
levs = getLevs(syns)

def avgMinMax(levs):
	return min(levs), max(levs), float(sum(levs) / len(levs))

#Write an XML files from synonyms list
def synXML(syns):
	included = list()
	str = u""
	
	
	f = open("./output/synonyms.xml", "wt")
	f.write(u"<?xml version=\"1.0\"?>\n")
	
	f.write(u"<data>\n")
	
	for lis in syns:
		f.write(u"\n\t<element name='"+lis[0]+"'>\n\t\t<synonym>" + "</synonym>\n\t\t<synonym>".join(lis) + "</synonym>\n\t</element>")
	
	
	f.write(u"</data>\n")
	
	
print avgMinMax(levs)
print synXML(syns)