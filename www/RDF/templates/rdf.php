<rdf:RDF
    xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:dcterms="http://purl.org/dc/terms/"
    xmlns:foaf="http://xmlns.com/foaf/0.1/"
    xmlns:bibo="http://purl.org/ontology/bibo/"
    xmlns:doap="http://usefulinc.com/doap/">
    
    <?php foreach($data['tools'] as $tool):?>
    <rdf:Description rdf:about="http://tools.dasish.eu/tool/<?php print $tool['UID'];?>">
        <dc:title><?php print htmlspecialchars($tool['title']);?></dc:title>
        <foaf:homepage><?php print htmlspecialchars($tool['homepage']);?></foaf:homepage>
    </rdf:Description>
    <?php endforeach;?>
</rdf:RDF>