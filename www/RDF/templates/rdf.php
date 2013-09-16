<rdf:RDF
    xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:dcterms="http://purl.org/dc/terms/"
    xmlns:foaf="http://xmlns.com/foaf/0.1/"
    xmlns:bibo="http://purl.org/ontology/bibo/"
    xmlns:owl ="http://www.w3.org/2002/07/owl#"
    xmlns:doap="http://usefulinc.com/doap/">
    
    <?php foreach($data['tools'] as $tool):?>
    <rdf:Description rdf:about="http://tools.dasish.eu/tool/<?php print $tool['UID'];?>">
        <rdf:type rdf:resource="http://schema.org/SoftwareApplication"/>
        <dc:title><?php print htmlspecialchars($tool['title']);?></dc:title>
        <foaf:homepage><?php print htmlspecialchars($tool['homepage']);?></foaf:homepage>
        <dcterms:created><?php print $tool['registered'];?></dcterms:created>
        
        <?php foreach($tool['keywords'] as $keyword):?>
        <dcterms:subject rdf:resource="http://tools.dasish.eu/keyword/<?php print $keyword['Keyword_id'];?>"/>    
        <?php endforeach;?>
        
    </rdf:Description>
    <?php endforeach;?>
    
    <?php foreach($data['keywords'] as $keyword):?>
    <rdf:Property rdf:about="http://tools.dasish.eu/keyword/<?php print $keyword['keyword_uid'];?>">
        <rdfs:type rdf:resource="http://isocat.org/datcat/DC-278"/>
        <rdfs:label><?php print htmlspecialchars($keyword['keyword']);?></rdfs:label>
        <?php if($keyword['sourceURI']):?>
        <owl:sameAs rdf:resource="<?php print $keyword['sourceURI'];?>"/>
        <?php endif;?>
    </rdf:Property> 
    <?php endforeach;?>
</rdf:RDF>