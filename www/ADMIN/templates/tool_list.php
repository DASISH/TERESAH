<h1>Tools</h1>
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



