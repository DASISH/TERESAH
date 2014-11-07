<?php

return array(
    
    /*
    |--------------------------------------------------------------------------
    | Search result pager size
    |--------------------------------------------------------------------------
    |
    | Specification of the number of items to show per page in search results
    | 
    */

    "search_pager_size" => 10,
    
    /*
    |--------------------------------------------------------------------------
    | Search facet count
    |--------------------------------------------------------------------------
    |
    | Specification of the number of facets to show when searching
    | 
    */

    "search_facet_count" => 5,    
    
    /*
    |--------------------------------------------------------------------------
    | Quicksearch result size
    |--------------------------------------------------------------------------
    |
    | Specification of the number of items to show when using quick search
    | 
    */

    "quicksearch_size" => 5,
    
    /*
    |--------------------------------------------------------------------------
    | Browse pager size
    |--------------------------------------------------------------------------
    |
    | Specification of the number of items to show per page in browse tools 
    | pages
    | 
    */

    "browse_pager_size" => 10,
        
    /*
    |--------------------------------------------------------------------------
    | Most popular tools count
    |--------------------------------------------------------------------------
    |
    | Specification of the number of tools to show on the Most popular page
    | 
    */

    "popular_count" => 10,
    
    /*
    |--------------------------------------------------------------------------
    | Similar tools count
    |--------------------------------------------------------------------------
    |
    | Specification of the number of similar tools to show on a tool page. 
    | Manually linked similar tools will always be shown. Calculated similar
    | tools will be added up to this specified number.
    | 
    */

    "similar_count" => 5,
    
    /*
    |--------------------------------------------------------------------------
    | Word cloud count
    |--------------------------------------------------------------------------
    |
    | Specification of the number of items to show in word cloud
    | 
    */

    "word_cloud_count" => 50,
    
    /*
    |--------------------------------------------------------------------------
    | Word cloud threshold
    |--------------------------------------------------------------------------
    |
    | Specification of the threshold of occurances of items to show in 
    | word cloud
    | 
    */

    "word_cloud_threshold" => 1,
    
    /*
    |--------------------------------------------------------------------------
    | Tools page RDF formats
    |--------------------------------------------------------------------------
    |
    | Here you can specify the rdf formats to show on a tools page.
    | Possible options are: XML, Turtle, JsonLD, nTriples
    |
    */

    "tool_rdf_formats" => array("XML", "Turtle", "JsonLD"),
);