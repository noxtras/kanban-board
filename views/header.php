<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <link href="<?php echo $config['baseurl'] ?>/assets/css/site.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo $config['baseurl'] ?>/assets/css/jquery-ui-1.7.1.smoothness.css" type="text/css" rel="stylesheet" />

        <script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/jquery-ui-1.7.1.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/jeditable.js"></script>
        <script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/common.js"></script>

        <title>Kanban Board</title>
    </head>
    <body>

        <div id="container">

            <div id="header">
                <a href="<?php echo $config['baseurl'] ?>"><img src="../assets/images/kanban.jpg" border="0" alt="KANBAN BOARD" /></a>

                <ul id="util">
                    <?php if($page != 'home'): ?>
                    <li><a href="<?php echo $config['baseurl'] ?>">projects</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo $config['baseurl'] .'?page=settings' ?>">settings</a></li>
                </ul>
            </div>
	
            <div id="content">
                