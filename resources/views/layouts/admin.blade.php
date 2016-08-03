<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<title></title>

		<link rel="stylesheet" type="text/css" href="http://localhost:82/assets/css/global.css">
		<meta name="viewport" content="width=device-width , initial-scale:1.0, user-scalabel=0">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>

	<body>
		<div id="header">
			<div class="logo">
				<a href= "#">
					<span>Butterfly</span>
				</a>
			</div>
		</div>

		

		<a class="mobile" href="#">Menu</a>

		

		<div id="container">
			<div class="sidebar">
				<ul id="nav">
					<li>
						<a class="selected" href="#">Dashboard</a>
						<a href="{{route('admin.users.index')}}">Users</a>
						<a href="{{route('users.scores.index')}}">Scores</a>
					</li>
				</ul>
			</div>



			<div class="content">
				@yield('content')
				<div id="box">
					<div class="box-top">
						News
					</div>
					<div class="box-panel">
						This is some simple news
					</div>			
				</div>
			</div>
		</div>
	</body>
</html>