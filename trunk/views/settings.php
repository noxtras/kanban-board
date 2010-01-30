<?php 
$statusNames = getStatusNames();
$cardTypes = getCardTypes();
?>

<h2>Card Types</h2>
<a href="#add-card-type" onclick="return $('#cardtype-dialog').dialog('open')">Add Card type</a>
<table id="card-types" class="ui-widget narrow">
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


<h2>Workflow States</h2>
<a href="#add-status" onclick="return $('#status-dialog').dialog('open')">Add Wrokflow State</a>
<table id="status-names" class="ui-widget narrow">
    <thead>
        <tr class="ui-widget-header">
            <th width="40%">Name</th>
            <th width="15%">WIP Limit</th>
            <th width="15%">WIP Column<sup class="hint">(?)</sup></th>
            <th width="30%">&nbsp;</th>
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



<div id="cardtype-dialog" title="Add Card Type">
    <form name="cardtype" id="cardtype" method="get" action="" onsubmit="return false">
        <label>Name</label>
        <input type="text" name="name" id="name" />

        <label>Front color</label>
        <input type="text" name="front_color" id="front_color" />

        <label>Back Color</label>
        <input type="text" name="back_color" id="back_color" />
    </form>
</div>

<div id="status-dialog" title="Add Workflow State">
    <form name="status" id="status" method="get" action="" onsubmit="return false">
        <label>Name</label>
        <input type="text" name="name" id="name" />

        <label>WIP Limit</label>
        <input type="text" name="WIP" id="WIP" />
    </form>
</div>




<script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/settings.js"></script>

<?
//print_r($statusNames);
//print_r($cardTypes);


