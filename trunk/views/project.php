<?php
$projectId = intval($_GET['id']);

$statusNames = Db::getResult('SELECT * FROM status_names ORDER BY serial');
$project = Db::getRow('SELECT * FROM projects WHERE id = ?', $projectId);

if($project):
$cards = Db::getResult('SELECT * FROM cards WHERE project_id = ?', $projectId);
?>

<h2><?php echo $project['name'] ?> </h2>

<a href="#create-card" onclick="$('#cardForm').slideToggle()">New Card</a>
<form id="cardForm" name="cardForm" onsubmit="return createCard()" class="invisible">
    <label>Card Title</label>
    <input type="text" name="title" id="title" size="50"/>
    <input type="hidden" name="project" value="<?php echo $project['id'] ?>" />
    <input type="submit" value="Create">
</form>

<table id="card-table" align="center" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
        <?php foreach($statusNames as $status): ?>
            <th class="<?php if($status['th_column'] < 1) echo 'sub-state' ?>">
                <?php echo $status['name'] ?>
            </th>
        <?php endforeach; ?>
        </tr>
        
        <tr id="thresholds">
        <?php foreach($statusNames as $status): ?>
            <?php if($status['th_column'] > 0): ?>
            <th colspan="<?php echo $status['th_column'] ?>">
                <?php  echo ($status['threshold'] == '0')? '&infin;' :  $status['threshold'] ?>
            </th>
            <?php endif; ?>
        <?php endforeach; ?>
        </tr>
    </thead>

    <tbody>
        <tr>
        <?php foreach($statusNames as $status): ?>
            <td id="status-<?php echo $status['id'] ?>" 
                valign="top"
                threshold="<?php echo $status['threshold']?>"
                class="<?php if($status['th_column'] < 1) echo 'sub-state' ?>">

            <?php foreach($cards as $card): ?>
                <?php if($card['status_id'] == $status['id']): ?>
                <div class="card" id="card-<?php echo $card['id']; ?>"><?php 
                    echo stripcslashes($card['body']);
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
        <span class="actions">
            <a href="#edit-card" onclick="$('#card-dialog .editable').click()">edit</a>
            <a href="#delete-card" onclick="return cardDeleteConfirmation()">delete</a>
        </span>
        
        <div id="no-card" class="active-card editable"></div>
    </div>

<style type="text/css"><?php foreach($statusNames as $status): ?>
    #status-<?php echo $status['id'] ?> .card{
        color: <?php echo $status['front_color'] ?>;
        background-color: <?php echo $status['back_color'] ?>;
    }
    <?php endforeach; ?>
</style>
<script type="text/javascript" src="<?php echo $config['baseurl'] ?>/assets/js/card.js"></script>
