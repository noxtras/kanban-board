<?php 
$statusNames = getStatusNames();
$cardTypes = getCardTypes();
?>

<div id="content">
    <h2>Card Types</h2>
    <div class="add-form-holder">
        <a href="#add-card-type" onclick="return $('#cardtype-dialog').dialog('open')"
           class="ui-link ui-state-default ui-corner-all">
            <span class="ui-icon ui-icon-plusthick"></span>Add Card type
        </a>
    </div>

    <table id="card-types" class="ui-widget" cellspacing="0">
        <thead>
            <tr class="ui-widget-header">
                <th width="40%">Name</th>
                <th width="20%">Front Color</th>
                <th width="20%">Back Color</th>
                <th width="20%">&nbsp;</th>
            </tr>
        </thead>
        <tbody  class="ui-widget-content">
            <?php foreach($cardTypes as $type): ?>
            <tr id="type-<?php echo $type['id'] ?>" class="ui-state-default">
                <td class="editable" id="card_types-name-<?php echo $type['id'] ?>"><?php echo $type['name'] ?></td>
                <td align="center" class="editable" id="card_types-front_color-<?php echo $type['id'] ?>"><?php echo $type['front_color'] ?></td>
                <td align="center" class="editable" id="card_types-back_color-<?php echo $type['id'] ?>"><?php echo $type['back_color'] ?></td>
                <td class="action" align="center">
                    <a href="#delete" onclick="return cardTypeDeleteConfirmation('<?php echo $type['id'] ?>')" class="ui-link ui-state-default ui-corner-all">
                        <span class="ui-icon ui-icon-trash"></span> delete
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="padded-clear">&nbsp;</div>
    <div class="padded-clear">&nbsp;</div>

    <h2>Workflow States</h2>
    <div class="add-form-holder">
    <a href="#add-status" onclick="return $('#status-dialog').dialog('open')"
       class="ui-link ui-state-default ui-corner-all">
        <span class="ui-icon ui-icon-plusthick"></span>Add Wrokflow State
    </a>
    </div>
    <table id="status-names" class="ui-widget"  cellspacing="0">
        <thead>
            <tr class="ui-widget-header">
                <th width="30%">Name</th>
                <th width="15%">WIP Limit</th>
                <th width="15%">WIP Column<sup class="hint">(?)</sup></th>
                <th width="40%">&nbsp;</th>
            </tr>
        </thead>
        <tbody class="ui-widget-content">
            <?php foreach($statusNames as $status): ?>
            <tr id="status-<?php echo $status['id'] ?>" class="ui-state-default">
                <td class="editable" id="status_names-name-<?php echo $status['id'] ?>"><?php echo $status['name'] ?></td>
                <td align="center" class="editable" id="status_names-WIP-<?php echo $status['id'] ?>"><?php echo $status['WIP'] ?></td>
                <td align="center" class="editable" id="status_names-WIP_column-<?php echo $status['id'] ?>"><?php echo $status['WIP_column'] ?></td>
                <td align="center" class="action">
                    <a href="#down" onclick="return downStatusSl('<?php echo $status['id'] ?>')"  class="ui-link ui-state-default ui-corner-all">
                        <span class="ui-icon ui-icon-arrowthick-1-s"></span> Down</a>
                    <a href="#up" onclick="return upStatusSl('<?php echo $status['id'] ?>')"  class="ui-link ui-state-default ui-corner-all">
                        <span class="ui-icon ui-icon-arrowthick-1-n"></span> Up</a>
                    <a href="#delete" onclick="return statusDeleteConfirmation('<?php echo $status['id'] ?>')"  class="ui-link ui-state-default ui-corner-all">
                        <span class="ui-icon ui-icon-trash"></span> Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="clear">&nbsp;</div>
</div>
<!-- end #content -->

<div id="sidebar">
    <ul>
        <li>
            <h2>Aliquam tempus</h2>
            <p>Mauris vitae nisl nec metus placerat perdiet est. Phasellus dapibus semper consectetuer hendrerit.</p>
        </li>
        <li>
            <h2>Categories</h2>
            <ul>
                <li><a href="#">Aliquam libero</a></li>
                <li><a href="#">Consectetuer adipiscing elit</a></li>
                <li><a href="#">Metus aliquam pellentesque</a></li>
                <li><a href="#">Suspendisse iaculis mauris</a></li>

                <li><a href="#">Urnanet non molestie semper</a></li>
                <li><a href="#">Proin gravida orci porttitor</a></li>
            </ul>
        </li>
    </ul>

</div>
<!-- end #sidebar -->
<div class="clear">&nbsp;</div>

<div id="cardtype-dialog" title="Add Card Type">
    <form name="cardtype" id="cardtype" method="get" action="" onsubmit="return false">
        <ul>
            <li>
                <label>Name</label>
                <input type="text" name="name" id="name" />
            </li>
            <li>
                <label>Front color</label>
                <input type="text" name="front_color" id="front_color" />
            </li>
            <li>
                <label>Back Color</label>
                <input type="text" name="back_color" id="back_color" />
            </li>
        </ul>
    </form>
</div>

<div id="status-dialog" title="Add Workflow State">
    <form name="status" id="status" method="get" action="" onsubmit="return false">
        <ul>
            <li>
                <label>Name</label>
                <input type="text" name="name" id="name" />
            </li>
            <li>
                <label>WIP Limit</label>
                <input type="text" name="WIP" id="WIP" />
            </li>
        </ul>
    </form>
</div>

<script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/settings.js"></script>
