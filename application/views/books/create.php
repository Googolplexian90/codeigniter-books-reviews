<div class="row">
	<main class="col-xs-12">
		<h1>Add a New Book Title and a Review:</h1>
		<form action="/books/create" method="post">
			<div class="form-group">
				<label for="title">Book Title:</label><input type="text" name="title" class="form-control">
			</div>
			<div class="form-group">
				<label for="author">Author:</label>
				<p>Choose from the list</p><select name="author">
					<option>Author</option>
					<option>Author</option>
					<option>Author</option>
					<option>Author</option>
					<option>Author</option>
				</select>
				<p>Or add a new author:</p><input type="text" name="new_author">
			</div>
			<div class="form-group">
				<label for="review">Review:</label>
				<textarea name="review" class="form-control"></textarea>
			</div>
			<div class="form-group">
				<label for="rating">Rating: <input type="number" min="1" max="5" name="rating"> stars</label>
			</div>
			<button type="submit">Add Book and Review</button>
		</form>
	</main>
</div>