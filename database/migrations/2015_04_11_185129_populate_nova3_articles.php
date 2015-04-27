<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateNova3Articles extends Migration {

	protected $productId = 3;

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach ($this->articles() as $article)
		{
			$article['product_id'] = $this->productId;
			$article['user_id'] = 1;
			$article['published'] = (int) true;

			$tags = (array_key_exists('tags', $article)) ? $article['tags'] : null;
			unset($article['tags']);

			$item = Article::create($article);

			if ($tags)
			{
				$item->tags()->sync($tags);
			}
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Article::where('product_id', $this->productId)->delete();
	}

	protected function articles()
	{
		return [
			['title' => "Nova NextGen Requirements", 'slug' => "requirements", 'summary' => "The server and browser requirements for Nova 3", 'content' => "Nova NextGen's requirements are fairly simple and straightforward, but you'll want to verify that any server you're attempting to install it on have the requirements listed below.

<p class=\"alert alert-warning\">The first step of Nova's installation process is to check and make sure it can run on the server it's on. If any of those checks fail, you'll be shown what failed and will need to either contact your host about upgrading/enabling those items or find a host that supports the requirements.</p>

## PHP

Nova NextGen requires a server running __PHP 5.5__ or higher. Historically, many shared hosts are very slow to update to newer versions of PHP. You can contact your host about ways to use PHP 5.5 for your account. If it is not an option, you may need to look at switching hosts if you want to run Nova NextGen.

### PHP Extensions

In addition to PHP 5.5, several PHP extensions must be enabled for all of Nova's features to work. Those extensions include:

- MySQL PDO
- Mycrypt PHP extension
- OpenSSL PHP extension
- Mbstring PHP extension
- Tokenizer PHP extension

<p class=\"alert alert-warning\"><strong>Note:</strong> As of PHP 5.5, some OS distributions may require you to manually install the PHP JSON extension. Please contact your host about this if you have any questions.</p>

## Database

Since Nova is a database-driven system, it needs a database in order to run. Unlike previous versions of Nova, Nova NextGen is not tied exclusively to MySQL. In addition to MySQL, you can also use PostgreSQL to run your Nova site if you so choose.

<p class=\"alert alert-warning\">Additionally, Nova NextGen can also use SQLite for a fast, quick file-based database instead of needing to run a full MySQL/PostgreSQL database. <strong>This is only intended for development purposes and is not suitable for running a site in a production environment!</strong></p>

## A Browser

Since Nova is web-based software, you'll need a browser in order to use it. These days, there are a lot of browsers out there and most of them should work, but some of the older generation browser aren't supported because of their lack of support for technologies and tools used in Nova.

Our recommendation is to use __Google Chrome__ (version 30 or higher) or __Mozilla Firefox__ (version 20 or higher). In addition, we also support Safari as well as Internet Explorer 10 and higher. Make sure you have JavaScript and cookies enabled as many of Nova's features require them.", 'keywords' => "php, mysql, server, browser", 'featured' => 1, 'tags' => [1,10]],

			['title' => "Preview Release Changelog", 'slug' => "preview-release-changelog", 'summary' => "", 'content' => "## Coming in Preview Release 2

- Logging in and resetting passwords
- Basic admin control panel
- Page Manager
	- Basic page info
	- Page content
- Menu Manager

## What's in Preview Release 1

- Basic technology stack
- Application architecture
- Foundational elements
- Basic themeing elements
- Setup Center
	- Fresh install
	- Uninstall", 'keywords' => "preview, release, changelog", 'featured' => 1, 'tags' => [8]],

			['title' => "Installing the Preview Release", 'slug' => "install-preview-release", 'summary' => "Get a sneak peek into the future of Nova with the preview releases. They're easy to install and let you play around with the new features.", 'content' => "<p class=\"alert alert-warning\">Nova NextGen is provided \"as-is\" and doesn't have any support for it. You're free to ask questions in the forums, but understand that Anodyne will not provide walkthroughs and support for Nova NextGen at this time.</p>

Nova NextGen can be run from any web server running PHP 5.4 or higher with a MySQL, PostgreSQL, or SQLite database. You can also install Nova NextGen on a local server if you're running one, so long as it has PHP and a database.

1. Upload Nova NextGen to your server (or if it's a local server, copy the files to the location where you want it)
2. Navigate to `http://[yoursite]` and you'll be automatically redirected to the Setup Center
3. You may be prompted to make certain directories writable in order to continue. Laravel requires having the ability to create files for logging, caching, and other framework operations. You'll need to make the `config` and `storage` directories (as well as all their sub-directories) writable by the web server (777).
4. Select the option to do a Fresh Install of Nova NextGen and follow the prompts

Once Nova NextGen is installed, you'll be presented with a white screen with the words \"#NovaNextGen\" on it. That's as far as Preview Release 1 goes. In future preview releases, you'll be able to use more of the system as it's built.

_Theme developers:_ Much of the structure for themes is in place now. You can look through the `nova/views` directory to see what's there and read more in the Site Themes overview of the Nova NextGen Vision series.

_Extension developers:_ There hasn't been any work done on extensions yet, but in future preview releases we'll have more stuff for you to play with.", 'keywords' => "install, preview, release", 'featured' => 1, 'tags' => [1,3]],

			//['title' => "", 'slug' => "", 'summary' => "", 'content' => "", 'keywords' => "", 'tags' => []],
		];
	}

}
