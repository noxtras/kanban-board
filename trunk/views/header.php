<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <link href="<?php echo $config['baseurl'] ?>/assets/css/site.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo $config['baseurl'] ?>/assets/css/themes/<?php echo $config['ui_theme'] ?>/all.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo $config['baseurl'] ?>/assets/css/ui_tuner.css" type="text/css" rel="stylesheet" />

        <script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/jquery-ui-1.7.1.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/jeditable.js"></script>
        <script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/common.js"></script>
        <script type="text/javascript">
            defaultStatusId = '<?php echo $config['defaultStatus'] ?>';
            config = <?php echo json_encode($config); ?>
        </script>
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
                <div id="page-bgtop">
                <div id="page-bgbtm">
                