Doucmentation of the RDF-representations for the tools registry

Get access to dumps of the registry:
rdf/turtle http://rdf.wp23.borsna.se/dump.ttl
ntripples  http://rdf.wp23.borsna.se/dump.ntriples

Get RDF for a specific tool eg:
http://rdf.wp23.borsna.se/tool/mysql
http://rdf.wp23.borsna.se/tool/pundit

Alternative formats:
http://rdf.wp23.borsna.se/tool/mysql/xml
http://rdf.wp23.borsna.se/tool/mysql/ntripple
http://rdf.wp23.borsna.se/tool/mysql/json

SPARQL-endpoint (ARC2):
http://rdf.wp23.borsna.se/endpoint

Example queries:

All Tools linked to keyword "XML":
PREFIX foaf:    <http://xmlns.com/foaf/0.1/>
PREFIX rdfs:    <http://www.w3.org/2000/01/rdf-schema#>
PREFIX dcterms: <http://purl.org/dc/terms/>
PREFIX isocat:  <http://isocat.org/datcat/>

SELECT ?tool ?title ?homepage ?created
WHERE {
    ?keyword a isocat:DC-278 ;
        rdfs:label "XML" .
    ?tool dcterms:subject ?keyword .
    ?tool dcterms:title ?title .
    ?tool foaf:homepage ?homepage .
    ?tool dcterms:created ?created
}

Encoded in query-string (fomat set to html table):
http://rdf.wp23.borsna.se/endpoint?query=PREFIX+foaf%3A++++%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E%0D%0APREFIX+rdfs%3A++++%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0D%0APREFIX+dcterms%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0D%0APREFIX+isocat%3A++%3Chttp%3A%2F%2Fisocat.org%2Fdatcat%2F%3E%0D%0A%0D%0ASELECT+%3Ftool+%3Ftitle+%3Fhomepage+%3Fcreated%0D%0AWHERE+{%0D%0A++++%3Fkeyword+a+isocat%3ADC-278+%3B%0D%0A++++++++rdfs%3Alabel+%22XML%22+.%0D%0A++++%3Ftool+dcterms%3Asubject+%3Fkeyword+.%0D%0A++++%3Ftool+dcterms%3Atitle+%3Ftitle+.%0D%0A++++%3Ftool+foaf%3Ahomepage+%3Fhomepage+.%0D%0A++++%3Ftool+dcterms%3Acreated+%3Fcreated%0D%0A}&output=htmltab&jsonp=&key=


