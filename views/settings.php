<?php 
$statusNames = getStatusNames();
$cardTypes = getCardTypes();
?>

<h2>Card Types</h2>
<a href="#add-card-type">Add Card type</a>
<table id="card-types">
    <tr>
        <th>Name</th><th>Front Color</th><th>Back Color</th><th>&nbsp;</th>
    </tr>
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
</table>

<script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/settings.js"></script>

<?
print_r($statusNames);
print_r($cardTypes);


