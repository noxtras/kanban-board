                </div>
                </div>
            </div>
            <!-- end #page -->
        </div>

        <div id="footer">
            <p>Copyright (c) 2008 Sitename.com. All rights reserved. Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>.</p>
        </div>
        <!-- end #footer -->

        <div id="dialog" title="Kanban Board"></div>
        <div id="confirm-dialog" title="Confirmation"></div>

        <script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/jquery-ui-1.7.1.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/jeditable.js"></script>
        <script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/common.js"></script>
        <script type="text/javascript">
            defaultStatusId = '<?php echo $config['defaultStatus'] ?>';
            config = <?php echo json_encode($config); ?>
        </script>
    </body>
</html>
