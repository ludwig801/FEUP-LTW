<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	  
	<?php if(isset($_SESSION['guest'])) { ?>
		<p class="navbar-text navbar-left"><a href="logout.php?signup=true" class="navbar-link"><b>Sign up</b></a> to be able to answer polls</p>
	<?php } else { ?>	
		<ul class="nav navbar-nav navbar-left">
			<a href="create_poll.php">
				<button type="button" class="btn btn-success navbar-btn" title="Create a new poll">
					<span style="color:white" class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
					Create Poll
				</button>
			</a>
		</ul>		
	<?php } ?>
	
	<ul class="nav navbar-nav navbar-right">
	
		<?php if(!isset($_SESSION['guest'])) { ?>
			<a href="poll_token.php" class="navbar-left">
				<button type="button" class="btn btn-warning navbar-btn" title="Tokens are used to answer polls without search. They also allow you to answer private polls.">
					<span style="color:white" class="glyphicon glyphicon-tag" aria-hidden="true"></span>
					Use Token
				</button>
			</a>
			
			<!-- JUST TO SET SPACING-->
			<button type="button" class="btn navbar-btn navbar-left" style="visibility: hidden">
			</button>
		<?php }?>
		
		<form class="navbar-form navbar-left" method="GET" action="user.php" role="search">
			<div class="form-group">
				<input id="hsearch" type="text" class="form-control" placeholder="Search polls..." name="query">
			</div>
			<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
		</form>
		
		<!-- JUST TO SET SPACING-->
		<button type="button" class="btn navbar-btn navbar-left" style="visibility: hidden">
		</button>
		
		<div class="btn-group">
		  <a href="user_page.php" type="button" class="btn btn-primary navbar-btn" <?php if(isset($_SESSION['guest'])) echo 'disabled'; ?>><?= $_SESSION['myname'] ?></a>
		  <button type="button" class="btn btn-primary dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">
			<span class="caret"></span>
			<span class="sr-only">Toggle Dropdown</span>
		  </button>
		  <ul class="dropdown-menu" role="menu">
			<?php if(!isset($_SESSION['guest'])) { ?>
				<li ><a href="user.php?filter=all">Polls Page</a></li>
				<li class="divider"></li>
				<li role="presentation"<?php if(isset($_SESSION['guest'])) echo 'class="disabled"'; ?>><a href="user_page.php">Settings</a></li>
			<?php } ?>
				<li><a href="logout.php">Logout</a></li>
		  </ul>
		</div>
	 </ul>

    </div>
  </div>
</nav>