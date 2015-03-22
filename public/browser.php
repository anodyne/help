<?php

require '../vendor/autoload.php';

$b = new Ikimea\Browser\Browser;

$browser = $b->getBrowser();
$currentVersion = $b->getVersion();

switch ($browser)
{
	case 'Firefox':
		$minVersion = 19.0;
		$updateLink = 'http://getfirefox.com';
	break;

	case 'Chrome':
		$minVersion = 18.0;
		$updateLink = 'http://google.com/chrome';
	break;

	case 'Internet Explorer':
		$minVersion = 9.0;
		$updateLink = 'http://windows.microsoft.com/en-us/internet-explorer/download-ie';
	break;
}

?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Error &bull; Anodyne Productions</title>

		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<style>
			body {
				color: #444;
				font-size: 16px;
				line-height: 1.75;
			}

			h1 {
				color: #0288d1;
			}
			h2 {
				color: #03a9f4;
			}

			.btn.btn-primary {
				margin: 1.5em 0;

				color: #fff;
				background: #0288d1;
				border-color: #0288d1;
			}
			.btn.btn-primary:hover, .btn.btn-primary:focus,
			.btn.btn-primary:active {
				background: #03a9f4;
				color: #fff;
				border-color: #03a9f4;
			}

			.text-info, .text-info:hover {
				color: #03a9f4;
			}
			.text-danger, .text-danger:hover {
				color: #e51c23;
			}

			.container {
				width: 700px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<h1 class="text-center">Anodyne Productions</h1>

			<div class="page-header">
				<h2>Uh oh!</h2>
			</div>

			<p>Unfortunately, it looks like you&rsquo;re using a browser that we don&rsquo;t support. This can be easily remedied by using another browser or updating your current browser.</p>

			<p>In order to use Anodyne Productions&rsquo; sites and services with <?php echo $browser;?> you need to be using at least version <strong class="text-info"><?php echo $minVersion;?></strong>, but you&rsquo;re only using version <strong class="text-danger"><?php echo $currentVersion;?></strong>.</p>

			<a href="<?php echo $updateLink;?>" class="btn btn-lg btn-block btn-primary">Update Your Browser Now</a>
		</div>
	</body>
</html>