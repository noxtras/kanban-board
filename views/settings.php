<?php 
$statusNames = getStatusNames();
$cardTypes = getCardTypes();
?>

<h2>Card Types</h2>
<a href="#add-card-type" onclick="return $('#cardtype-dialog').dialog('open')">Add Card type</a>
<table id="card-types">
    <thead>
        <tr>
            <th>Name</th><th>Front Color</th><th>Back Color</th><th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($cardTypes as $type): ?>
        <tr id="type-<?php echo $type['id'] ?>">
            <td class="editable" id="card_types-name-<?php echo $type['id'] ?>"><?php echo $type['name'] ?></td>
            <td class="editable" id="card_types-front_color-<?php echo $type['id'] ?>"><?php echo $type['front_color'] ?></td>
            <td class="editable" id="card_types-back_color-<?php echo $type['id'] ?>"><?php echo $type['back_color'] ?></td>
            <td class="action">
                <a href="#delete" onclick="return cardTypeDeleteConfirmation('<?php echo $type['id'] ?>')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<h2>Workflow States</h2>
<a href="#add-status" onclick="return $('#status-dialog').dialog('open')">Add Wrokflow State</a>
<table id="status-names">
    <thead>
        <tr>
            <th>Name</th><th>WIP Limit</th><th>WIP Column<sup>(?)</sup></th><th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($statusNames as $status): ?>
        <tr id="type-<?php echo $status['id'] ?>">
            <td class="editable" id="status_names-name-<?php echo $status['id'] ?>"><?php echo $status['name'] ?></td>
            <td class="editable" id="status_names-WIP-<?php echo $status['id'] ?>"><?php echo $status['WIP'] ?></td>
            <td class="editable" id="status_names-WIP_column-<?php echo $status['id'] ?>"><?php echo $status['WIP_column'] ?></td>
            <td class="action">
                <a href="#up" onclick="return downStatusSl('<?php echo $status['id'] ?>')">Down</a>
                <a href="#down" onclick="return upStatusSl('<?php echo $status['id'] ?>')">Up</a>
                <a href="#delete" onclick="return cardTypeDeleteConfirmation('<?php echo $status['id'] ?>')">Delete</a>
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




<script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/settings.js"></script>

<?
print_r($statusNames);
//print_r($cardTypes);


