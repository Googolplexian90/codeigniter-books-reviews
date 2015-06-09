<?php if($this->session->userdata('user')) { ?>
		<div id="new-book" class="modal fade" tabIndex="-1" role="dialog" aria-hidden="true" aria-label="Add New Book (and Review)">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Add a New Book Title and a Review:</h4>
					</div>
					<div class="modal-body">
						<form action="/books/create" method="post">
							<div class="form-group">
								<label for="title">Book Title:</label><input type="text" name="title" class="form-control">
							</div>
							<div class="form-group">
								<label for="author">Author:</label>
								<p>Choose from the list</p><select name="author">
									<option default selected disabled value="">Select an Author</option>
								<?php foreach($authors as $author){ ?>
									<option value="<?= $author->id ?>"><?= $author->first_name . ' ' . $author->last_name ?></option>
								<?php } ?>
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
							<button type="submit" class="btn btn-primary">Add Book and Review</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div><!-- /#new-book -->
<?php } ?>
		</div> <!-- /.container -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/script.js" type="text/javascript"></script>
    </body>
</html>