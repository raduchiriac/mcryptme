<html>
	<head>
		<title>mCrypt me</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	</head>
	<body style="padding:10%">
		<form class="form-horizontal">
			<fieldset>
				<!-- Form Name -->
				<legend>Encrypt</legend>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="key"></label>
					<div class="col-md-4">
						<input id="key1" name="key1" type="password" placeholder="Key" class="form-control input-md" required="">
					</div>
				</div>
				<!-- Textarea -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="plaintext"></label>
					<div class="col-md-12">
						<textarea class="form-control" rows="10" id="plaintext" name="plaintext" required="" placeholder="Plain text"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label" for="button1id">Action</label>
					<div class="col-md-8">
						<button id="button2id" name="button2id" class="btn btn-danger btn-encrypt">Encrypt</button>
					</div>
				</div>
			</fieldset>
		</form>
		<form class="form-horizontal">
			<fieldset>
				<!-- Form Name -->
				<legend>Decrypt</legend>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="key"></label>
					<div class="col-md-4">
						<input id="key2" name="key2" type="password" placeholder="Key" class="form-control input-md" required="">
					</div>
				</div>
				<!-- Textarea -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="plaintext"></label>
					<div class="col-md-12">
						<textarea class="form-control" rows="10" id="encryptedtext" name="encryptedtext" required="" placeholder="Encrypted text"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label" for="button1id">Action</label>
					<div class="col-md-8">
						<button id="button2id" name="button2id" class="btn btn-success btn-decrypt">Decrypt</button>
					</div>
				</div>
			</fieldset>
		</form>
		<hr/>
		<div class="col-md-12">
			<textarea class="reply form-control" rows="10"></textarea>
		</div>
		<script src="ajax.js"></script>
	</body>
</html>