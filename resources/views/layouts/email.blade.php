<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<style>
			@import(http://fonts.googleapis.com/css?family=Open+Sans:400,600);
			@import(http://fonts.googleapis.com/css?family=Bitter:700);
			@import(http://fonts.googleapis.com/css?family=Exo+2:500italic,600italic);

			body {
				font-family: "Open Sans", helvetica, arial, sans-serif;
				font-size: 16px;
				line-height: 1.75;
				color: #444;
				background-color: #ebebeb;
			}

			h1 {
				margin: 0;

				font-family: "Bitter", times, georgia, serif;
				font-weight: 700;
				color: #0288d1;
			}
			h2 {
				margin: 0;

				font-family: "Exo 2", helvetica, arial, sans-serif;
				font-weight: 500;
				font-style: italic;
				color: #03a9f4;
			}

			a {
				color: #0288d1;
			}
			a:hover {
				color: #03a9f4;
			}

			strong {
				font-weight: 600;
			}

			hr {
				width: 75%;
				height: 0;
				margin-top: 20px;
				margin-bottom: 20px;

				border: 0;
				border-top: 1px solid #dbdbdb;
			}

			table {
				width: 90%;
				margin: 15px auto;
			}
			table thead tr td {
				height: 90px;

				background-color: #0288d1;
				color: #fff;
				text-align: center;
				font-size: 32px;
				font-weight: 600;
				font-family: "Exo 2", helvetica, arial, sans-serif;
				font-style: italic;
				text-shadow: 0 1px 2px rgba(0, 0, 0, .25);
				letter-spacing: 0.01em;
				border: 1px solid #01579b;
			}
			table tbody tr td {
				padding: 10px;

				background-color: #fbfbfb;
				border-left: 1px solid #ccc;
				border-right: 1px solid #ccc;
				border-bottom: 1px solid #ccc;
			}
		</style>
	</head>
	<body>
		<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<td>Anodyne Productions</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>@yield('content')</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>