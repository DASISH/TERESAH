<?php
class Sparql {

    function __construct() {
        
        $this->config = array(
            /* db */
            'db_host' => ARC2_db_host, /* optional, default is localhost */
            'db_name' => ARC2_db_name,
            'db_user' => ARC2_db_user,
            'db_pwd'  => ARC2_db_pwd,

            /* store name */
            'store_name' => 'tools',

            /* endpoint */
            'endpoint_features' => array(
              'select', 'construct', 'ask', 'describe', 
              'load', 'insert', 'delete', 
              'dump' /* dump is a special command for streaming SPOG export */
            ),

            'endpoint_timeout' => 120, /* not implemented in ARC2 preview */
            'endpoint_read_key' => '', /* optional */
            'endpoint_write_key' => 'kattfluff', /* optional, but without one, everyone can write! */
            'endpoint_max_limit' => 25000, /* optional */
          );
    }
    
    function endpoint(){
        $ep = ARC2::getStoreEndpoint($this->config);
        if (!$ep->isSetUp()) {
            print "setting up";
            $ep->setUp(); /* create MySQL tables */
        }
                
        $ep->go();
    }
    
     function load($uri){
        $ep = ARC2::getStoreEndpoint($this->config);
        if (!$ep->isSetUp()) {
            print "setting up";
            $ep->setUp(); /* create MySQL tables */
        }
        
        $ep->query('LOAD <'.$uri.'>');
        if ($errs = $ep->getErrors()) {
            print_r($errs);
        }
    }
    
    function import($query){
        $ep = ARC2::getStoreEndpoint($this->config);
        if (!$ep->isSetUp()) {
            print "setting up";
            $ep->setUp(); /* create MySQL tables */
        }
        
        $ep->query($query);
        
        $ep->go();
    }
    
    function store_all(){
        $ep = ARC2::getStoreEndpoint($this->config);
    
        if (!$ep->isSetUp()) {
            $ep->setUp(); /* create MySQL tables */
        }
        
        $ep->query('LOAD <http://rdf.wp23.borsna.se/dump.ttl>');
    }
}
?>
