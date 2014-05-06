<section id="viewHeader">
    <div class="page-header">
        <div class="pull-right">
            <div class="btn-group btn-group-sm">
                <a class="btn btn-sm btn-default"><?php print $i18n['details']; ?></a>
                <?php if (isset($_SESSION['user'])): ?><a class="btn btn-sm btn-default" href="/link/<?php print $tool['identifier']['id']; ?>"><?php print $i18n['add a label']; ?></a><?php endif; ?>
            </div>
        </div>
        <h1><?php print $tool['descriptions']['title']; ?></h1>
    </div>
</section>

<section>
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <?php foreach($tool['descriptions']['description'] as $description):?>
                <section class="col-lg-12 descrition">
                    <h2><?php print $description['provider'];?></h2>
                    <p>Source : <a href="<?php print $description['uri'];?>"><?php print $description['uri'];?></a></p>
                    <p><?php print nl2br($description['text']);?></p>
                    <hr />
                </section>
                <?php endforeach;?>
                <div class="col-lg-12">
                    <?php if(isset($tool['keyword'])):?>
                    <section id="keywords"  ng-show="item.keyword[0] && !(ui.sections.list['Keywords'])">
                        <h2><?php print $i18n['keywords']; ?>

                        <ul  class="list-inline" style="margin-top:10px;" ng-show="ui.keywords.show">
                            <?php foreach($tool['keyword'] as $keyword): ?>
                            <li class="badge" style="margin-right:10px; margin-bottom:5px; text-transform:capitalize;"><a style="color:#FFF;" href="/facet/Keyword/<?php print $keyword['identifier'];?>"><?php print $keyword['keyword'];?></a></li>
                            <?php endforeach;?>
                        </ul>
                        <hr />
                    </section>
                    <?php endif;?>
                    <?php if(isset($tool['publications'])):?>
                    <section id="publications"  ng-show="item.publications[0] && !(ui.sections.list['Publications'])">
                        <h2><?php print $i18n['publications']; ?>
                            <div class="pull-right">
                                <span class="btn btn-default" ng-click="ui.sections.toggle('Publications')"><span class="glyphicon glyphicon-eye-close"></span></span>
                                <span class="dropdown">
                                    <span class="dropdown-toggle btn btn-default">
                                        <span class="glyphicon glyphicon-cog"></span>
                                    </span>
                                    <ul class="dropdown-menu">
                                        <li><a ng-click="ui.publications.filter.show = !ui.publications.filter.show">Filter</a></li>
                                        <li><a ng-click="ui.publications.show = !ui.publications.show"><?php print $i18n['hide show']; ?></a></li>
                                    </ul>
                                </span>
                            </div>
                        </h2>
                        <div class="btn-group btn-group-sm btn-block  btn-group-justified" ng-show="ui.publications.filter.show">
                            <input class="form-control" type="text" ng-model="ui.publications.filter.input" placeholder="{{ 'filter the publications' | translate }}" />
                        </div>
                        <div style="margin-top:10px;" ng-show="ui.publications.show">
                            <p ng-repeat="pub in item.publications|filter:ui.publications.filter.input" ng-bind="pub.name"></p>
                        </div>
                        <hr />
                    </section>
                    <?php endif;?>
                    <?php if(isset($tool['projects'])):?>
                    <section id="projects" ng-show="item.projects[0] && !(ui.sections.list['Projects'])">
                        <h2><?php print $i18n['projects']; ?>
                            <div class="pull-right">
                                <span class="btn btn-default" ng-click="ui.sections.toggle('Projects')"><span class="glyphicon glyphicon-eye-close"></span></span>
                                <span class="dropdown">
                                    <span class="dropdown-toggle btn btn-default">
                                        <span class="glyphicon glyphicon-cog"></span>
                                    </span>
                                    <ul class="dropdown-menu">
                                        <li><a ng-click="ui.projects.filter.show = !ui.projects.filter.show">Filter</a></li>
                                        <li><a ng-click="ui.projects.show = !ui.projects.show"><?php print $i18n['hide show']; ?></a></li>
                                    </ul>
                                </span>
                            </div>
                        </h2>
                        <div class="btn-group btn-group-sm btn-block  btn-group-justified" ng-show="ui.projects.filter.show">
                            <input class="form-control" type="text" ng-model="ui.projects.filter.input" placeholder="{{ 'filter the projects' | translate }}" />
                        </div>
                        <div style="margin-top:10px;" ng-show="ui.projects.show">
                            <div ng-repeat="pub in item.projects|filter:ui.projects.filter.input">
                                <h5 ng-bind="pub.name"></h5>
                                <p><small  ng-bind="pub.informations.description"></small> <small>{{ 'contact' | translate }} : <a ng-href="mailto:{{pub.informations.contact}}" ng-bind="pub.informations.contact"></a></small></p>

                            </div>
                        </div>
                        <hr />
                    </section>
                    <?php endif;?>
                    <?php if(isset($tool['features'])):?>
                    <section id="features" ng-show="item.features[0] && !(ui.sections.list['Features'])">
                        <h2><?php print $i18n['features']; ?>
                            <div class="pull-right">
                                <span class="btn btn-default" ng-click="ui.sections.toggle('Features')"><span class="glyphicon glyphicon-eye-close"></span></span>
                                <span class="dropdown">
                                    <span class="dropdown-toggle btn btn-default">
                                        <span class="glyphicon glyphicon-cog"></span>
                                    </span>
                                    <ul class="dropdown-menu">
                                        <li><a ng-click="ui.features.filter.show = !ui.features.filter.show">{{ 'filter' | translate }}</a></li>
                                        <li><a ng-click="ui.features.show = !ui.features.show">{{ 'hide show' | translate }}</a></li>
                                    </ul>
                                </span>
                            </div>
                        </h2>
                        <div class="btn-group btn-group-sm btn-block  btn-group-justified" ng-show="ui.features.filter.show">
                            <input class="form-control" type="text" ng-model="ui.features.filter.input" placeholder="{{ 'filter the features' | translate }}" />
                        </div>
                        <div style="margin-top:10px;" ng-show="ui.features.show">
                            <ul ng-repeat="pub in item.features|filter:ui.features.filter.input">
                                <li><em ng-bind="pub.name"></em>
                                    <p><small ng-bind="pub.informations.description"></small></p>
                                </li>
                            </ul>
                        </div>
                        <hr />
                    </section>
                    <?php endif;?>
                    <?php if(isset($tool['standards'])):?>
                    <section id="standards" ng-show="item.standards[0] && !(ui.sections.list['Standards'])">
                        <h2><?php print $i18n['standards']; ?>
                            <div class="pull-right">
                                <span class="btn btn-default" ng-click="ui.sections.toggle('Standards')"><span class="glyphicon glyphicon-eye-close"></span></span>
                                <span class="dropdown">
                                    <span class="dropdown-toggle btn btn-default">
                                        <span class="glyphicon glyphicon-cog"></span>
                                    </span>
                                    <ul class="dropdown-menu">
                                        <li><a ng-click="ui.standards.filter.show = !ui.standards.filter.show">{{ 'filter' | translate }}</a></li>
                                        <li><a ng-click="ui.standards.show = !ui.standards.show">{{ 'hide show' | translate }}</a></li>
                                    </ul>
                                </span>
                            </div>
                        </h2>
                        <div class="btn-group btn-group-sm btn-block  btn-group-justified" ng-show="ui.standards.filter.show">
                            <input class="form-control" type="text" ng-model="ui.standards.filter.input" placeholder="{{ 'filter the standards' | translate }}" />
                        </div>
                        <div style="margin-top:10px;" ng-show="ui.standards.show">
                            <ul ng-repeat="std in item.standards|filter:ui.standards.filter.input">
                                <li><a ng-href="{{std.informations.source}}"><em ng-bind="std.name"></em> ( <span ng-bind="std.informations.version"></span> )</a></li>
                            </ul>
                        </div>
                        <hr />
                    </section>
                    <?php endif;?>
                    <?php if(isset($tool['videos'])):?>
                    <section id="videos" ng-show="item.videos[0] && !(ui.sections.list['Videos'])">
                        <h2><?php print $i18n['video']; ?>
                            <div class="pull-right">
                                <span class="btn btn-default" ng-click="ui.sections.toggle('Videos')"><span class="glyphicon glyphicon-eye-close"></span></span>
                                <span class="dropdown">
                                    <span class="dropdown-toggle btn btn-default">
                                        <span class="glyphicon glyphicon-cog"></span>
                                    </span>
                                    <ul class="dropdown-menu">
                                        <li><a ng-click="ui.videos.provider.show = !ui.videos.provider.show">{{ 'providers' | translate }}</a></li>
                                        <li><a ng-click="ui.videos.filter.show = !ui.videos.filter.show">{{ 'filter' | translate }}</a></li>
                                        <li><a ng-click="ui.videos.show = !ui.videos.show">{{ 'hide show' | translate }}</a></li>
                                    </ul>
                                </span>
                            </div>
                        </h2>
                        <div class="btn-group btn-block  btn-group-justified" ng-show="ui.videos.provider.show">
                            <a class="btn" ng-click="ui.videos.provider.selected = null" ng-class="{'btn-primary': (!ui.videos.provider.selected), 'btn-success' : ui.videos.provider.selected}">{{ 'all providers' | translate }}</a>
                            <a class="btn" ng-repeat="prov in item.videos| vProviders" ng-click="ui.videos.provider.selected = prov; console.log(prov)" ng-class="{'btn-primary': (ui.videos.provider.selected == prov), 'btn-success' : (ui.videos.provider.selected != prov)}" ng-bind="prov"></a>
                        </div>
                        <div class="btn-group btn-group-sm btn-block  btn-group-justified" ng-show="ui.videos.filter.show">
                            <input class="form-control" type="text" ng-model="ui.videos.filter.input" placeholder="{{ 'filter the standards' | translate }}" />
                        </div>
                        <div style="margin-top:10px;" ng-show="ui.videos.show">
                            <div class="row">
                                <div class="col-md-4" ng-repeat="video in item.videos| filter:ui.videos.filter.input | videoFormater | filter:{informations.provider : ui.videos.provider.selected}">
                                    <h5 ng-bind="video.name"></h5>
                                    <div class="flex-video widescreen"><iframe ng-src="{{video.embed}}" frameborder="0" allowfullscreen=""></iframe></div>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </section>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <section id ="informations">
                <div class="pull-right" ng-show="ui.user.data.signedin">
                    <a class="btn btn-default" ng-class="{'btn-primary' : ui.quickLinking.show}" ng-click="ui.quickLinking.get()"><span class="glyphicon glyphicon-link"></span></a>
                </div>
                <h2><?php print $i18n['details']; ?></h2>
                <dl ng-show="!ui.quickLinking.show">
                    <?php if(isset($tool['type'])):?>
                    <dt ng-show="item.type"><?php print $i18n['tool type']; ?></dt>
                    <?php foreach($tool['type'] as $type):?>
                    <dd legend="<?php print $type['uri'];?>"><a href="/facet/ToolType/<?php print $type['identifier'];?>"><?php print $type['type'];?></a></dd>
                    <?php endforeach;?>
                    <?php endif;?>
                    
                    <?php if(isset($tool['licence'])):?>
                    <dt><?php print $i18n['licence']; ?></dt>
                    <?php foreach($tool['licence'] as $licence):?>
                    <dd><?php print $licence['name'];?></dd>
                    <?php endforeach;?>
                    <?php endif;?>
                    
                    <?php if(isset($tool['licence'])):?>
                    <dt><?php print $i18n['licence type']; ?></dt>
                    <?php foreach($tool['licence'] as $licence):?>
                    <dd><?php print $licence['type'];?></dd>
                    <?php endforeach;?>
                    <?php endif;?>
                    
                    <?php if(isset($tool['suite'])):?>
                    <dt><?php print $i18n['suite']; ?></dt>
                    <?php foreach($tool['suite'] as $suite):?>
                    <dd><?php print $suite['name'];?></dd>
                    <?php endforeach;?>
                    <?php endif;?>
                    
                    <?php if(isset($tool['descriptions']['homepage'])):?>
                    <dt><?php print $i18n['homepage']; ?></dt>
                    <dd><a href="<?php print $tool['descriptions']['homepage'];?>"><?php print $tool['descriptions']['homepage'];?></a></dd>
                    <?php endif;?>
                    
                    <?php if(isset($tool['applicationType'])):?>
                    <dt><?php print $i18n['application type(s)']; ?></dt>
                    <?php foreach($tool['applicationType'] as $applicationType):?>
                    <dd><?php print $applicationType['name'];?></dd>
                    <?php endforeach;?>
                    <?php endif;?>
                    
                    <?php if(isset($tool['platform'])):?>
                    <dt><?php print $i18n['platform(s)']; ?></dt>
                    <?php foreach($tool['platform'] as $platform):?>
                    <dd><?php print $platform;?></dd>
                    <?php endforeach;?>
                    <?php endif;?>
                    
                    <?php if(isset($tool['developers'])):?>
                    <dt><?php print $i18n['developer(s)']; ?></dt>
                    <?php foreach($tool['developers'] as $developer):?>
                    <dd><a href="/facet/Developer/<?php print $developer['identifier'];?>"><?php print $developer['name'];?></a></dd>
                    <?php endforeach;?>
                    <?php endif;?>
                    
                    <?php if(array_key_exists('similar', $tool)):?>
                    <dt><?php print $i18n['similar tools']; ?></dt>
                    <?php foreach($tool['similar'] as $similar):?>
                    <dd><a href="/tool/<?php print $similar['shortname'];?>"><?php print $similar['title'];?></a></dd>   
                    <?php endforeach;?>
                    <?php endif;?>
                </dl>
                <hr />
            </section>
            <section id="share">
                <h2><?php print $i18n['share']; ?></h2>
                <a target="_blank" ng-href="http://www.facebook.com/sharer.php?u={{ui.share}}">
                    <span class="icon-stack">
                        <i class="icon-check-empty icon-stack-base"></i>
                        <i class="icon-facebook"></i>
                    </span></a>
                | 
                <a target="_blank" ng-href="https://plus.google.com/share?url={{ui.share}}">
                    <span class="icon-stack">
                        <i class="icon-check-empty icon-stack-base"></i>
                        <i class="icon-google-plus"></i>
                    </span></a>
                | 
                <a target="_blank" ng-href="http://twitter.com/share?text=DASISH-TERESAH%20{{item.descriptions.title}}&url={{ui.share}}">
                    <span class="icon-stack">
                        <i class="icon-check-empty icon-stack-base"></i>
                        <i class="icon-twitter"></i>
                    </span></a>

            </section>
            <section id="availableDescriptions" ng-show="item.descriptions.description[1]">
                <h2><?php print $i18n['available descriptions'];?></h2>
                <div class="btn-group btn-group-sm btn-block  btn-group-justified">
                    <ul>
                    <?php foreach($tool['descriptions']['description'] as $description):?>
                    <li><a onClick="ui.changeDesc(desc)"><?php print $description['provider'];?></a></li>
                    <?php endforeach;?>
                    </ul>
                </div>
                <hr />
            </section>
            <section id="RDF">
                <h2><?php print $i18n['structured descriptor document'];?></h2>
                <div class="btn-group btn-group-sm btn-block  btn-group-justified">
                    <a class="btn btn-sm btn-block" rel="alternate" type="application/rdf+xml" ng-href="http://rdf.tools.dasish.org/tool/{{item.identifier.shortname}}/xml">RDF/XML format</a>
                    <a class="btn btn-sm btn-block" rel="alternate" type="text/rdf+n3" ng-href="http://rdf.tools.dasish.org/tool/{{item.identifier.shortname}}/turtle">N3/Turtle</a>
                    <a class="btn btn-sm btn-block" rel="alternate" type="application/json+rdf" ng-href="http://rdf.tools.dasish.org/tool/{{item.identifier.shortname}}/json">RDF/JSON</a>
                    <a class="btn btn-sm btn-block" rel="alternate" type="text/plain" ng-href="http://rdf.tools.dasish.org/tool/{{item.identifier.shortname}}/ntriples">N-Triples</a>
                </div>
            </section>
            
        </div>
    </div>
</section>

