<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Admin (PHR) </title>
		<link rel="icon" href="Img/logo.png">
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<script src="dist/sweetalert2.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="dist/sweetalert2.css">

	</head>
	<body>

		<script>

			swal({
				title: 'Select color',
				input: 'radio',
				inputOptions: {
					'#ff0000': 'Name',
					'#00ff00': 'Address',
					'#0000ff': 'CID'
				},

				// validator is optional
				inputValidator: function(result) {
					return new Promise(function(resolve, reject) {
						if (result) {
							resolve();
						} else {
							reject('You need to select something!');
						}
					});
				}
			}).then(function(result) {
				if (result) {
					swal({
						type: 'success',
						html: 'You selected: ' + result
					});
				}
			})
		</script>

	</body>
</html>