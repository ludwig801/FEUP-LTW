<?php 
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/answers.php');

	include('lock.php');
	include('templates/header.php');
	include('templates/navbar.php');

	$params = array($db, $_SESSION['myid']);
	$result = getUserPolls($params);
?>

<!-- User polls -->
<div class="panel panel-primary">

	<div class="panel-heading">
		<div class="panel-title">My Polls</div>
	</div>
	
	<a href="javascript: getDetails(3)" >
		<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
			View Details
		</button>
	</a>
	
	
	
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
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
				<th>Public</th>
				<th>Answers</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
			<tr><td colspan="6"></td></tr>
			
			<?php foreach($result as $row) { ?>
			
				<tr>
					<td><?=$row['description']?></td>
					<td>
						<?php if($row['public'] == 1)
						echo '<span style="color: green;" class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
						else echo '<span style="color: red;" class="glyphicon glyphicon-remove" aria-hidden="true"></span>';?>
					</td>
					<td><?=$row['number_of_answers']?></td>
					<td><a href="poll_view_answers.php?id=<?=$row['id']?>">
						<span style="color: blue;" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
					</a></td>
					<td><a href="edit_poll.php?id=<?=$row['id']?>">
						<span style="color: blue;" class="glyphicon glyphicon-edit" aria-hidden="true"></span>
					</a></td>
					<td><a href="javascript: confirmDelete(<?=$row['id']?>);">
						<span style="color: red;" class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a></td>
				</tr>
							
			<?php 	} ?>
		
		</table>
	
	</div>
	
</div>

<?php include('templates/footer.php'); ?>