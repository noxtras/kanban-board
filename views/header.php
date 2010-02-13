<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <link href="<?php echo $config['baseurl'] ?>/assets/css/site.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo $config['baseurl'] ?>/assets/css/themes/<?php echo $config['ui_theme'] ?>/all.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo $config['baseurl'] ?>/assets/css/ui_tuner.css" type="text/css" rel="stylesheet" />

        <title>Kanban Board</title>
    </head>
    <body>
        <div id="wrapper">
            <div id="header-wrapper">
                <div id="header">
                    <div id="logo">
                        <h1><a href="<?php echo $config['baseurl'] ?>"><img src="../assets/images/kanban.jpg" border="0" alt="kanban-board" /></a></h1>
                        <p>simple, interactive, web based kanban playground</p>
                    </div>
                </div>

                <ul id="util" class="ui-icons">
                    <li class="ui-state-default ui-corner-all" title="settings">
                        <a href="#help" onclick="$('#help').slideToggle(); return false">
                            <span class="ui-icon ui-icon-wrench"></span> help
                        </a>
                    </li>
                    <?php if($page != 'home'): ?>
                    <li class="ui-state-default ui-corner-all" title="projects">
                        <a href="<?php echo $config['baseurl'] ?>">
                            <span class="ui-icon ui-icon-home"></span> projects
                        </a>
                    </li>
                    <?php else: ?>
                        <?php if($_GET['status'] == 'archived'): ?>
                        <li class="ui-state-default ui-corner-all" title="settings">
                            <a href="<?php echo $config['baseurl'] ?>">
                                <span class="ui-icon ui-icon-unlocked"></span> active projects
                            </a>
                        </li>
                        <?php else: ?>
                        <li class="ui-state-default ui-corner-all" title="settings">
                            <a href="<?php echo $config['baseurl'] .'?status=archived' ?>">
                                <span class="ui-icon ui-icon-locked"></span> archived projects
                            </a>
                        </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <li class="ui-state-default ui-corner-all" title="settings">
                        <a href="<?php echo $config['baseurl'] .'?page=settings' ?>">
                            <span class="ui-icon ui-icon-wrench"></span> settings
                        </a>
                    </li>
                    
                </ul>
            </div>
            <!-- end #header -->

            <div id="page">
                <div id="help" class="invisible">
                    <a href="#close-help" onclick="$('#help').slideUp(); return false" class="ui-state-focus ui-corner-all" style="float: right; width: 17px; height: 18px; border-color: white;" >
                        <span class="ui-icon ui-icon-closethick">close</span>
                    </a>
                    See <a href="#">wiki page</a> for more details.
                </div>
                <div id="page-bgtop">
                <div id="page-bgbtm">
                