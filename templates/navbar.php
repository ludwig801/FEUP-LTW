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
	  
		<ul class="nav navbar-nav navbar-left">
			<a href="create_poll.php">
				<button type="button" class="btn btn-success navbar-btn">
					<span style="color:white" class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
					Create Poll
				</button>
			</a>
			
			<button type="button" class="btn btn-default navbar-btn" style="visibility:hidden">
				<span style="color:black" class="glyphicon glyphicon-list" aria-hidden="true"></span>
			</button>
			
			<a href="user.php?filter=all">
				<button type="button" class="btn btn-default navbar-btn">
					<span style="color:black" class="glyphicon glyphicon-list" aria-hidden="true"></span>
					List All Polls
				</button>
			</a>
		</ul>
		
		<ul class="nav navbar-nav navbar-right">
			
			<form class="navbar-form navbar-left" method="GET" action="public_polls.php" role="search">
				<div class="form-group">
					<input id="hsearch" type="text" class="form-control" placeholder="Search polls..." name="query">
				</div>
				<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
			</form>
			
			<div class="btn-group">
			  <a href="user.php" type="button" class="btn btn-primary navbar-btn"><?= $_SESSION['myname'] ?></a>
			  <button type="button" class="btn btn-primary dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">
				<span class="caret"></span>
				<span class="sr-only">Toggle Dropdown</span>
			  </button>
			  <ul class="dropdown-menu" role="menu">
				<li><a href="user.php">Main Page</a></li>
				<!--<li><a href="#">Edit Poll</a></li>-->
				<li class="divider"></li>
				<li class="disabled"><a href="#">My Answered Polls</a></li>
				<!--<li class="divider"></li>-->
				<li><a href="user.php?filter=personal">My Polls</a></li>
				<li class="divider"></li>
				<li class="disabled"><a href="#">Settings</a></li>
				<li><a href="logout.php">Logout</a></li>
			  </ul>
			</div>
			
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= $_SESSION['myname'] ?><span class="caret"></span></a>
			  <ul class="dropdown-menu" role="menu">
				
			  </ul>
			</li>
		 </ul>

    </div>
  </div>
</nav>