<?php 
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/users.php');
	include_once('database/answers.php');
	include_once('database/poll_answers.php');

	include('lock.php');
	include('templates/header.php');
	include('templates/navbar.php');
	
	$title = $filter = '';
	$params = array('db' => $db, 'user_id' => $_SESSION['myid']);

	if(isset($_GET['filter'])) {
	
		$filter = $_GET['filter'];
		
		if($filter == 'personal') {

			$title = 'My Polls';
			$result = getUserPolls($params);
		} else if($filter == 'answered') {
		
			$title = 'Polls I Answered';
			$result = getAnsweredPolls($params);
			
		} else if($filter == 'public') {
		
			$title = 'Public Polls';
			$result = getPublicPolls($db);
		}
		else {

			$title = 'All Polls';
			$result = getAllPolls($params);
		}
	}
	else {

		$title = 'All Polls';
		$result = getAllPolls($params);
	}
?>

<!-- User polls -->
<div class="panel panel-primary">

	<div class="panel-heading">
		<div class="panel-title">
			<div class="dropdown">
			  <button title="Filter polls" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
				<?= $title ?>
				<span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="user.php?filter=all" <?php if($title == 'All Polls') echo 'style="color:green;"'; else echo 'style="color:grey;"'; ?> >All Polls</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="user.php?filter=answered" <?php if($title == 'Polls I Answered') echo 'style="color:green;"'; else echo 'style="color:grey;"'; ?> >Polls I Answered</a></li>
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
	
		<?php if(sizeof($result) > 0) { ?>
			
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
					<!-- POLL TITLE -->
					<td>
						<?=$row['description']?>
					</td>
					<!-- POLL TITLE -->
					<td>
						<?php
							$paramsUser = array('db' => $db, 'id' => $row['user_id']);
							$username = getUsernameById($paramsUser);
							if($username == $_SESSION['myname']) {
								echo '<b>' . $username . '</b>';
							}
							else {
								echo $username;
							}
						?>
					</td>
					<td>
						<?php if($row['public'] == 1)
						echo '<span style="color: green" class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
						else echo '<span style="color: red" class="glyphicon glyphicon-remove" aria-hidden="true"></span>';?>
					</td>
					<td>
						<?=$row['number_of_answers']?>
					</td>
					<!-- SHARE POLL -->
					<?php 
						if($username == $_SESSION['myname']) { ?>
						<td><a href="share_poll.php?id=<?=$row['id']?>" title="Share this poll">
							<span style="color: green" class="glyphicon glyphicon-share" aria-hidden="true"></span>
						</a></td>
					<?php } else { ?>
						<td>
							<span style="color: black" title="Sharing is not available for the current user" class="glyphicon glyphicon-share" aria-hidden="true"></span>
						</td>
					<?php } ?>
					<!-- ANSWER POLL -->
					<?php if(($title == 'Polls I Answered') || checkIfUserAnswered(array('db' => $db, 'user_id' => $_SESSION['myid'], 'id' => $row['id']))) { ?>
						<td>
							<span style="color: black" title="You have already answered this poll" class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</td>
					<?php } else { ?>
						<td><a href="answer_poll.php?id=<?=$row['id']?>" title="Answer this poll">
							<span style="color: green" class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a></td>
					<?php } ?>
					<!-- VIEW POLL DETAILS -->
					<td><a href="javascript: getDetails(<?=$row['id']?>)" title="Short Info">
						<span style="color: blue" class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-lg"></span>
					</a></td>
					<!-- VIEW POLL STATISTICS -->
					<?php if($row['number_of_answers'] > 0) { ?>
						<td>
							<a href="view_poll_detailed.php?id=<?=$row['id']?>&filter=<?=$filter?>"><span style="color: blue" title="Detailed view" class="glyphicon glyphicon-stats" aria-hidden="true"></span></a>
						</td>
					<?php } else {?>
						<td>
							<span style="color: black" title="Detailed view is unavailable since there are no answers" class="glyphicon glyphicon-stats" aria-hidden="true"></span></a>
						</td>
					<?php } ?>
					<!-- EDIT POLL -->
					<?php
					if($username == $_SESSION['myname']) {
						if($row['number_of_answers'] > 0) { ?>
							<td>
								<span style="color: black" title="This poll has answers and can no longer be edited" class="glyphicon glyphicon-cog disabled" aria-hidden="true"></span>
							</td>
						<?php } else { ?>
							<td><a href="edit_poll.php?id=<?=$row['id']?>" title="Edit Poll">
								<span style="color: blue" class="glyphicon glyphicon-cog" aria-hidden="true"></span>
							</a></td>
						<?php } ?>
						<!-- DELETE POLL -->
						<td><a href="javascript: confirmDelete(<?=$row['id']?>)" title="Delete Poll">
							<span style="color: red" class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</a></td>
					<?php } else { ?>
						<td>
							<span style="color: black" title="Editing is not available for the current user" class="glyphicon glyphicon-cog disabled" aria-hidden="true"></span>
						</td>
						<td>
							<span style="color: black" title="Deleting is not available for the current user" class="glyphicon glyphicon-trash disabled" aria-hidden="true"></span>
						</td>
					<?php } ?>
					
				</tr>
							
			<?php 	} ?>
			
		</table>
			
		<?php } else { ?>
		<ul class="list-group">
			<li class="list-group-item">There are no polls</li>
		</ul>
		<?php } ?> 
		
		
	
	</div>
	
</div>

<?php include('templates/footer.php'); ?>