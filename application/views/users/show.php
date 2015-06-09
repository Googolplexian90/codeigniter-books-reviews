<div class="row">
	<div class="col-xs-12">
		<h2>User Alias: <?= $user->alias ?></h2>
		<h4>Name: <?= $user->name ?></h4>
		<h4>Alias: <?= $user->alias ?></h4>
		<h4>Total Reviews: <?= count($reviews) ?></h4>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<h3>Posted Reviews on the following books:</h3>
		<ul>
<?php $used = array();
foreach($reviews as $review) { 
	if(!in_array($review->book->id,$used)) { ?>
			<li><a href="/books/<?= $review->book->id ?>"><?= $review->book->title ?></a></li>
<?php array_push($used,$review->book->id);
	}
} ?>
		</ul>
	</div>
</div>