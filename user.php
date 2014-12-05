<?php 
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/users.php');
	include_once('database/answers.php');

	include('lock.php');
	include('templates/header.php');
	include('templates/navbar.php');

	if(isset($_GET['filter'])) {
		if($_GET['filter'] == 'personal') {
		
			$params = array($db, $_SESSION['myid']);
			$title = 'My Polls';
			$result = getUserPolls($params);
		} else if($_GET['filter'] == 'public') {
		
			$title = 'Public Polls';
			$result = getPublicPolls($db);
		}
		else {

			$params = array('db' => $db, 'id' => $_SESSION['myid']);
			$title = 'All Polls';
			$result = getAllPolls($params);
		}
	}
	else {

		$params = array('db' => $db, 'id' => $_SESSION['myid']);
		$title = 'All Polls';
		$result = getAllPolls($params);
	}
?>

<!-- User polls -->
<div class="panel panel-primary">

	<div class="panel-heading">
		<div class="panel-title">
			<div class="dropdown">
			  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
				<?= $title ?>
				<span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="user.php?filter=all" <?php if($title == 'All Polls') echo 'style="color:green;"'; else echo 'style="color:grey;"'; ?> >All Polls</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="user.php?filter=public" <?php if($title == 'Public Polls') echo 'style="color:green;"'; else echo 'style="color:grey;"'; ?> >Public Polls</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="user.php?filter=personal" <?php if($title == 'My Polls') echo 'style="color:green;"'; else echo 'style="color:grey;"'; ?> >My Polls</a></li>
			  </ul>
			</div>
		</div>
	</div>

	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title details-title" id="myModalLabel"></h4>
		  </div>
		  <div class="modal-body details-body">
		  </div>
		  <div class="modal-footer details-footer">
			<button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="panel-body">
	
		<table class="table">
			
			<tr>
				<th>Title</th>
				<th>Owner</th>
				<th>Public</th>
				<th>Answers</th>
				<th colspan="10"></th>
			</tr>
			<tr><td colspan="10"></td></tr>
			
			<?php foreach($result as $row) { ?>
			
				<tr>
					<td>
						<?=$row['description']?>
					</td>
					<td>
						<?php
							$paramsUser = array('db' => $db, 'id' => $row['user_id']);
							$username = getUsernameById($paramsUser);
							echo $username;
						?>
					</td>
					<td>
						<?php if($row['public'] == 1)
						echo '<span style="color: green" class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
						else echo '<span style="color: red" class="glyphicon glyphicon-remove" aria-hidden="true"></span>';?>
					</td>
					<td>
						<?=$row['number_of_answers']?>
						<!--<span class="badge">42</span>-->
					</td>
					<td><a href="javascript: sharePoll(<?=$row['id']?>)" title="Share this poll">
						<span style="color: green" class="glyphicon glyphicon-share" aria-hidden="true"></span>
					</a></td>
					<td><a href="answer_poll.php?id=<?=$row['id']?>" title="Answer this poll">
						<span style="color: green;" class="glyphicon glyphicon-edit" aria-hidden="true"></span>
					</a></td>
					<td><a href="javascript: getDetails(<?=$row['id']?>)" title="View Details">
						<span style="color: blue" class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-lg"></span>
					</a></td>
					<td><a href="javascript: viewStats(<?=$row['id']?>)" title="View Poll Statistics">
						<span style="color: blue" class="glyphicon glyphicon-stats" aria-hidden="true"></span>
					</a></td>
					<td><a href="edit_poll.php?id=<?=$row['id']?>" title="Edit Poll">
						<span style="color: blue" class="glyphicon glyphicon-cog" aria-hidden="true"></span>
					</a></td>
					<td><a href="javascript: confirmDelete(<?=$row['id']?>)" title="Delete Poll">
						<span style="color: red" class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a></td>
				</tr>
							
			<?php 	} ?>
		
		</table>
	
	</div>
	
</div>

<?php include('templates/footer.php'); ?>