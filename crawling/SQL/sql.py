#!/usr/bin/env python
# -*- coding: utf-8 -*-





#Key for Bamboo :
#[u'status', u'costbracket', u'name', u'license', u'tags', u'webpage', u'description', u'platform', u'cost', u'dependson', u'page', u'categories', u'developer']










import json
import io
import index

######################################
#
#
#                        SIDE FUNCTION
#
#
######################################

def F2Json(path):        #We need the object which has been translated to json in index.py
        f = io.open(path, "rt", encoding="utf-8")
        j = f.read()
        f.close()
        
        return json.loads(j)

def prs(str):
        if not str is None:
                if "'" in str:
                        str = str.replace("'", "\\'")
                return str
        else:
                return u""

def O2SQL(obj):
        s = ""
        for req in obj:
                v = obj[req]
                s += req.replace("#id#", str(v)) + " \n"
        return unicode(s)
#######################################
#
#
#                        CORE FUNCTIONS
#
#
#######################################        
        
def createInsert(obj, host, key, request):
        host = "Dasish"
        if not key in obj[host]:
                obj[host][key] = {};
                
        id = False
        if request.count(u"#id#") >= 1:
                id = len(obj[host][key]) + 1
                #request = request.replace(u"#id#", str(id))
        
        if request in obj[host][key]:
                id = obj[host][key][request]
        else:
                obj[host][key][request] = id
        
        return obj, id

def getRequest(t, i, v, h, k, p): # table, tool_uid, value, host, host key
        #uri :
        uri = srcURI["URI"][h]
        req = False
        add = False
        if isinstance(v, dict):
                uri = srcURI["URI"][h] + v["href"]
                v = prs(v["value"])
                
        if t == "Keyword":
                req = "INSERT INTO keyword VALUES (#id#, '"+v+"', '"+uri+"', '"+k+"');"
                
        elif t == "Tool_type":
                req = "INSERT INTO tool_type VALUES ('#id#', '"+v+"', '"+uri+"');"
                
        elif t == "Platform":
                v = OS[v]
                req = "INSERT INTO platform VALUES (#id#, '"+v+"');"
                
        elif t == "Developer":
                req = "INSERT INTO developer VALUES (#id#, '"+v+"', NULL, 'Unknown');"
                
        elif t == "registryDescription":
                if v:
                        req = "INSERT INTO external_description VALUES ('', "+str(i)+", '"+v+"', '"+p+"', '"+h+"');"
                else:
                        pass
                        
        elif t == "":
                pass
                
        elif t == k:
                add = v
                
        elif t == "Licence":
                req = "INSERT INTO licence VALUES (#id#, '"+v+"', 'Unknown');"
                add = "#id#"
                
        else:
                pass
                
        return req , add

#createConnection(tmp["id"], conv["BambooDirt"][key], id, el, "BambooDirt", ins)
def createConnection(u, t, i, v, h, o): # uid, table, element_id, element_value, host, object
        #uri :
        req = False
        
        if isinstance(v, dict):
                v = prs(v["value"])
                
        if t == "Keyword":
                key = "Tool_has_Keyword"
                req = "INSERT INTO tool_has_keyword VALUES ("+u+", '"+str(i)+"', NULL);"
                
        elif t == "Tool_type":
                key = "Tool_has_Tool_type"
                req = "INSERT INTO tool_has_tool_type VALUES ('"+str(i)+"', '"+u+"', NULL);"
                
                
        elif t == "Platform":
                key = "Tool_has_Platform"
                v = OS[v]
                req = "INSERT INTO tool_has_platform VALUES ('"+u+"', '"+str(i)+"', NULL);"
                
        elif t == "Developer":
                key = "Tool_has_Developer"
                req = "INSERT INTO tool_has_developer VALUES ('"+u+"', '"+str(i)+"', NULL);"
                
        elif t == "registryDescription":
                pass
                """
                key = "Tool_has_External_Description"
                req = "INSERT INTO Tool_has_External_Description VALUES ('"+u+"', '"+str(i)+"');"
                """
        elif t == "":
                pass
                
        elif t == "Licence":
                key = "Tool_has_Licence"
                req = "INSERT INTO tool_has_licence VALUES ('"+u+"', '"+str(i)+"', NULL);"
                
        else:
                pass
        
        if req:
                o, id = createInsert(o, "Dasish", key, req)
        return o

