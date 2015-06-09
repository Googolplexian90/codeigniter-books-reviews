<?php $rating = ['zero','one','two','three','four','five']; ?>
<div class="row">
	<main class="col-xs-12 col-sm-9 col-md-8">
		<h1><?= $book->title ?></h1>
		<h4>Author: <?= $book->author->first_name . ' ' . $book->author->last_name ?></h4>
		<h2>Reviews</h2>
		<?php foreach($reviews as $review) {?>
		<div class="review">
			<span class="rating <?= $rating[$review->rating] ?>"></span>
			<p><a href="/users/<?= $review->user->id ?>"><?= $review->user->alias ?></a> says: <?= $review->review ?></p>
			<p><small>Posted on <?= strftime("%b %#d, %Y",strtotime($review->created_at)) ?><?php if($review->user->id == $this->session->userdata('user')['id']) {?> | <a href="/reviews/delete/<?= $review->id ?>">Delete</a><?php } ?></small></p>
		</div>
		<? } ?>
	</main>
	<aside class="col-xs-12 col-sm-3 col-md-4">
		<h3>Add a review:</h3>
		<form action="/reviews/create/<?= $book->id ?>" method="post">
			<div class="form-group">
				<textarea name="review" class="form-control"></textarea>
			</div>
			<div class="form-group">
				<label for="rating">Rating <input type="number" min="1" max="5" name="rating" class="form-control col-xs-3 col-sm-2 col-md-1"> stars</label>
			</div>
			<button class="btn btn-primary" type="submit">Submit Review</button>
		</form>
	</aside>
</div>