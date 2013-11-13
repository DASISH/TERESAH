<div class="page-header">
    <h1><?php print $title; ?></h1>
    <div class="toolbox-fixed">
        <a href="<?php print BASE_PATH . $facet; ?>/add"><span class="glyphicon glyphicon-plus"></span> Add</a>  
        <a href="#"><span class="glyphicon glyphicon-check"></span> Select all</a>
        <a href="#"><span class="glyphicon glyphicon-unchecked"></span> Unselect all</a>
        <a href="#" class="batch-action" data-batch-function="deleteFacet"><span class="glyphicon glyphicon-trash"></span> Delete</a>    
    </div>
</div>

<table class="sortable table table-striped table-bordered">
    <thead>
        <tr>
            <th class="sorting_disabled">&nbsp;</th>
            <?php foreach ($fields as $title => $field): ?>
                <th><?php print $title; ?></th>				
            <? endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($items as $item): ?>
        <tr>
            <td><input type="checkbox" value="<?php print $item[$facet_uid]; ?>" name="id[]" /></td>			
            <?php foreach ($fields as $title => $field): ?>
                    <td><a href="<?php print $facet;?>/edit/<?php print $item[$facet_uid]; ?>"><?php print $item[$field]; ?></a></td>
            <? endforeach; ?>            
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>