def mainDescription(u, o):
        # User(UID=0) = BOT
        r = "INSERT INTO description VALUES ('', '"
        
        if "name" in o:
                r += prs(o["name"])
                
        r += "', NULL, '', "#description, version
        
        if "webpage" in o:
                r += "'" +o["webpage"]+"'"
        else:
                r += "NULL"
                
        r += ", NULL, CURDATE()"#registered, registered_by
                        
        r += ", " + u + ", 0);"
        
        
                #
        #NAME', '\n', '', 'HOMEPAGE', REGISTERED, REGISTERED_BY, Licence_UID, TOOL_UID, USER_UID);"
        return r
        
def filterObject(data):#We need to
        s = set()
        ins = { "BambooDirt" : {}, "ArtsHumanities" : {}, "Dasish" : { "Tool" : {}, "Description" : {} }}
        
        ids = {} # ids[Bamboo][License] = 1
        
        #UID systems
        UID = ["license"]
        
        #Dictionnary for the conversion from host table to DASISH Table
        conv = F2Json("./source/sourceTable.json")
        
        
        
        for element in data:
                tmp = data[element]
                
                ##
                #                We insert the tool
                ##
                
                ins["Dasish"]["Tool"]["INSERT INTO tool VALUES (" + str(tmp["id"]) + " , '" + prs(tmp["shortname"]) + "');"] = tmp["id"]
                
                ###
                #                We get every data we have from every host
                ###
                desc = {}
                for host in tmp:
                
                        if host in conv:
                                #desc["page"] = tmp[host]["page"]
                                for key in tmp[host]:
                                        for el in tmp[host][key]:
                                                r, add = getRequest(conv[host][key], str(tmp["id"]), prs(el), host, key,tmp[host]["page"][0])
                                                
                                                #If we actually use it :
                                                if r:
                                                        ins, id = createInsert (ins, host, conv[host][key], r)
                                                        if add:
                                                                kkey = conv[host][key]
                                                                kkey = kkey.lower()
                                                                desc[kkey] = prs(add.replace("#id#", str(id)))
                                                        
                                                        #We need to create the connection
                                                        ins = createConnection(str(tmp["id"]), conv[host][key], id, prs(el), host, ins)
                                                else:
                                                        if add:
                                                                kkey = conv[host][key]
                                                                kkey = kkey.lower()
                                                                desc[kkey] = prs(add)
                print desc
                ins, id = createInsert(ins, "Dasish", "Description", mainDescription(str(tmp["id"]), desc))
        return ins, s

        
def mergeSQL(obj, path):
        file = io.open(path, "wt", encoding="utf-8")
        obj = obj["Dasish"]
        
        ##
        #
        #        Standalone Data
        #
        ##
        file.write(O2SQL(obj["Tool"]))
        print "Tool written"
        
        file.write(O2SQL(obj["Keyword"]))
        print "Keyword written"
        
        file.write(O2SQL(obj["Licence"]))
        print "Licence written"
        
        file.write(O2SQL(obj["Platform"]))
        print "Platform written"
        
        file.write(O2SQL(obj["Developer"]))
        print "Developer written"
        
        file.write(O2SQL(obj["Tool_type"]))
        print "Tool_type written"
        
        file.write(O2SQL(obj["Description"]))
        print "Tool_type written"
        ##
        #
        #        Connected Data
        #
        ##
        file.write(O2SQL(obj["Tool_has_Keyword"]))
        print "Tool_has_Keyword written"
        
        file.write(O2SQL(obj["Tool_has_Platform"]))
        print "Tool_has_Platform written"
        
        #print O2SQL(obj["Tool_has_Developer"])
        file.write(O2SQL(obj["Tool_has_Developer"]))
        print "Tool_has_Developer written"
        
        file.write(O2SQL(obj["Tool_has_Tool_type"]))
        print "Tool_has_Tool_type written"
        
        file.write(O2SQL(obj["registryDescription"]))
        print "registryDescription written"
        
        file.write(O2SQL(obj["Tool_has_Licence"]))
        print "Tool_has_licence written"
        
        
        
        
        file.close()


######################################
#
#
#                        EXECUTION
#
#
######################################

srcURI = F2Json("./source/sourceUri.json")
OS = F2Json("./source/ossize.json")
data = F2Json("./tests/export.json")

data, s = filterObject(data)

index.turnToJson(data, "./tests/sql.json")

mergeSQL(data, "./tests/insert.sql")
#print s