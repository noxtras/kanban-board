<?php
    $status = ($_GET['status'] == 'archived')? 'archived' : 'active';
    $projects = getProjects($status);
?>
<div id="content">
    <h2><?php echo ucfirst($status) ?> Projects</h2>

    <?php if($status == 'active'): ?>
    <div class="add-form-holder">
        <!-- onclick="$('#projectForm').slideToggle() -->
        <a href="#create-project" onclick="return $('#project-dialog').dialog('open')" class="ui-link ui-state-default ui-corner-all">
            <span class="ui-icon ui-icon-plusthick"></span>Create Project
        </a>
        <div id="project-dialog" title="Create Project">
            <form id="projectForm" name="projectForm" action="" onsubmit="return false">
                <label>Project name</label>
                <input type="text" name="project" id="project"/>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <table id="projet-list" class="ui-widget"  cellspacing="0">
        <thead>
            <tr class="ui-widget-header">
                <th width="30%">Project</th>
                <th width="30%">Status</th>
                <th width="40%">&nbsp;</th>
            </tr>
        </thead>
        <tbody class="ui-widget-content">
            <?php foreach($projects as $project): ?>
            <tr id="project-<?php echo $project['id'] ?>" class="ui-state-default">
                <td class="project-name editable" id="<?php echo $project['id'] ?>" title="Click to rename"><?php
                echo $project['name']
                ?></td>
                <td align="center">
                    <span class="project-progress" title="<?php echo ($project['total_card'])? round(($project['done_card']/$project['total_card'])*100) : '0' ?>"></span>
                    <span class="project-status"><?php echo $project['done_card'], ' of ', $project['total_card'] ?> cards completed</span>
                </td>
                <td class="action">
                    <a href="<?php echo $config['baseurl'].'?page=project&id='.$project['id'] ?>" class="ui-link ui-state-default ui-corner-all">
                        <span class="ui-icon ui-icon-folder-open"></span> go
                    </a>
                    <?php if($status == 'active'): ?>
                    <a href="#archive" onclick="return updateProjectStatus('<?php echo $project['id'] ?>', 'archived')" class="ui-link ui-state-default ui-corner-all">
                        <span class="ui-icon ui-icon-locked"></span> archive
                    </a>
                    <?php else: ?>
                    <a href="#archive" onclick="return updateProjectStatus('<?php echo $project['id'] ?>', 'active')" class="ui-link ui-state-default ui-corner-all">
                        <span class="ui-icon ui-icon-unlocked"></span> active
                    </a>
                    <?php endif; ?>
                    <a href="#" onclick="return projectDeleteConfirmation('<?php echo $project['id'] ?>')"  class="ui-link ui-state-default ui-corner-all">
                        <span class="ui-icon ui-icon-trash"></span> delete
                    </a>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="clear: both;">&nbsp;</div>
</div>
<!-- end #content -->

<div id="sidebar">
    <ul>
        <li>
            <h2>What is this?</h2>
            <p>The board is a visual control. The kanban system is an implementation of a pull system using quantity limited signal (physical cards in manufacturing).</p>
        </li>
        <li>
            <h2>New to KANBAN?</h2>
            <ul>
                <li><a href="http://www.graphicproducts.com/tutorials/kanban/index.php"  target="_blank">What is Kanban?</a></li>
                <li><a href="http://www.infoq.com/presentations/kanban-for-software"  target="_blank">Kanban for Software Engineering</a></li>
                <li><a href="http://leanandkanban.wordpress.com/2009/04/04/the-kanban-board/"  target="_blank">The Kanban board</a></li>
                <li><a href="http://blog.crisp.se/henrikkniberg/2009/06/26/1246053060000.html"  target="_blank">One day in kanban land</a></li>
                <li><a href="http://blog.crisp.se/henrikkniberg/2009/11/19/1258614240000.html"  target="_blank">Kanban and Scrum</a></li>
                <li><a href="http://en.wikipedia.org/wiki/Kanban" target="_blank">Wikipedia says</a></li>
            </ul>
        </li>
    </ul>

</div>
<!-- end #sidebar -->
<div style="clear: both;">&nbsp;</div>


<script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/project.js"></script>
