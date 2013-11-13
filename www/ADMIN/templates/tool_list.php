<div class="page-header">
    <h1>Tools</h1>
    <div class="toolbox-fixed">
        <a href="<?php print BASE_PATH; ?>tool/add"><span class="glyphicon glyphicon-plus"></span> Add</a>  
        <a href="#"><span class="glyphicon glyphicon-check"></span> Select all</a>
        <a href="#"><span class="glyphicon glyphicon-unchecked"></span> Unselect all</a>
        <a href="#" class="batch-action" data-batch-function="deleteFacet"><span class="glyphicon glyphicon-trash"></span> Delete</a>    
    </div>
</div>
<table class="sortable table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Registred by</th>
            <th>Registred date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tools as $tool): ?>
        <tr>
            <td><a href="tool/<?php print $tool['shortname']; ?>"><?php print $tool['title']; ?></a></td>
            <td><?php print $tool['user_name']; ?></td>
            <td><?php print $tool['registered']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>



