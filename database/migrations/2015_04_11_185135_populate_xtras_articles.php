<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateXtrasArticles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$articles = [
			['title' => "Registering to Download Xtras", 'slug' => "", 'summary' => "Why do I need to register to download Xtras?", 'content' => "In order to provide notification services when an Xtra is updated, you need to have an account. This also allows you to have a complete history of your download history.", 'keywords' => 'register, download', 'featured' => 1, 'tags' => [1, 5]],

			['title' => "Reporting Issues with an Xtra", 'slug' => "", 'summary' => "I found an issue with an Xtra, how do I report it to the developer?", 'content' => "On the Xtra's page, there's a button to Report an Issue. That message will go straight to the Xtra developer for them to look into. Anodyne Productions isn't responsible for other authors' content, so issues should not be reported to Anodyne unless it pertains to potential abuse.", 'keywords' => 'issues', 'featured' => 1, 'tags' => [5]],

			['title' => "Reporting an Xtra", 'slug' => "", 'summary' => "I think an Xtra is doing something malicious or wrong that Anodyne Productions should be aware of, how do I report that?", 'content' => "On the Xtra's page, there's a button to Report Abuse. That message will come straight to us and we'll look into the abuse immediately. Abuse reports are anonymous to the author of the Xtra and your information will never be shared with the author.", 'keywords' => 'report, abuse', 'tags' => [5]],

			['title' => "One Xtra for Multiple Versions of Nova", 'slug' => "", 'summary' => "Can I have an Xtra that targets multiple versions of Nova?", 'content' => "No. We considered allowing this, but in the end, we felt it would've created more confusion if a user went to the same place to get different versions of an Xtra. It would be easy to accidentally get the wrong version. By forcing Xtras to have separate versions for each version of Nova, everything from preview images, version history, installation instructions, and downloads are clearer.", 'keywords' => 'versions', 'tags' => [5]],

			['title' => "More Preview Images", 'slug' => "", 'summary' => "Can I have more than 3 preview images for my Xtra?", 'content' => "No. We have decided on allowing 3 preview images at this point.", 'keywords' => 'images, preview', 'tags' => [5]],

			['title' => "Create Rank Set Xtras", 'slug' => "", 'summary' => "Why can’t I create a rank set Xtra?", 'content' => "Because of how complicated the rank system is in Nova 1 and 2, there are a limited number of users with access to create rank set Xtras. In the future, when Nova 3 is released, we'll open it up to more people. If you have a rank set you'd like to share, contact us and we'll consider providing you access to create a new rank set Xtra.", 'keywords' => 'rank set', 'tags' => [5]],

			['title' => "Errors When Creating Xtras for Multiple Versions of Nova", 'slug' => "", 'summary' => "I have an Xtra that I'm releasing for multiple versions of Nova, but when I try to create the second version, it tells me I already have an Xtra with that name. Help!", 'content' => "We use slugs for identifying specific Xtras. What that means is that we take the name of an Xtra and replace spaces with dashes (-) and strip special characters. So if you have an Xtra name \"My Awesome Xtra\", it's slug will be `my-awesome-xtra`. If you try to create \"My Awesome Xtra\" for Nova 1 and then \"My Awesome Xtra\" for Nova 2, it won't let you create the second version because you already have an Xtra with the slug of `my-awesome-xtra`.\r\n\r\nTo get around this limitation (something we had to figure out for all of our own Xtras), name your Xtras with a Nova version number: \"My Awesome Xtra Nova 1\". After you've created the Xtra, upload the file, and uploaded your preview images, go back and edit the Xtra and remove the \"Nova 1\" piece of the name. The slug won't change, so the slug will remain `my-awesome-xtra-nova-1`, but you'll have a cleaner name.", 'keywords' => 'error, versions', 'tags' => [5]],
		];

		foreach ($articles as $article)
		{
			$article['product_id'] = 4;
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
		Article::where('product_id', 4)->delete();
	}

}
