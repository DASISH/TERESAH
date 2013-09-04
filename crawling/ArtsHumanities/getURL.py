#!/usr/bin/env python
# -*- coding: utf-8 -*-

from httplib2 import Http
import urllib
import urllib2

# USED by searchInscriptions, get the code of an give url with given params

def getURL(url, params, method="POST"):
    if method == "GET":
        return urllib.urlopen(url + "?" + params)
    else:
        return urllib.urlopen(url, urllib.urlencode(params))