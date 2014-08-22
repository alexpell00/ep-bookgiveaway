<?php
	$id = $_POST['book'];
	$title;
	$author;
	$blurb;
	$filename;
	$cover;

	$sql = "SELECT * FROM Books WHERE id=$id";
	$sqlAccount = new mysqli('localhost', 'user-1941', 'mDfj()la.8In3', 'EP_GiveAways');
	$result = $sqlAccount->query($sql);
	$sqlAccount->close();
	$wasFound = false;
	if ($result != false){
		while($row = $result->fetch_assoc()){
		    $title = $row['title'];
		    $author = $row['author'];
		    $blurb = $row['blurb'];
		    $filename = $row['filename'];
		    $cover = $row['coverImage'];
		    $wasFound = true;
		}
	}

	if ($wasFound){
	?>
		<div class="row" style="height: 100%">
			<div class="col-lg-0"></div>
			<div class="col-lg-12">
				<div>
					<div class='row'>
						<h2 style="color: #000000; text-indent: 0px;"><?php echo($title); ?></h2>
						<h4 style="color: #000000; text-indent: 0px;">By: <?php echo($author); ?> </h4>
						<br>
						<div class="col-md-6">
						<img src="/covers/<?php echo($cover); ?>">
						</div>
						<div class="col-md-6">
							 <br><br>
								<div class="col-md-0"></div>
								<div class="col-md-12">
									<div>
										<div id='error' style="height: 70px;"></div>
										<div class="row">
											<div class="col-xs-12">
												<div class="input-group">
													<div class="input-group-addon">@</div>
													<input id='email' class="form-control" type="email" placeholder="Enter email">
												</div>
											</div>
											<div class="col-xs-0"></div>
										</div>
										<br>
										<span style="color: grey; font-size: 12px;">
											By clicking submit you are agreeing to be signed up for the Entangled news letter
										</span>
										<br><br>
										<div class='row'>
											<div class="col-xs-6">
												<button id="subscribe" onclick="buttonClick()" style="width: 100%" type="button" class="btn btn-primary">Submit</button>
											</div>
											<div class="col-xs-6"></div>
										</div>
									</div>
								</div>
								<div class="col-md-0"></div>
							</div>
							<div class="form-group">
								
							</div>
						</div>
					</div>
					<br><br>
					<?php echo($blurb); ?>
				</div>
			</div>
			<div class="col-lg-0"></div>
		</div>

		<br><br><br><br><br><br><br>
	<?php 
	}
	?>