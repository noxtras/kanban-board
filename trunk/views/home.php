<?php
    $status = ($_GET['status'] == 'archived')? 'archived' : 'active';
    $projects = getProjects($status);
?>

<h2><?php echo ucfirst($status) ?> projects</h2>

<?php if($status == 'active'): ?>
<a href="#create-project" onclick="$('#projectForm').slideToggle()">Create Project</a>
<form id="projectForm" name="projectForm" onsubmit="return createProject()" class="invisible">
    <label>Project name</label>
    <input type="text" name="project" id="project"/>
    <input type="submit" value="Create">
</form>
<?php endif; ?>

<table id="projet-list">
    <thead>
        <tr>
            <th>project</th>
            <th>total cards</th>
            <th>done</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($projects as $project): ?>
        <tr id="project-<?php echo $project['id'] ?>">
            <td>
                <span class="project-name editable" id="<?php echo $project['id'] ?>"><?php echo $project['name'] ?></span>
            </td>
            <td>20</td>
            <td>5</td>
            <td>
                <a href="<?php echo $config['baseurl'].'?page=project&id='.$project['id'] ?>">go</a>
                <?php if($status == 'active'): ?>
                <a href="#archive" onclick="return updateProjectStatus('<?php echo $project['id'] ?>', 'archived')">archive</a>
                <?php else: ?>
                <a href="#archive" onclick="return updateProjectStatus('<?php echo $project['id'] ?>', 'active')">active</a>
                <?php endif; ?>
                <a href="#delete" onclick="return projectDeleteConfirmation('<?php echo $project['id'] ?>')">delete</a>
                
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/project.js"></script>
