<?php
    $status = ($_GET['status'] == 'archived')? 'archived' : 'active';
    $projects = getProjects($status);
?>

<h2><?php echo ucfirst($status) ?> projects</h2>

<?php if($status == 'active'): ?>
<div class="add-form-holder">
    <a href="#create-project" onclick="$('#projectForm').slideToggle()" class="ui-link ui-state-default ui-corner-all">
        <span class="ui-icon ui-icon-plusthick"></span>Create Project
    </a>
    <form id="projectForm" name="projectForm" onsubmit="return createProject()" class="invisible add-form">
        <label>Project name</label>
        <input type="text" name="project" id="project"/>
        <input type="submit" value="Create">
    </form>
</div>
<?php endif; ?>

<table id="projet-list" class="ui-widget narrow">
    <thead>
        <tr class="ui-widget-header">
            <th>Project</th>
            <th>Status</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody class="ui-widget-content">
        <?php foreach($projects as $project): ?>
        <tr id="project-<?php echo $project['id'] ?>" class="ui-state-default">
            <td class="project-name editable" id="<?php echo $project['id'] ?>">
                <?php echo $project['name'] ?>
            </td>
            <td align="center">
                <span class="project-progress" title="<?php echo round(($project['done_card']/$project['total_card'])*100) ?>"></span>
                <span class="project-status"><?php echo $project['done_card'], ' of ', $project['total_card'] ?> cards completed</span>
            </td>
            <td>
                <a href="<?php echo $config['baseurl'].'?page=project&id='.$project['id'] ?>" class="ui-link ui-state-default ui-corner-all">
                    <span class="ui-icon ui-icon-newwin"></span> go
                </a>
                <?php if($status == 'active'): ?>
                <a href="#archive" onclick="return updateProjectStatus('<?php echo $project['id'] ?>', 'archived')" class="ui-link ui-state-default ui-corner-all">
                    <span class="ui-icon ui-icon-newwin"></span> archive
                </a>
                <?php else: ?>
                <a href="#archive" onclick="return updateProjectStatus('<?php echo $project['id'] ?>', 'active')" class="ui-link ui-state-default ui-corner-all">
                    <span class="ui-icon ui-icon-newwin"></span> active
                </a>
                <?php endif; ?>
                <a href="#" onclick="return projectDeleteConfirmation('<?php echo $project['id'] ?>')"  class="ui-link ui-state-default ui-corner-all">
                    <span class="ui-icon ui-icon-newwin"></span> delete
                </a>
                
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/project.js"></script>
