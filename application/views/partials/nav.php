	<nav class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-menu">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" 
			<?php if($this->session->userdata('user')['id']>0) { echo 'href="/users/'.$this->session->userdata('user')['id'].'"';} ?>>Hello, <?= $this->session->userdata('user')['alias'] ?></a>
		</div>
		<div id="nav-menu" class="collapse navbar-collapse navbar-right">
			<ul class="nav navbar-nav">
				<li><a href="/books">Home</a></li> 
				<li><a data-toggle="modal" data-target="#new-book" href="#">Add Book and Review</a></li>
				<li class="divider"></li>
				<li><a href="/sign-out">Log out</a></li>
			</ul>
		</div>
	</nav>