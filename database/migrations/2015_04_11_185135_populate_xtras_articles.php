<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateXtrasArticles extends Migration {

	protected $productId = 4;

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
			['title' => "Registering to Download Xtras", 'slug' => "", 'summary' => "Why do I need to register for an AnodyneID to download Xtras?", 'content' => "In order to provide notifications when an Xtra is updated, you need to have an account. This also allows you to have a complete history of your download history in the event you need to download an Xtra again.", 'keywords' => 'register, download, anodyneid', 'featured' => 1, 'tags' => [1,5]],

			['title' => "Reporting Issues with an Xtra", 'slug' => "", 'summary' => "I found an issue with an Xtra, how do I report it to the developer?", 'content' => "Sometimes, you may run into an issue with an Xtra you've downloaded and will need to contact the developer to notify them of the issue. When you're on the Xtra's page, you can click on the Report an Issue button and describe the issue in the pop-up. The information you enter will go straight to the Xtra developer.

<p class=\"alert alert-warning\">Anodyne Productions isn't responsible for other authors' content, so issues should not be reported to Anodyne unless it pertains to potential abuse.</p>", 'keywords' => 'issues', 'featured' => 1, 'tags' => [10]],

			['title' => "Reporting Abuse with an Xtra", 'slug' => "", 'summary' => "If you think an Xtra is doing something malicious or wrong that Anodyne Productions should be aware of, how do you report that?", 'content' => "Despite our best efforts, Anodyne Productions can't police every Xtra that's created. Sometimes, a developer does something that they shouldn't be doing. If you come across such a situation, you can report the Xtra for abuse from the Xtra's page. In the pop-up, describe what you think the abuse is and the message will go straight to Anodyne Productions and we'll look into the issue immediately.

<p class=\"alert alert-warning\">Abuse reports are anonymous to the author of the Xtra and your information will never be shared with the author.</p>", 'featured' => 1, 'keywords' => 'report, abuse', 'tags' => [10]],

			['title' => "One Xtra for Multiple Versions of Nova", 'slug' => "", 'summary' => "Can a single Xtra target multiple versions of Nova?", 'content' => "During development, we considered allowing Xtras to target multiple versions of Nova, but we were concerned doing so would create more confusion for both the author and users. It would be incredibly easy to download the wrong version and suddenly have errors on the user's site. For the sake of the user experience, we chose to force Xtras to only target a single version of Nova. This way, everything from preview images, version history, installation instructions, and downloads are crystal clear.", 'keywords' => 'versions', 'tags' => [5]],

			['title' => "More Than 3 Preview Images", 'slug' => "", 'summary' => "Can an Xtra have more than 3 preview images?", 'content' => "At this time, we only allow 3 preview images per Xtra. In the future, we may look to increase this number. If you feel there is a legitimate case where more than 3 preview images is needed, please contact us with your reasons and we'll consider them.", 'keywords' => 'images, preview', 'tags' => [5]],

			['title' => "Create Rank Set Xtras", 'slug' => "", 'summary' => "Why can't I create a rank set Xtra?", 'content' => "One of the most complicated components in Nova is the rank system. To avoid confusion and potential errors, we've decided to restrict creating rank set Xtras to only a few people. In the future, when Nova 3 is released with its improved rank system, we'll consider open it up to more people. If you have a rank set you'd like to share, contact us and we'll consider providing you access to create a new rank set Xtra.", 'keywords' => 'rank set', 'tags' => [5]],

			['title' => "Error: Xtra with the Same Name", 'slug' => "", 'summary' => "I have an Xtra that I'm releasing for multiple versions of Nova, but when I try to create the second version, it tells me I already have an Xtra with that name.", 'content' => "AnodyneXtras uses slugs for identifying specific Xtras (this makes URLs more readable and more SEO friendly). What that means is that we take the name of an Xtra and replace spaces with dashes (-) and strip special characters. If you have an Xtra named \"My Awesome Xtra\", its slug will be `my-awesome-xtra`. If you try to create \"My Awesome Xtra\" for Nova 1 and then \"My Awesome Xtra\" for Nova 2, it won't let you create the second version because you already have an Xtra with a slug of `my-awesome-xtra`.

To get around this limitation (something we had to figure out ourselves for all of our Xtras), name your Xtras with a Nova version number: \"My Awesome Xtra Nova 1\". After you've created the Xtra, upload the file and preview image(s), go back and edit the Xtra and remove the \"Nova 1\" piece of the name. The slug won't change, so the slug will remain `my-awesome-xtra-nova-1`, but you'll have a cleaner name for display purposes.", 'keywords' => 'error, versions, slug', 'tags' => [11]],

			['title' => "Updating an Xtra", 'slug' => "", 'summary' => "How do I update one of my Xtras with a new version?", 'content' => "If you want to add a new version to one of your Xtras, it's as simple as editing the Xtra. You'll update the basic information (including the version number) and then use the File Management page to add a new file for the version. If you need to update the preview images, you can do that as well from the Image Management page.

Alternatively, you can use the Quick Update page which will allow you to update the version number, version history, then drag-and-drop your new zip archive to upload it.", 'keywords' => "update, quick update", 'tags' => [9]],

			['title' => "Error: File Already Associated with Version", 'slug' => "", 'summary' => "I tried to upload a new file for a new version of my Xtra, but it tells me there's already a file associated with that version. What's going on?", 'content' => "Order matters!

When updating your Xtra with a new version, you need to _first_ update the Xtra with the new version _then_ upload the new zip file. This also applies to the Quick Update page. You need to change the version number _then_ upload the zip file.", 'keywords' => "upload, zip, error", 'tags' => [11]],

			['title' => "Xtra Disabled by Anodyne Productions", 'slug' => "", 'summary' => "One of my Xtras says that it's been disabled by Anodyne Productions. What's going on?!", 'content' => "The reasons your Xtra could have been disabled range from violating the Terms of Use, to using too much hard drive space on the server, to an abuse violation reported by another user. In most cases, this is a temporary state and you can take steps to correct the issue and have the suspension lifted.

<p class=\"alert alert-warning\"><strong>Note:</strong> in most cases, we'll notify you immediately after disabling your Xtra along with the exact reason why it was disabled and the steps you can take to correct the issue.</p>", 'keywords' => "suspension, disabled, violation", 'tags' => [5]],

			['title' => "Remove an Xtra", 'slug' => "", 'summary' => "How do I remove one of my Xtras?", 'content' => "You can remove any one of your Xtras by going to __My Xtras__ and clicking on the Remove button next to the Xtra you want to remove. After confirming the prompt, your content will be removed from the system permanently.

<p class=\"alert alert-danger\"><strong>Warning:</strong> removing one of your Xtras will remove the records and delete the files from our servers. Files cannot be recovered, so make sure you have copies of your files before removing your Xtra!</p>", 'keywords' => "remove, delete", 'tags' => [9]],

			['title' => "Disabling an Xtra", 'slug' => "", 'summary' => "How do I disable one of my Xtras so no one can see it?", 'content' => "If you want to _hide_ one of your Xtras instead of removing it completely, you can edit the Xtra and set the status field to Inactive. When you're ready to turn your Xtra back on, simply edit the item again and flip the status back to Active.", 'keywords' => "disable, inactive, active", 'tags' => [9]],

			//['title' => "", 'slug' => "", 'summary' => "", 'content' => "", 'keywords' => "", 'tags' => []],
		];
	}

}
