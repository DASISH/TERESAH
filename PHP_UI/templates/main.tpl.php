<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../assets/ico/favicon.png">

        <title>TERESAH</title>

        <link href="/assets/css/bootstrap.css" rel="stylesheet" />
        <link href="/assets/css/font-awesome.min.css" rel="stylesheet" />
        <link href="/assets/css/font-awesome-ie7.min.css" rel="stylesheet" />
        <link href="/assets/css/fontello.css" rel="stylesheet" />
        <link href="/assets/css/jqcloud.css" rel="stylesheet" />
        <link href="/assets/css/teresah.css" rel="stylesheet" />

        <!--
        <link rel="alternate" type="application/rdf+xml" href="http://rdf.tools.dasish.org/tool/{{item.identifier.shortname}}/xml" title="Structured Descriptor Document (RDF/XML format)" />
        <link rel="alternate" type="text/rdf+n3" href="http://rdf.tools.dasish.org/tool/{{item.identifier.shortname}}/turtle" title="Structured Descriptor Document (N3/Turtle format)" />
        <link rel="alternate" type="application/json+rdf" href="http://rdf.tools.dasish.org/tool/{{item.identifier.shortname}}/json" title="Structured Descriptor Document (RDF/JSON format)" />
        <link rel="alternate" type="text/plain" href="http://rdf.tools.dasish.org/tool/{{item.identifier.shortname}}/ntriples" title="Structured Descriptor Document (N-Triples format)" />
        -->
    </head>

    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">TERESAH</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/"><?php print $i18n['home']; ?></a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown"><?php print $i18n['browse']; ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/registry"><?php print $i18n['browse all']; ?></a></li>
                                <li><a href="/facet"><?php print $i18n['browse facets']; ?></a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown"><?php print $i18n['search']; ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/search/general"><?php print $i18n['general']; ?></a></li>
                                <li><a href="/search/faceted"><?php print $i18n['faceted']; ?></a></li>
                            </ul>
                        </li>
                        <?php if (isset($_SESSION['user'])): ?>
                            <?php if ($_SESSION['user']['level'] >= 3): ?>
                                <li><a href="/add"><?php print $i18n['add']; ?></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown"><?php print $i18n['about']; ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/about/rdf/">RDF</a></li>
                                <li><a href="/about/api/">API</a></li>
                            </ul>
                        </li>
                        <?php if (isset($_SESSION['user'])): ?>
                            <?php if ($_SESSION['user']['level'] == 4): ?>
                                <li><a href="/admin"><?php print $i18n['Admin']; ?></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['user'])): ?><li class="pull-right"><a  href="/profile"><span class="glyphicon glyphicon-user"></span> <span></span><span><?php print $_SESSION['user']['name']; ?></span></a></li><?php endif; ?>
                        <?php if (isset($_SESSION['user'])): ?><li class="pull-right"><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> <span><?php print $i18n['sign out']; ?></span></a></li><?php endif; ?>
                        <?php if (!isset($_SESSION['user'])): ?><li class="pull-right"><a href="/login"><span class="glyphicon glyphicon-log-in"></span> <span><?php print $i18n['sign in']; ?></span></a></li><?php endif; ?>
                    </ul>
                    <form class="navbar-form navbar-right hidden-sm" ng-submit="ui.search.go()">
                        <div class="form-group">
                            <input type="text" placeholder="<?php print $i18n['search']; ?>" name="quicksearch"  ng-model="ui.search.input" class="form-control input-sm" typeahead-wait-ms="100" typeahead="answer.identifiers.shortname as answer.title for answer in ui.search.typeahead($viewValue)" typeahead-loading="true" typeahead-on-select="ui.search.select($item)">
                        </div>
                        <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-search"></span></button>
                    </form>
                </div>
            </div>
        </div>

        <div id="wrap">
            <div class="container">
                <?php if(isset($breadcrumb)):?>
                <ol class="breadcrumb">
                <?php foreach($breadcrumb as $link=>$label):?>
                    <?php if($link):?>
                    <li><a href="<?php print $link;?>"><?php print i18n($label);?></a></li>
                    <?php else: ?>
                    <li><?php print i18n($label);?></li>
                    <?php endif;?>
                <?php endforeach;?>
                </ol>  
                <?php endif;?>
                <?php print $content; ?>
            </div>                
            <div id="push"></div>
        </div>

        <!-- Site footer -->
        <div id="footer">
            <div class="col-centered"><a class="col-centered" href="http://dasish.eu"><img class="col-centered" src="/assets/img/dasish_header_logo.png" alt="DASISH logo"></a></div>				
        </div>

        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="./assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="./assets/js/jqcloud-1.0.4.js"></script>

        <!-- Initialize cloud -->
        <script type="text/javascript">
            $("#cloud").jQCloud(<?php print $cloud; ?>);
        </script>
        
    </body>
</html>