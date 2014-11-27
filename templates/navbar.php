<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	  
      <form method="GET" action="user.php" class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input id="hsearch" type="text" class="form-control" placeholder="Search polls..." name="query">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>
	  
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= $_SESSION['myname'] ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">My Polls</a></li>
            <li><a href="#">Polls I Answered</a></li>
            <li><a href="#">My Friends</a></li>
            <li class="divider"></li>
            <li><a href="#">Settings</a></li>
          </ul>
        </li>
        <li><a class="close" href="logout.php" title="Logout">&times;</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>