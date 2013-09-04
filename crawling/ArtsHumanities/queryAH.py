#!/usr/bin/env python
# -*- coding: utf-8 -*-

import os
from getURL import getURL

def queryAH(url, data = ""):
	if len(data) > 0:
		urls = url + "?" + data
		path = "./raw/" + urls.replace("/", "-") + ".html"
	else:
		path = "./raw/" + url.replace("/", "-") + ".html"
		
	if os.path.exists(path):
		f = open(str(path), 'rt') 
		code = f.read()
		f.close()
	else:
		print data
		url_STRING = "http://www.arts-humanities.net/tools"+url
		#url_STRING = "http://algorythme.net/post.php"
		code = getURL(url_STRING, data, "GET")
		code = code.read()
		
		
		f = open(str(path), 'wt') 
		f.write(code)
		f.close()

	print url + " has been searched"
	
	return code
