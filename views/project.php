<link href="<?php echo $config['baseurl'] ?>/assets/css/card.css" type="text/css" rel="stylesheet" />
<?php
$projectId = intval($_GET['id']);

$statusNames = getStatusNames();
$cardTypes = getCardTypes();
$project = getProject($projectId);

if($project):
$cards = Db::getResult('SELECT * FROM cards WHERE project_id = ?', $projectId);
?>
<div id="page-header">
    <h2><?php echo $project['name'] ?> </h2>
    <div class="add-form-holder">
        <a id="create-card" href="#create-card"  class="ui-link ui-state-default ui-corner-all">
            <span class="ui-icon ui-icon-plusthick"></span>Add New Card
        </a>
        <form id="card-form" name="card-form" onsubmit="return createCard()" class="invisible">
            <label>Card Title</label>
            <input type="text" name="title" id="title" size="70"/>
            <label>type</label>
            <select name="card_type" id="card_type">
                <?php foreach($cardTypes as $cardType): ?>
                <option value="<?php echo $cardType['id'] ?>"><?php echo $cardType['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="project" value="<?php echo $project['id'] ?>" />
            <input type="submit" value="Create">
        </form>

        <div id="type-legend">
            <?php foreach($cardTypes as $cardType): ?>
            <span class="card-type-<?php echo $cardType['id'] ?>">
                  <?php echo $cardType['name'] ?>
            </span>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<table id="card-table" align="center" cellspacing="0" cellpadding="0" class="ui-widget">
    <thead class="ui-widget-header">
        <tr class="ui-state-focus state-names">
        <?php foreach($statusNames as $status): ?>
            <th class="<?php if($status['WIP_column'] < 1) echo 'sub-state' ?>">
                <?php echo $status['name'] ?>
            </th>
        <?php endforeach; ?>
        </tr>
        
        <tr id="WIPs" class="ui-state-active wips">
        <?php foreach($statusNames as $status): ?>
            <?php if($status['WIP_column'] > 0): ?>
            <th colspan="<?php echo $status['WIP_column'] ?>">
                <?php  echo ($status['WIP'] == '0')? '&infin;' :  $status['WIP'] ?>
            </th>
            <?php endif; ?>
        <?php endforeach; ?>
        </tr>
    </thead>

    <tbody class="ui-widget-content">
        <tr class="ui-state-default">
        <?php foreach($statusNames as $status): ?>
            <td id="status-<?php echo $status['id'] ?>" 
                wip="<?php echo $status['WIP']?>"
                class="<?php if($status['WIP_column'] < 1) echo 'sub-state' ?>">

            <?php foreach($cards as $card): ?>
                <?php if($card['status_id'] == $status['id']): ?>
                <div class="card <?php echo 'card-type-'.$card['card_type_id'] ?>" id="card-<?php echo $card['id']; ?>"><?php
                    printCard($card);
                ?></div>
                <?php endif; ?>
            <?php endforeach; ?><!-- $stories -->
            </td>
        <?php endforeach; ?><!-- $statusNames -->
        </tr>
    </tbody>
</table>

<?php else: ?>
    Project not found
<?php endif; ?>

    <div id="card-dialog" title="Card">
        <span class="info small">Created on 00/00/00</span>
        <span class="actions">
            <a href="#edit-card" onclick="$('#card-dialog .editable').click()">edit</a>
            <a href="#delete-card" onclick="return cardDeleteConfirmation()">delete</a>
        </span>
        
        <div id="no-card" class="active-card editable"></div>
    </div>

<style type="text/css"><?php foreach($cardTypes as $cardType): ?>
    .card-type-<?php echo $cardType['id'] ?>{
        color: <?php echo $cardType['front_color'] ?>;
        background-color: <?php echo $cardType['back_color'] ?>;
    }
    <?php endforeach; ?>
</style>
<script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/card.js"></script>