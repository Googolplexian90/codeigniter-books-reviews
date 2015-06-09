<?php $rating = ['zero','one','two','three','four','five']; ?>
<div class="row">
	<main class="col-xs-12 col-sm-9 col-md-8">
		<h1>Recent Book Reviews:</h1>
		<?php foreach($reviews as $review){ ?>
		<div class="review">
			<h3><?= $review->book->title ?></h3>
			<span class="rating <?= $rating[$review->rating] ?>"></span>
			<p><a href="/users/<?= $review->user->id ?>"><?= $review->user->alias ?></a> says: <?= $review->review ?></p>
			<p><small>Posted on <?= strftime("%b %#d, %Y",strtotime($review->created_at)) ?><?php if($review->user->id == $this->session->userdata('user')['id']) {?> | <a href="/reviews/delete/<?= $review->id ?>">Delete</a><?php } ?></small></p>
		</div>
		<?php } ?>
	</main>
	<aside class="col-xs-12 col-sm-3 col-md-4">
		<h4>Other Books with Reviews</h4>
		<div class="list-group">
			<?php foreach($books as $book){ ?>
			<a href="/books/<?= $book->id ?>" class="list-group-item"><?= $book->title ?></a>
			<?php } ?>
		</div>
	</aside>
</div>