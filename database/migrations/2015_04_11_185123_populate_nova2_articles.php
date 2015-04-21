<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateNova2Articles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach ($this->articles() as $article)
		{
			$article['product_id'] = 2;
			$article['user_id'] = 1;

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
		Article::where('product_id', 2)->delete();
	}

	public function articles()
	{
		return [
			['title' => "Installing Nova 2", 'slug' => "fresh-install", 'summary' => "", 'content' => "", 'keywords' => 'install', 'featured' => 1, 'tags' => [1,3]],
			
			['title' => "Updating Nova 2", 'slug' => "update", 'summary' => "", 'content' => "## Backup\r\n\r\nBefore you attempt to update Nova 2, please make sure you backup both your files and database. While we don't anticipate any problems, if something does happen, you'll have a solid backup of your system to fall back to.\r\n\r\n## Remove\r\n\r\nOnce you've finished backing up all of your stuff, delete the `nova` directory in its entirety.\r\n\r\n<p class=\"alert alert-warning\">When we say delete, we mean it. Delete the directory and <strong>then</strong> upload the new copy.</p>\r\n\r\n## Upload\r\n\r\nWith the `nova` directory deleted, upload the new `nova` directory from the zip archive you downloaded from the Anodyne site to your site.\r\n\r\n## Update\r\n\r\nThe update process works just like the update process in Nova 1. The first step will try to do an automatic backup for you, but you don't have to worry about that too much since you manually backed up everything before you started. (You did back up everything before you started, right?)\r\n\r\nLet the update process do its thing and when you're done, you'll be back on the front Nova page and ready to use Nova again.", 'keywords' => 'update', 'featured' => 1, 'tags' => [1,4]],
			
			['title' => "Upgrading From Nova 1 to Nova 2", 'slug' => "upgrade", 'summary' => "", 'content' => "", 'keywords' => 'upgrade', 'tags' => [1,4]],
			
			['title' => "How to Backup Your Nova Site", 'slug' => "", 'summary' => "", 'content' => "", 'keywords' => 'backup, phpmyadmin', 'featured' => 1, 'tags' => [2]],
			
			['title' => "Nova 2 Requirements", 'slug' => "requirements", 'summary' => "", 'content' => "We've worked hard to make sure Nova's requirements are as broad as possible so as many people as possible can use it for their games. Still, there are a few requirements that you should verify before installing Nova 2. In the event the server you're going to be installing Nova on doesn't support some or all of these things, you should contact your hosting provider and ask them about the possibility of upgrading these items.\r\n\r\n## PHP\r\n\r\nYou will need a server that is running PHP, a dynamic web development language that Nova is built in. Nova 2 requires that your server has at least __PHP 5.1.6__ installed. If you have less than 5.1 installed, the installation will fail and you won't be allowed to continue. Some of the new features in Nova 2 take advantage of functions and methods built in to PHP 5.1.\r\n\r\n## MySQL\r\n\r\nYou will need a server (and account) that has MySQL available. Nova is a database-driven system which means it needs a database (MySQL) to run. As long as you have __MySQL 4.1__ or higher, you should be fine. (Additionally, you can connect to MySQL through PHP's MySQLi functions if your hosting provider mentions that as an option.)\r\n\r\n## A Browser\r\n\r\nSince Nova is web-based software, you'll need a browser in order to use it. These days, there are a lot of browsers out there and most of them should work, but some of the older generation browser aren't supported because of their lack of support for technologies and tools used in Nova. Our recommendation is to use __Firefox__ (version 4 or higher) or a newer build of __Google Chrome__ (version 10 or higher). In addition, we also support Firefox 3, Safari 4 and higher as well as Internet Explorer 7 and higher. Make sure you have JavaScript turned on as many of Nova's features require it.\r\n\r\n<p class=\"alert alert-warning\">Due to Internet Explorer's shortcomings, there are known visual issues with Nova in IE 7. We have no intention of addressing these presentation issues and encourage you to use a standards-compliant browser such as Firefox, Google Chrome or Safari. These visual issues do not affect IE 8 and higher.</p>", 'keywords' => 'requirements, php, mysql, browser, Google Chrome, Safari, Internet Explorer, server', 'tags' => [1]],

			['title' => "What's New in Nova 2.3", 'slug' => "", 'summary' => "", 'content' => "## Character Metadata Available on Manifests\r\n\r\nUse the new character metadata setting for each manifest to tell Nova which fields to pull out of the character information and display on your manifest. You can choose as many fields as you want to display, so make the manifest show more of the information your users are looking for.\r\n\r\n## Updates to Dynamic Forms\r\n\r\nNo one likes seeing blank fields on a bio, so we've updated the dynamic forms to only display fields that have something in them. This will make your forms cleaner and easier to read, especially for entries that don't have a lot of data. We've also added a much-requested feature of being able to show inline help for forms when in create or edit mode.\r\n\r\n## More Sim Stats\r\n\r\nGet a better view at the stats for your game over its entire lifetime now with the expansion of the sim stats. In addition to being able to see stats for the current and previous months, there are also new metrics for the overall lifetime of the game including total posts, average posts per month and more.", 'keywords' => 'metadata, manifest, dynamic forms, bio, stats', 'tags' => [4,8]],
			
			['title' => "What's New in Nova 2.2", 'slug' => "", 'summary' => "", 'content' => "## Character Bio Linking in Author Lists\r\n\r\nForum member Jordan Jay rolled out a MOD for Nova that added links to the character bio for the list of authors for a mission post. We loved this idea so much that we talked to Jordan about rolling the functionality into the Nova core! We've taken his idea and expanded on it though, so in addition to mission posts, the same linking behavior will happen on personal logs, news items, wiki pages and any comments that are entered throughout the system.\r\n\r\n## Reply To on Emails\r\n\r\nSince making changes to emails from Nova to combat emails being marked as spam by hosts, we've heared several people want us to set the Reply To header on email messages so that users can just hit reply and send an email back to the author of the post/log/news items. We've rolled this functionality into _most_ emails that come from Nova. In some cases, it doesn't make sense to have a Reply To header there (password resets were one of the emails we didn't think it didn't make sense for).\r\n\r\n<p class=\"alert alert-warning\"><strong>Note:</strong> Replying to an email will <strong>not</strong> post that item back into Nova. If you want to reply to an item or comment on it, you have to do so from inside Nova.</p>", 'keywords' => 'bio, email', 'tags' => [4,8]],
			
			['title' => "What's New in Nova 2.1", 'slug' => "", 'summary' => "", 'content' => "## Mission Note Update Notifications\r\n\r\nMission notes are an incredible useful feature that allow game masters to keep players updated on what's happening with the game, how players can best move things forward, and to give direction on how to post. The biggest challenge with mission notes though has always been accounting for the length of content (the big reason why notes are hidden by default). Users expressed concern that their updates to mission notes were going unnoticed by players because they didn't know changes had been made.\r\n\r\nNow, if mission notes have been updated within 72 hours, the mission notes content box will automatically be expanded and have an <span class=\"label label-warning\">UPDATED</span> label. If mission notes haven't been updated within 72 hours, the box will stay collapsed. Regardless of time though, the mission notes box will now always show the last time the notes were updated (unless, of course, they've never been updated).\r\n\r\n## Bug Fixes\r\n\r\n* The update page would always throw an error that it couldn't find Nova installed in the current database.\r\n* When a mission was updated, it was assumed mission notes updated as well. Now, there's greater precision in determining if the notes were actually updated.\r\n* Accepting or rejecting docking applications would throw a fatal error because the Messages model wasn't loaded before it was used.\r\n* Join timespan always showed as a user joining \"1 Second ago\" no matter when they joined.\r\n* Nova's `timespan_short` helper was missing the word \"ago\" when the time was less than an hour.\r\n* The Site Messages page didn't strip HTML tags from the content potentially allowing unclosed HTML tags to wreak havoc on the page.", 'keywords' => 'mission notes', 'tags' => [4,8]],
			
			['title' => "What's New in Nova 2.0", 'slug' => "", 'summary' => "", 'content' => "## New File Structure\r\n\r\nOne of the biggest reasons for doing Nova 2 was to improve the file structure of Nova. We've heard from people that updating Nova is difficult and time consuming. For a product that promises to \"get you back to playing your game\" that's unacceptable. We went back to the drawing board with our file structure to make sure updating Nova is dead simple and we think we've nailed it.\r\n\r\nWhen it comes time to update Nova, all you'll need to do is delete the `nova` directory and upload the newer copy. After that, just run the update script from your web browser like you would normally and you're done. No more wading through files and making sure you don't accidentally update a file you shouldn't. In, out and back to your game.\r\n\r\n## New Database Configuration Process\r\n\r\nTaking cues from SMS, Nova 2 includes a brand new database configuration process. Instead of having to open files up and edit them before starting the Nova 2 install, you'll simply go to the site and if there's no database configuration file, you'll be taken through a simple process that will collect your information and create the file for you. Before the file is created though, Nova will actually try to connect to the database and will let you know right away if something is wrong. We think this new process will make it easier and faster to get your game up and running on Nova 2.\r\n\r\n## Refreshed Default Look\r\n\r\nAfter a year and a half with the same default look, Nova 2 has gotten a facelift. Sporting an updated and simpler default interface, Nova 2 leverages HTML5 and CSS3 to a greater degree than previous versions of Nova. The old version of the skin will continue to work, but we felt that given the larger nature of the changes, a refreshed look and feel was appropriate.\r\n\r\n## Thresher R2\r\n\r\nBy far, the majority of our focus has been on Thresher and getting it up to Release 2. There are a ton of improvements to our mini-wiki that will make using it even better than before.\r\n\r\n### System Pages\r\n\r\nPeople told us they wanted more control of some of the static content in Thresher and we came up with a solution that does just that. System pages are specialized wiki pages that cannot be deleted but can be edited like any other wiki page. Make the front Thresher page just what you want by editing the system page in the same place you'd edit a normal wiki page. In addition to the main page, we've added system pages for the all categories listing page, individual category page and creating and editing pages.\r\n\r\n### Page Restrictions\r\n\r\nHave a page that only a few people should be able to get to? In Thresher R1, you were out of luck. In Thresher R2, you can simply set access level restrictions on the page and only those access levels will be able to see them.\r\n\r\n### Brand New Category Selection Interface\r\n\r\nLet's be honest, a list of checkboxes wasn't much of an interface for selecting categories. Now, a more elegant solution makes it easier to categorize your pages.\r\n\r\n### Create Categories On-the-Fly\r\n\r\nAnother one of the big things users told us they wanted to be able to do was to create categories right from the create/edit page. Now you can. Don't have a category for what you want? Just create it then select it and your page will be using that category. Just getting started with Thresher and don't have any categories yet? Don't worry, Thresher will prompt you to create some categories right on the page.\r\n\r\n### User Experience Improvements\r\n\r\nWe're always looking to make the user experience of our products better than before. In Thresher R2, we've made viewing a wiki page a much better and simpler experience. In addition, we've overhauled the Manage Pages section with a whole new user interface that puts more controls at admins fingertips and allows filtering pages by restrictions, the type of page and more.\r\n\r\n### Better Searching\r\n\r\nThis one is pretty self-explanatory. We've worked out several bugs that existed in the search features for Thresher so that you'll get more accurate search results. In addition, we've brought search front and center on the main page with an option to search the minute you land in Thresher.\r\n\r\n## Simplified Character/User Management\r\n\r\nOne of Nova 1's major features was the separation of users and characters, allowing a single user to control multiple characters. While this was a great feature, the management piece was a bit of a struggle for a lot of admins. It was all-to-easy to deactivate a character but leave the user active or vice versa. To help with this management headache, we've borrowed from Nova 3's planned features to provide a dead-simple way to manage characters and users. If you want to take action on a character (activate, deactivate, make an NPC or make an NPC a playing character), admins will do so now with a series of buttons:\r\n\r\n* __Activating an Inactive Character__ - Only displayed with inactive characters, this button will not only activate an inactive character, but will also give admins the ability to activate the user if they're inactive, make the character the primary character for the user or even assign the character to a completely different user.\r\n* __Deactivating an Active Character__ - Only displayed with active characters, this button will deactivate the active character and check the user for any other active characters. If the user doesn't have any other active characters, admins will have an option to deactivate the user right then and there. If the user does have other characters and the one being deactivated is their main character, a dropdown menu will allow admins to set a new main character for that user.\r\n* __Making an Active or Inactive Character an NPC__ - Displayed for both active and inactive characters, this button will move an active or inactive character to be an NPC. If the character in question is someone's main character, a dropdown menu will allow admins to set a new main character for that user. The character will continue to be associated with that user even as an NPC unless the admins selects the option to clear the user association. In the event that making an active character an NPC leaves a user without an active character, admins will have the option to deactivate the user as well.\r\n* __Making an NPC an Active Character__ - Only displayed for non-playing characters, this button will move an NPC to be an active character. Admins will be able to associate the character with a user or change the user the character is associated with in addition to setting the character to be the primary character. In the event a character is being associated with an inactive user, the option will be given to activate that user.\r\n* __Activating a User__ - Only displayed for inactive user accounts, this button will activate an inactive user as well providing admins with the ability to activate any of that user's inactive characters at the same time.\r\n* __Deactivating a User__ - Only displayed for active user accounts, this button will deactivate an active user as well as deactivate all of their active characters.\r\n\r\n## Nested Mission Groups\r\n\r\nOne of the final additions to Nova 1 was mission groups as a way to pull missions together. After seeing how people are using the feature, we've expanded mission groups to allow them to be nested down one level. This means you can now have groups inside groups. Along with this, we've completely re-written the user interface for viewing mission groups which will give users more information at a glance than before.\r\n\r\n## Brand-New Character Selection\r\n\r\nOn pages where you can select multiple characters (writing a mission post, editing a mission post, writing a private message, etc.), the UI was never that good. Select a user and click a link. Select another user and click a link. It was bulky and quite a pain to maintain. In Nova 2, we've changed the UI to be a lot more friendly. Now, just start typing a character name and the list will filter for you. Click the name and you're done. Want to remove a character from the list? Just click on the X next to their name.\r\n\r\n## Updates to Site Messages\r\n\r\nOne of the biggest complaints about Nova is that it makes adding content more difficult than it needs to be. For us, it's always been a security issue to allow script, audio, video, iframe and object tags in the site messages. There are just too many documented cases of people using those for malicious purposes. Sadly, our focus on security made it more difficult for games to do the things they could do before with SMS. That shouldn't be the case. Because of that, we've relented on this issue and now allow all of the previously disallowed HTML tags in site messages. That means that games can now link to YouTube and Vimeo media without having to use seamless substitution. We think this is a big win for our users, though it does come at a cost. You should make sure you absolutely trust the source of any code you put in to your site messages so there are no security issues.\r\n\r\n## Deck Listing Updates\r\n\r\nThe deck listing page received several much-needed user interface updates for Nova 2.\r\n\r\nThe first change you'll notice on the deck listing page is the new menu at the top that will let you quickly move from item to item without having to scroll forever. Games that have a lot of decks in their deck listing will find this especially handy.\r\n\r\nThe second change is that decks are now displayed outside of a table. The previous table-based layout made the page look messy. Without tables, the deck listing flows a little better and makes it significantly easier to read, especially for games with lots of decks and even more content.\r\n\r\n## Post Locking\r\n\r\nOne of the most requested features since SMS 2 was the ability to \"lock\" a post when someone was working on it so that another user couldn't come in and overwrite the work being done. This was a tricky request and one that took a lot of time to come up with a good solution, but we've done it. Post locking relies on a very simple premise: when you start editing a post, no one else can edit it until you're done.\r\n\r\nOf course, it's significantly more complicated than that, but that's the basic idea. When you edit a post, you're granted a 5 minute lock. After 5 minutes, Nova will check to see if you're still editing the post. If you are, it'll renew the lock for another 5 minutes, but if you've walked away and left the page up, it'll auto-save your work and then release the lock. If you go to a post that's locked, you'll see a notification the post is locked and you won't be able to edit anything.\r\n\r\n## Top Open Positions\r\n\r\nSometimes, you want to highlight a few open positions to prospective players, but the open positions listing can be daunting, especially if you have a lot of positions open. Now, the top open positions listing makes it easier to nudge prospective players toward the positions you want to fill. To get started, simply update the position you want to highlight and change the Top Open Position option to Yes. The next time you go to the manifest and click on Open Positions, a new section will appear at the top of the manifest that highlights those top open positions.\r\n\r\n## Rules\r\n\r\nReturning from the ashes of SMS 2, Nova now includes a dedicated rules page that admins can update from Site Messages.\r\n\r\n## Bug Fixes\r\n\r\nAs with any update, we've taken time to fix several nagging issues in Nova, some of which have existed from the very beginning. In all, we've address over a dozen bugs to make your experience with Nova 2 even better than with version 1. Some of the major issues addressed include:\r\n\r\n* Using seamless substitution with images in the <code>_base_override</code> directory didn't work properly\r\n* When replying to or forwarding private messages, the RE and FWD prefixes would always be added to the subject line instead of just once\r\n* When replying to a private message, the person sending the message would end up on the recipient list and the message would appear in their inbox\r\n* The join form could be submitted without an email address and password\r\n* Users who were deactivated kept their system flags (webmaster, system administrator, game master, etc.)\r\n* Reactivated users didn't have their access role properly set\r\n* Inactive users saw a link to upload images even though they don't have permission to do so\r\n* Users could reset their password without needing a security question\r\n* Open slots for positions always weren't properly updated when a character was deactivated\r\n* Pulsar and Titan didn't always display properly in Internet Explorer 9\r\n* The \"Nominated By\" line was shown even when there was no nominee (only an issue for people who upgraded from SMS)\r\n* The Enterprise genre file had several issues\r\n* Patched several potential security issues\r\n* Much more...", 'tags' => [4,8]],

			['title' => "Nova 2.3 Changelog", 'slug' => "", 'summary' => "", 'content' => "## 2.3.2 <small>17 May 2014</small>\r\n\r\n### Nova Core\r\n\r\n* Updated the email from the contact form and the email to the GM from the docking form to include recipient information. Despite the name and email address are in the headers, we're including those as well as the sender's IP address.\r\n* Updated the included head files to allow for using Nova on a secure domain.\r\n* Fixed wrong language key being used for the word \"sim\" in a couple of places.\r\n\r\n## 2.3.1 <small>02 February 2014</small>\r\n\r\n### Bug Fixes\r\n\r\n* When toggling open positions, any open positions in sub-departments would throw off the display of the entire manifest.\r\n\r\n## 2.3.0 <small>14 September 2013</small>\r\n\r\n* When displaying the output of a dynamic form, if there's nothing in the field, we no longer show it.\r\n* Admins can now add inline help for any dynamic form field to help users filling the forms out. The content will be shown below the label and above the field.\r\n* Nova now shows a link back to All Characters when editing a character (if the user has permission).\r\n* Nova now shows a link back to All Users when editing a user (if the user has permission).\r\n* Admins can now specify additional metadata from the bio form to be dispalyed under the character name on the manifest (such as species, gender or any other field).\r\n* Sim stats now shows some statistics for the total life of the sim.\r\n\r\n### Bug Fixes\r\n\r\n* If a character didn't have any posts, their bio would display the start of UNIX time instead of nothing.", 'tags' => [8]],

			['title' => "Nova 2.2 Changelog", 'slug' => "", 'summary' => "", 'content' => "## 2.2.3 <small>7 April 2013</small>\r\n\r\n### Bug Fixes\r\n\r\n* Some users have reported errors being thrown during the update process that prevent them from moving up to newer versions of Nova. We've attempted to create a fix for this, but since we haven't been able to recreate the issue, this may or may not work.\r\n\r\n## 2.2.2 <small>27 March 2013</small>\r\n\r\n### Bug Fixes\r\n\r\n* Fixed error thrown when managing NPCs. (Thanks to evshell18 for the fix and pull request.)\r\n* Fixed issue where users without `wiki/categories` permissions couldn't create or edit wiki pages. ([#239](https://github.com/anodyne/nova/issues/239))\r\n\r\n## 2.2.1 <small>09 March 2013</small>\r\n\r\n### Bug Fixes\r\n\r\n* The update notification box always shows up.\r\n\r\n## 2.2.0 <small>15 February 2013</small>\r\n\r\n* Added reply to header to most of the emails that are sent from Nova. ([#217](https://github.com/anodyne/nova/issues/217))\r\n* Update author listings to provide links to each character's bio page. Thanks to Jordan Jay for his MOD to do this. We've expanded on his idea to provide this functionality for mission posts, personal logs, news items, wiki pages and comments. ([#223](https://github.com/anodyne/nova/issues/223))\r\n* Removed the SMS Archive feature since it's no longer needed.\r\n\r\n### Nova Core\r\n\r\n* Updated the characters model to allow retrieving specific field information by ID or field_name. ([#216](https://github.com/anodyne/nova/issues/216))\r\n* Updated the docking model to allow retrieving specific field information by ID or field_name. ([#216](https://github.com/anodyne/nova/issues/216))\r\n* Updated the specs model to allow retrieving specific field information by ID or field_name. ([#216](https://github.com/anodyne/nova/issues/216))\r\n* Updated the tour model to allow retrieving specific field information by ID or field_name. ([#216](https://github.com/anodyne/nova/issues/216))\r\n* Updated copyright dates in source code. ([#224](https://github.com/anodyne/nova/issues/224))\r\n\r\n### Bug Fixes\r\n\r\n* When viewing a mission post that doesn't exist, Nova throws a fatal error. ([#233](https://github.com/anodyne/nova/issues/233))\r\n* When using the tour form, Nova throws an error.\r\n* Sub-department names and descriptions weren't displayed properly when managing positions. ([#232](https://github.com/anodyne/nova/issues/232))\r\n* A missing closing tag on the character bio management page caused display problems.\r\n* When upgrading from SMS, system administrators didn't have the proper flags set.\r\n* When using the personal logs RSS feed, the link to the entry went to the view post page, not the view log page. ([#234](https://github.com/anodyne/nova/issues/234))", 'tags' => [8]],

			['title' => "Nova 2.1 Changelog", 'slug' => "", 'summary' => "", 'content' => "## 2.1.3 <small>05 November 2012</small>\r\n\r\n### Bug Fixes\r\n\r\n* Restoring lost functionality on some pages due to the security vulnerability update. ([#215](https://github.com/anodyne/nova/issues/215))\r\n\r\n## 2.1.2 <small>04 November 2012</small>\r\n\r\n### Nova Core\r\n\r\n* Update to jQuery 1.8.2.\r\n* Update to jQuery UI 1.8.24.\r\n* Update to markItUp! 1.1.13.\r\n* Update to CodeIgniter 2.1.3.\r\n* Update Nova to address a security issue.\r\n\r\n### Bug Fixes\r\n\r\n* Once a bio field is turned off, the only way to turn it back on is by going in to the database and changing the display value. ([#214](https://github.com/anodyne/nova/issues/214))\r\n* Once a docking field is turned off, the only way to turn it back on is by going in to the database and changing the display value. ([#214](https://github.com/anodyne/nova/issues/214))\r\n* Any spec form field that is turned off has no indication that it's disabled.\r\n* Any tour form field that is turned off has no indication that it's disabled.\r\n\r\n## 2.1.1 <small>12 September 2012</small>\r\n\r\n### Nova Core\r\n\r\n* Update to CodeIgniter 2.1.2.\r\n* Update to jQuery 1.8.1.\r\n* Update to jQuery UI 1.8.23.\r\n* Update the IP Address fields in the database to be compatible with IPv6 addresses.\r\n\r\n### Bug Fixes\r\n\r\n* During the update process, Nova never updated the system information table with the correct version number.\r\n* Despite the system version and components database tables being pulled out, the What's New menu item was never removed, throwing a 404 error if someone tried to go to the page.\r\n* The Admin Control Panel's update notification panel doesn't properly display all the language strings because the proper language file wasn't loaded.\r\n* The user bio page had debug code from 2.1 development at the top of the page.\r\n* Under some circumstances, unlinked NPCs had a link to a user bio that threw an error.\r\n* The User Not Found error was missing a parameter (would show %s instead of the word 'user').\r\n\r\n## 2.1.0 <small>26 June 2012</small>\r\n\r\n* Users are now notified when mission notes have been updated in the last 72 hours by the notes box auto-expanding when they arrive at the posting page.\r\n* Users are now shown when the last update to the mission notes was all the time.\r\n\r\n### Nova Core\r\n\r\n* Remove the `count_unread_pms` method from the private messages model. (This method was deprecated in Nova 2.0.)\r\n* Remove the `system_components` and `system_versions` tables from the database. There's really no reason to be maintaining these lists in Nova. Instead, users who are interested in Nova's components and version history should visit AnodyneDocs.\r\n* Remove the What's New page for the reasons specified above.\r\n* Update the Version Information page to reflect the database changes.\r\n* Update the post, log, and news creation pages to give a description of what tags are meant to be used for.\r\n* Remove jQuery library from the file system. We now pull jQuery from a CDN instead of storing it locally.\r\n* Update to jQuery UI 1.8.20 (we now include the entire jQuery UI library for anyone who wants to use components we don't use).\r\n* Update to prettyPhoto 3.1.4.\r\n* Update to jQuery Reflection 1.1.\r\n\r\n### Bug Fixes\r\n\r\n* The update page would always throw an error that it couldn't find Nova installed in the current database.\r\n* When a mission was updated, it was assumed mission notes updated as well. Now, there's greater precision in determining if the notes were actually updated.\r\n* Accepting or rejecting docking applications would throw a fatal error because the Messages model wasn't loaded before it was used.\r\n* Join timespan always showed as a user joining \"1 Second ago\" no matter when they joined.\r\n* Nova's `timespan_short` helper was missing the word \"ago\" when the time was less than an hour.\r\n* The Site Messages page didn't strip HTML tags from the content potentially allowing unclosed HTML tags to wreak havoc on the page.", 'tags' => [8]],

			['title' => "Nova 2.0 Changelog", 'slug' => "", 'summary' => "", 'content' => "## 2.0.3 <small>01 March 2012</small>\r\n\r\n### Nova Core\r\n\r\n* Updated jQuery UI to version 1.8.18.\r\n\r\n### Bug Fixes\r\n\r\n* Benchmarking psuedo-variables are not handled properly because of the fact the Template library doesn't use the Output library for sending content to the browser.\r\n* When saving posts with the Post Participants feature turned off, Nova would throw errors about a database field not accepting NULL values.\r\n\r\n## 2.0.2 <small>09 February 2012</small>\r\n\r\n### Nova Core\r\n\r\n* Removed the social interaction tools from prettyPhoto image modals. ([#169](https://github.com/anodyne/nova/issues/169))\r\n* Added some code to try and make the mission post locking auto-release a little smarter.\r\n\r\n### Bug Fixes\r\n\r\n* Under some (strange) circumstances, Nova could throw errors from the Ajax controller.\r\n* A typo in the language string on the reset password page when the security question you select doesn't match what's in the database.\r\n* If a user has multiple playing characters assigned to them, the milestones listing would display their main character name for every playing character they had assigned to them instead of just displaying it once.\r\n* The new manifest layout has some display issues when using sub departments. ([#168](https://github.com/anodyne/nova/issues/168))\r\n* When updating the content of a deck, the submit process went back to the select screen instead of staying on the current item's page.\r\n* When deleting specification items, if there are decks associated with that spec item, they're orphaned and not deleted.\r\n* The Who's Online listing displayed random spaces and commas.\r\n* Character image galleries duplicated the primary image.\r\n\r\n## 2.0.1 <small>04 February 2012</small>\r\n\r\n### Bug Fixes\r\n\r\n* If the user's screen isn't wide enough, the tooltip on the Writing Control Panel that displays the post lock information can slide partially out of view.\r\n* Nova tried to load a language file through an object that couldn't see it, resulting in an error thrown about the file not being found.\r\n\r\n## 2.0 <small>04 February 2012</small>\r\n\r\n* Site Messages can now contain previously disallowed HTML tags (like `embed`, `iframe`, etc) for adding media from YouTube and Vimeo to site messages (like the welcome message) without needing to use seamless substitution.\r\n* Mission groups can now be added inside other mission groups (nesting only allowed one level deep).\r\n* Users with Level 2 user admin access rights can now reset someone's password for them. The new password will be generated and emailed to the user and they'll be prompted to reset the password the next time they log in. At no time does the user with Level 2 user admin access rights see what the newly generated password is. ([#16](https://github.com/anodyne/nova/issues/16))\r\n* Multi-author posts are now locked during editing to prevent users editing the same post at the same time. The lock is released after the user saves their changes or they've gone 5 minutes without making a change. (In the event a user has changed something and walked away, their changes will be saved to the post first.)\r\n* Admins now have the option of showing the latest personal logs and mission posts on the main page. (Admins will be able to select any combination of news, logs and posts.)\r\n* Admins now have the option of setting the top open positions (from Position Management) that will be shown at the top of each manifest (not manifest-specific).\r\n* Added a rules page to the main section that can be updated from the Site Messages page.\r\n* The instructions on the upload page now include the maximum file size and maximum image dimensions (pulled from the upload config file) for reference to anyone uploading images. ([#143](https://github.com/anodyne/nova/issues/143))\r\n* The deck listing page now uses a table-less layout for a cleaner look.\r\n* The deck listing page now has a menu of decks at the top of the page for quickly moving to a deck item without having to scroll. (We think RPGs with a lot of decks are going to love this!)\r\n* Overhauled the user interface for mission groups to provide more information (and look a lot better too).\r\n* When composing a mission post, the dropdown will now show who owns a linked NPC.\r\n* When composing a mission post, personal log or private message, users only have to start typing a name and the options will be narrowed down for them. ([#23](https://github.com/anodyne/nova/issues/23))\r\n* The skin catalogue now allows removing an entire skin (with sections) and letting admins choose which skin users will beupdated to for each section.\r\n* The user account page now has options to make activating and deactivating users a lot easier.\r\n    * When deactivating a user, all active characters associated with that account with also be deactivated.\r\n    * When activating a user, admins will be prompted about which of the user's inactive characters should be reactivated.\r\n* The character bio page now has options to make activating and deactivating characters a lot easier.\r\n    * Activating an inactive character (and all related actions) can now be done with the push of a button.\r\n    * Deactivating an active character (and all related actions) can now be done with the push of a button.\r\n    * Making an NPC an active character (and all related actions) can now be done with the push of a button.\r\n    * Making a character an NPC (and all related actions) can now be done with the push of a button.\r\n* When viewing a character's posts, the entries will be paginated to help with load times and usability.\r\n* When viewing a character's logs, the entries will be paginated to help with load times and usability.\r\n* Site manifests can now store default view information so that different manifests can have different view settings. (This is now handled through Site Manifest management instead of Site Settings.) ([#157](https://github.com/anodyne/nova/issues/157))\r\n* Gave the Pulsar skin a refreshed look and feel.\r\n* Gave the Titan skin a refreshed look and feel. (If you're interested in changing the header image, please see Titan's README.md file for instructions.)\r\n* The Writing Control Panel now shows a notification for any entires that have been commented on in the last 30 days (along with a link to the comments section of the entry).\r\n* The manifest has been reorganized (for the first time ever) with a slightly different look.\r\n* The email sent to the game master when a user applies now goes to anyone who can approve or reject character applications.\r\n* Acceptance and rejection emails now CC in anyone who can approve or reject character applications.\r\n* Users can now search within their sent and received private messages.\r\n* Private messages have now been split in to separate inbox and sent message pages. This will help improve performance since the page doesn't have to load all the messages at once then split them off in to tabs.\r\n* Private messages in the inbox and sent messages list are now paginated.\r\n* The Reply to All link when reading a private message is only displayed if there's more than one recipient.\r\n* The Reply, Reply to All and Forward options when reading a private message are now displayed above and below the private message.\r\n* Users can now mark all unread private messages as read with a single click.\r\n* An all-new redesigned character bio page provides a better, cleaner user experience.\r\n\r\n### The Nova Core\r\n\r\n* Moved to CodeIgniter 2.1 (was previously 1.7.3).\r\n* Moved to a brand new file structure that further removes the Nova Core from any changes an admin might be making.\r\n* Added __experimental__ module support.\r\n* Updated to jQuery 1.7.1.\r\n* Updated to jQuery UI 1.8.17.\r\n* Updated to jQuery Uniform 1.7.5.\r\n* Updated to jQuery prettyPhoto 3.1.3.\r\n* Updated to markItUp! 1.1.12.\r\n* Added the jQuery Chosen plugin.\r\n* Added the Bootstrap by Twitter Twipsy plugin (version 1.4).\r\n* Added the Bootstrap by Twitter Popover plugin (version 1.4).\r\n* Removed the qTip plugin. (Please use the Bootstrap Twipsy plugin instead.)\r\n* Changed the `banned.php` file to `message.php` that now contains notifications of Level 2 bans, a missing `nova` directory and incompatible PHP version information.\r\n* Seamless substitution can now be used to override email view files from the `_base_override` directory.\r\n* Added seaQuest DSV as a genre option. ([#144](https://github.com/anodyne/nova/issues/144))\r\n* Changed the Location helper into a library with static methods (`Location::view` instead of `view_location`).\r\n* Removed the RSS model. (It isn't necessary since most of the calls were duplicated in the appropriate post type models.)\r\n* Added constants to the Access model for the default access roles.\r\n* The Missions model now allows group missions to be pulled from `get_all_missions()`.\r\n* The Missions model now has a method to count mission groups: `count_mission_groups()`.\r\n* The Users model now has a method to pull all of a user's LOA records: `get_user_loa_records()`.\r\n* The Auth library now uses static methods to be able to call quicker (`Auth::check_access()` instead of `&#36;this->auth->check_access()`).\r\n* Nova will always check for the existence of the database config file. If the file isn't found, Nova will enter a new config setup wizard that will walk admins through setting up the config file, test the connection and then write the file for them.\r\n* The SMS Upgrade process will now migrate SMS Database entries to the Thresher wiki page format.\r\n* Completely re-wrote the upgrade process to not use config files (admins select the components they want upgraded through a user interface), to show more useful validation messages and be a shorter, more pleasant process (reduced the number of steps from 14 to 4).\r\n* View files now check for the existence of the BASEPATH constant before rendering. On some servers, random `error_log` files are generated all over the place. A big part of this is view files that are accessed apart from the framework and generate PHP fatal errors. This fix should help eliminate those error log files.\r\n* In preparation for future deprecation, we've removed all references to jQuery's `.live()` method. Third party developers should ensure their own code is updated as soon as possible to avoid any issues once the method is removed from the jQuery core.\r\n\r\n### Thresher\r\n\r\n* Changed the way users manage categories when creating and editing a wiki page. ([#137](https://github.com/anodyne/nova/issues/137))\r\n* Users with the proper permissions can now create categories when creating and editing a wiki page. ([#64](https://github.com/anodyne/nova/issues/64))\r\n* If there are no categories set in Thresher and the user has the proper permissions, they will be prompted to create some new categories when creating and editing a wiki page.\r\n* Changed the user experience for managing wiki pages that puts more controls at the user's disposal and simplifies the entire page. ([#141](https://github.com/anodyne/nova/issues/141))\r\n* Changed the user interface for viewing wiki pages to make it simpler.\r\n* Users must have Level 1 wiki page access to see the page history now.\r\n* Only users who are logged in can see comments on a wiki page.\r\n* Added system pages to Thresher that allow some of the system pages to have their content changed like a normal wiki page. ([#123](https://github.com/anodyne/nova/issues/123))\r\n* Users can now search Thresher from the main Thresher page.\r\n* Fixed several bugs with the listing of Thresher search results.\r\n* Removed the recently changed and recently updated listings from the main Thresher page.\r\n* Users can now subscribe to an RSS feed for created wiki pages as well as updated wiki pages.\r\n* Admins can now restrict access to a wiki page based on access role. ([#11](https://github.com/anodyne/nova/issues/11), [#12](https://github.com/anodyne/nova/issues/12))\r\n\r\n### Bug Fixes\r\n\r\n* Seamless substitution of images wouldn't work when the images were in the `_base_override` directory.\r\n* The `RE:` and `FWD:` tags would be added to private message subjects when replying and forwarding indefinitely until there was no space left for the actual subject line. Now, Nova will make sure it's only added once. ([#158](https://github.com/anodyne/nova/issues/158))\r\n* When replying to a private message, the author of the message would be added to the recipient list, so any message they send would also show up in their inbox as well. (This behavior can be duplicated by manually adding themselves to the recipients list.)\r\n* The join form could be submitted without an email address or password.\r\n* Users who were deactivated kept their account flags (system administrator, game master, webmaster) and their access role. Now, all account flags and access roles are changed on deactivation.\r\n* Users who were reactivated didn't have their access role set to Standard User.\r\n* Inactive users were shown a link in the sub-navigation to upload an image even though they don't have permissions to upload images.\r\n* A password could be reset for a user even if they don't have a security question chosen.\r\n* Patched several potential security and access issues.\r\n* Positions weren't properly updated when deleting an active character.\r\n* Pulsar styling issues in Internet Explorer 9.\r\n* Titan styling issues in Internet Explorer 9.\r\n* When viewing character or user award, the \"Nominated By\" line was shown even if there was no nomineed. (This is only an issue for RPGs who upgraded from SMS.)\r\n* The Enterprise-era (ENT) genre install file had several issues and typos. ([#155](https://github.com/anodyne/nova/issues/155))\r\n* The database automatically set a default rank for pending users potentially resulting in some confusion as to why a pending user already has a rank. ([#148](https://github.com/anodyne/nova/issues/148))\r\n* If there is only one specification item, the list of items would be dispalyed instead of automatically sending the user to the only specification item. ([#146](https://github.com/anodyne/nova/issues/146))\r\n* If there is only one specification item, the list of decks would be dispalyed instead of automatically sending the user to the only deck listing. ([#147](https://github.com/anodyne/nova/issues/147))\r\n* During fresh installs, the user ID constraint wasn't consistent with the rest of the user ID fields throughout the system.\r\n* Under some circumstances, users could edit posts they weren't even a part of. (Thanks to evshell18 on the Anodyne forums for pointing this out and getting the ball rolling on a fix.)", 'tags' => [8]],

			['title' => "Changing Language Items", 'slug' => "", 'summary' => "", 'content' => "Generally speaking, the language items we've set up for Nova suffice for 99% of sims, but every so often, someone wants to do something a little different. While it isn't as simple as doing something in the control panel, modifying Nova's files to use different terms is really easy.

## The Problem

When setting up your game, you realize that some of the terms don't line up with how your RPG does things. You want to change some terms so that they're more consistent with what you call them. In this case, you want to change the term \"mission\" to \"episode\" and \"mission group\" to \"quest\".

## The Solution

### 1. Find and Copy the Language Items You Want to Change

The way that language files work in Nova is that it's a big array. Each key of the array items is unique so that it can be referenced instead of the full string of text. The value of the array items is what's actually printed out on the page. For those without a lot of PHP experience, an array is broken down as follows:

    \$array = array(
	    'key1' => 'value1',
	    'key2' => 'value2',
	    'key3' => 'value3',
    );

Now, in order to change the language items, we need to first find the item we're looking to change so we make sure we have the right key. You'll need to open the language file located at `nova/modules/core/language/english/base_lang.php`. This is the primary language file and will store the majority of what you're looking to change. (If you're looking to change a longer piece of text, odds are its in one of the other files.) With the `base_lang.php` file open, you can use your text editor to search for what you're looking for. In this case, we want to search for \"mission\".

Your search will probably return a few results, but the ones you're looking for are the ones that have array keys of _global\_mission_ and _global\_missions_. Copy both of those items and head on to the next step.

### 2. Change the Language Items You Want to Change

Now that our clipboard has the original items, we can paste them in to the language file located in `app/language/english/app_lang.php`. Open it up and paste the two items at the bottom of the file. Now, we can change the __value__ of the array items to what we want and save the file. Your file items will probably look a little something like this:

    \$lang['global_mission'] = \"episode\";
    \$lang['global_missions'] = \"episodes\";

Make sure you're only changing the __value__ of the array item (what's on the right side of the equal side). If you change the key, your changes won't work.

<p class=\"alert alert-warning\">So why do I need to copy these into another file? Why not just change them in the first file? The short answer is <strong>because putting them in the application folder is the right way to do it</strong> (kinda like your Mom telling you \"because I said so\"). The longer answer is that the language folder in the Nova core will get replaced with every update, so unless you want to update your language items after every update, best to put the language changes in the application folder.</p>

### 3. Upload Your Changes

Now that you've made your changes, make sure the `app_lang.php` file is saved and then upload it to your server (or if you're editing it on the server, just save it). Head over to your Nova site and you should see that things should be changed.

It's important to note that menu items don't respect the language files since they're stored in the database. If you want to change something in a menu item, simply edit the menu item.", 'keywords' => 'language, i10n, translate, internationalization', 'tags' => [2,7]],

			['title' => "Adding an Image to a Page", 'slug' => "", 'summary' => "", 'content' => "The concept behind seamless substitution is pretty simple: Nova will use its system default for icons, pages and Javascript files unless the same file exists in either the current skin or the base override, in which case, Nova will use that instead.

## The Problem

You found an awesome image that you want to put on a page in your site.

## The Solution

There are actually two different ways to accomplish this. We'll talk about both ways since the first way may not apply on every page.

### Using Site Messages

If you wanted to add the image to the main page or the sim page, you'd be able to very easily use Site Messages to insert the image. All you'd need to do is upload the image to either a photo sharing site or your own site and link to the image using a standard HTML image tag in the respective message in Site Messages. Once you've saved the message, your image will appear where you put it. (Remember, you can use any HTML in Site Messages now.)

### Using Seamless Substitution

Sometimes though, using a Site Message isn't an option. In those cases, you can use seamless substitution to accomplish the same thing. In order to add an image to a page using seamless substitution, you need to start by uploading the image to either a photo sharing site or your own site. Once you've done that, find the appropriate view file in `nova/modules/core/views/_base`. For this example, we're going to ignore the fact that we can make the change through Site Messages for the sim page and do it with seamless substitution.

The particular view file you'll need to copy into `app/views/_base_override` is `nova/modules/core/views/_base/main/pages/sim_index.php`. How do you know what the right view file is? The `main` part tells us that this is a page in the main section of the site and the view files are prefixed with the controller and the action. In this case, `sim/index`. While that's not always the case, view files are named well enough that you'll be able to tell which page it's being used for.

Now that you've copied `nova/modules/core/views/_base/main/pages/sim_index.php` to `app/views/_base_override/main/pages` you can edit the version in the `_base_override` folder. Once you're done making your changes, save the file and upload it to your server. The next time you go to the sim page, you'll see your image wherever you put it in the page. Remember that view files are mostly HTML with some PHP mixed in, so any HTML you want to use can easily be used in view files.

This same process will work for any view file in Nova!

<p class=\"alert alert-warning\">Why do I need to copy the file to another location? Why not just change the file in the <em>_base</em> folder? The short answer is <strong>because putting it in the application folder is the right way to do it</strong> (kinda like your Mom telling you \"because I said so\"). The longer answer is that the <em>_base</em> folder in the Nova core will get replaced with every update, so unless you want to update your views after every update, best to use seamless substitution and put your changes in the application folder.</p>", 'keywords' => 'seamless substitution, image', 'tags' => [2,7]],

			['title' => "Changing Icons", 'slug' => "", 'summary' => "", 'content' => "The concept behind seamless substitution is pretty simple: Nova will use its system default for icons, pages and Javascript files unless the same file exists in either the current skin or the base override, in which case, Nova will use that instead.

## The Problem

You've gotten tired of the orange RSS feed icon on the news, personal log and post pages and want to go with something else.

## The Solution

Once you've found the icon you want to use instead, simply make sure it's named the exact same as the RSS feed icon located in `nova/modules/core/views/_base/main/images`. (For those too lazy to go look, it's _feed.png_.) Now that your new icon is named the same as the system default, all you need to do is put your new image in the right place and Nova will start using your icon instead!

So where the hell is the right place?

In order to get this working, simply upload your new image to `app/views/_base_override/main/images`. Done! Head over to Nova and see for yourself.

## A Final Word

This relates to using the base override only. You can also substitute on a per-skin level which is described in more detail in the skin development section.", 'keywords' => 'seamless substitution, icon, image', 'tags' => [2,7]],

			['title' => "Changing the Name of the Application Folder", 'slug' => "", 'summary' => "", 'content' => "## The Problem

You're toying around with the idea of running several Nova installations from the same directory and you can't have multiple application folders (or maybe you just want to change it for the hell of it).

## The Solution

Changing Nova's application folder is actually incredibly easy. Before you begin though, you should back up your application directory to have it just in case something goes wrong.

### 1. Change the Name of the Application Folder

Rename the application folder on the server from `application` to `uss_enterprise` (or whatever you want it to be).

### 2. Change the Index File

Next, we need to update the index file to point to the right directory for our application. Open `index.php` and find the _\$app\_folder_ variable (it's on line 66 or somewhere close by). Make the _\$app\_folder_ variable point to your new application folder.

    \$app_folder = 'uss_enterprise';

Once you've saved and uploaded the index file back up to your server, you can navigate to your Nova installation and you should see Nova as usual.

<p class=\"alert alert-warning\"><strong>Important:</strong> Since this change doesn't happen in the application directory, it's possible a change in the future to the index file may force you to re-apply this change after an update.</p>", 'keywords' => 'application, folder, name, rename', 'tags' => [2,7]],

			['title' => "Changing the Index File", 'slug' => "", 'summary' => "", 'content' => "## The Problem

Your sim is running a static site, static page, forums or something else (or hell, you just want a new file name) and you want to change the name of the front file Nova uses from `index.php` to `nova.php`.

## The Solution

Changing Nova's bootstrap file is actually incredibly easy. Before you begin though, you should back up a copy of the index file to have it just in case something goes wrong.

<p class=\"alert alert-warning\"><strong>Note:</strong> The bootstrap file refers to the index file, or the file that \"bootstraps\" the entire framework. This shouldn't be confused with the UI toolkit that's used in Nova.</p>

### 1. Change the Index File Name

Rename the index file from `index.php` to `nova.php` (or whatever you want it to be). Upload the bootstrap file to your server.

### 2. Change the Config File

Next, we need to update the config file to point to the right bootstrap file. Open `app/config/config.php`. You'll notice that the file is pretty much empty. This is done so that we can update the configuration if necessary without having admins change config options with every update. In order to change the index file, you just need to add the following line at the end of the file:

    \$config['index_page'] = \"nova.php\";

All this does is overrides the default `index.php` option with the new bootstrap file. Once you've saved and uploaded the config file back up to your server, you can navigate to your new file and you should see Nova as usual.", 'keywords' => 'index, name, rename, bootstrap', 'tags' => [2,7]],

			['title' => "Creating a New Page", 'slug' => "", 'summary' => "Oftentimes, the built-in pages in Nova just won't be enough and you need to create a new page for you sim to hold new information.", 'content' => "Oftentimes, the built-in pages in Nova just won't be enough and you need to create a new page for you sim to hold new information.

## The Problem

After having a killer month, your simming organization bestows on you several awards and you want a place to display those awards for the world to see.

## The Solution

Like a lot of things in Nova, there are two ways to accomplish this. We'll start with the easy way and then move up to the more advanced way.

### Using Thresher

The simplest solution is to use Thresher, Nova's built-in mini-wiki. Using Thresher, you can quickly and easily create a new page, add links to images and whatever else you want. The only downside to this solution is that it's stored in the wiki. If that isn't an issue or you're having trouble following the more advanced option below, Thresher is your best bet.

### Creating a New Page

That's all well and good, but what if you don't want the page stored in the wiki? Instead, you want it as part of your sim section. Let's step through how you would go about adding a new page to the sim section.

#### 1. Set Up the Controller

This is, most likely, one of your first forays into controllers. In the simplest terms, a controller is like a traffic cop. The web browser navigates to a URL at which point the traffic cop (the controller), tells you where to go from there. A controller is simply a PHP class that directs a request to the appropriate place. In order to build our page, we need some simple code in our controller.

To start, we're going to open `app/controllers/sim.php`. This is the controller that handles all of the pages in the sim section. When you open the file, you'll notice that it's almost empty. The core sim pages are stored in the base controller in the Nova module. Since we're not interested in modifying those, we're going to just add a new controller action to this file after the comment about adding your own methods after it.

	public function sim_awards()
	{
		\$this->_regions['content'] = Location::view('sim_allawards', \$this->skin, 'main');
		\$this->_regions['title'].= \"Awards We've Won\";
		
		Template::assign(\$this->_regions);
		
		Template::render();
	}

Let's step through this piece-by-piece to see what's going on.

	public function sim_awards()

A controller action is nothing more than a class method. A class method is a function inside a class. Pretty simple. Nova will use the name of the controller action as part of the URL. (This actually is what tells the controller where it needs to go.) In this case, our URL would be `index.php/sim/sim_awards`. You can name your controller action whatever you want provided it doesn't conflict with another method in that particular controller or that it isn't a reserved PHP word.

	\$this->_regions['content'] = Location::view('sim_allawards', \$this->skin, 'main');

Nova templates are broken up into regions. The guts of a page are part of the _content_ region. What we're doing here is assigning a view file to the content region to be rendered by the browser. Sounds complicated, but it really isn't. All you need to know is the second part: the location class.

In order for seamless substitution to work, we created a location class (it used to be a helper in Nova 1) that does all the heavy lifting and figures out where to pull files from. In this case, we're looking for a view that's named `sim_allawards.php` (the .php part is assumed so you don't have to include it). After that, the class is simplying being told where to look and what section it's part of.

	\$this->_regions['title'].= \"Awards We've Won\";

Now, we're simply setting the title of the page (what we see in the browser's title bar). You can see that to whatever you want provided it's a string.

	Template::assign(\$this->_regions);

This is required as it takes all the regions and assigns them to the template.

	Template::render();

Pretty self-explanatory here, but we're telling the Template class to render the template to the browser window.

#### 2. Set Up the View

If you tried to go to your page above, you'd be greeted by a nasty error telling you something is missing. What we're missing is the guts of the page, or the view file. The second part of this is to create your view file. To do that, we're going to create a file called `sim_allawards.php` in `app/views/_base_override/main/pages`.

So what are we going to put in our view file?

	<h1 class=\"page-head\">Awards We've Won</h1>

	<p>Below is a list of all the awards we've won!</p>

	<p><img src=\"<?php echo base_url();?>app/assets/images/award_image.jpg\" /></p>

As you can see, it's __really__ straightforward. The only thing we're doing is using CodeIgniter's built-in `base_url` function to get the base URL of our site. (If we don't use the base URL, CI will try to append index.php to our image path and it won't be able to find the image.)

From here, you can make whatever changes you want to the view file and continue to add awards. Because we've done all this work in the `application` directory, we don't have to worry about losing our changes when we make an update either!", 'keywords' => 'page, add, create, new', 'tags' => [2,7]],

			['title' => "Versioning in Nova", 'slug' => "", 'summary' => "", 'content' => "For transparency and insight into our release cycle, and for striving to maintain backwards compatibility, Nova will be maintained under the Semantic Versioning guidelines as much as possible. Releases will be numbered with the follow format:

    {major}.{minor}.{patch}

Below are some examples of valid version numbers:

    1.0.0
    1.0.9
    1.3.6
    2.0.3

These version numbers are constructed with the following guidelines:

* __Major Version:__ this will only change when there has been a major architectural change to Nova and significant changes that could break backwards compatibility. It is possible that while major versions will include update scripts, some data may not be able to be retained through a major version update. We will do our best to avoid and limit these situations.
* __Minor Version:__ an increase to the minor version indicates new features or the enhancement of an existing feature. Minor versions will come with an update script and there should be little to no impact on existing data.
* __Patch Version:__ this is the most common change to the version number and indicates bug fixes or other changes that only impact functionality in very minor ways. Edit version updates will come with an update script but will never impact existing data in a way where that data is not retained during the update process.

For more information on SemVer, please visit [SemVer.org](http://semver.org/).", 'keywords' => 'versions', 'tags' => [9]],

			['title' => "Nova URLs", 'slug' => "", 'summary' => "", 'content' => "A typical URL in Nova _without_ mod_rewrite enabled:

    http://localhost/nova/index.php/main/credits/1

Let's look closer at each part of the URL:

* `http://localhost/nova/index.php` - On my development server, I've created a folder called nova for all of the Nova files. As you can see, the index.php file that handles all requests is sitting within that folder's root.
* `/main` - The next part of the URL is the controller that is being requested within Nova. In this example, we are requesting a controller called `Main`. Controllers in Nova can be found in `app/controllers`. This is the first segment of the URI and can be accessed using the URI library with `\$this->uri->segment(1)`.
* `/credits` - The next part of the URL in this example is the method within the `Main` controller that we are calling. (A method is simply a function inside of a class.) In this case, we're requesting the `Credits` method. This is the second segment of the URI and can be accessed using the URI library with `\$this->uri->segment(2)`.
* `/1` - The number one in this instance doesn't relate to a class or method, but instead, is a parameter held in the URI. Throughout the system, Nova passes parameters through the URI and then access them using CodeIgniter's libraries and helpers. This is the third segment of the URI and would be accessed using the URI library with `\$this->uri->segment(3)`. The URI can contain as many parameters as you want, just keep track of which segment it is.", 'keywords' => 'url, controller, method, action', 'tags' => [9]],

			['title' => "Nova License Agreement", 'slug' => "", 'summary' => "", 'content' => "This license is a legal agreement between you and the Anodyne Productions for the use of Nova (the \"Software\"). By obtaining the Software you agree to comply with the terms and conditions of this license.

Copyright (c) 2010-2011, Anodyne Productions  
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
* Neither the names of Nova, Anodyne, SMS nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
* All conditions of the CodeIgniter license must be properly met and the CodeIgniter license cannot be removed under any circumstances.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS \"AS IS\" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

Anodyne Productions reserves the right, at their discretion, to collect anonymous statistics from your hosting environment for informational purposes related to future updates to the Software as well as future products.", 'keywords' => 'license', 'featured' => 1, 'tags' => [9]],

			['title' => "Nova 2 File Structure", 'slug' => "file-structure", 'summary' => "", 'content' => "In order to fully understand how Nova works, the best place to start is the file structure. Nova's file structure is significantly different from SMS and getting used to these changes can be daunting. To help you get used to the new file layout, a brief walkthrough of the root, application and core folders is below.

## The Root

* __application__ - For all intents and purposes, this folder is a placeholder. Blank controllers, config files, models and libraries tell CodeIgniter what to do when those components are accessed, but there is no Nova code in the `application` directory any more. This allows developers to make changes in this directory and not have to worry about their changes being wiped out during an update.
* __nova__ - This is the heart and soul of Nova. Included in this directory is the CodeIgniter framework (which should never be edited or updated ... always let Anodyne test and release any changes to CI), the CI and Nova licenses and the Nova core.
* __index.php__ - This is the main Nova file that every page uses. It's possible to change the name of this file in the event you want to run several installations from the same server. You could easily name your index.php file, nova.php and then change the reference in the config file to point to the nova.php file. More information about that is available in the <a href=\"<?php echo Uri::create('nova2/developers/index');?>\">developers section</a>.
* __message.php__ - The message file is used by Nova to display informational messages to users in the event an error has occurred. If a user's browser doesn't meet the requirements, the server doesn't meet the requirements or a user has been issued a level 2 ban, this page will display information to the user.

## The Application Directory

* __assets__ - The assets folder mainly contains genre files and images. You'll also find any backups Nova does for you in this folder.
* __cache__ - CodeIgniter comes with the ability to cache view files to help speed up the loading of pages. CI will store its cache files in this directory. (Because of the dynamic nature of Nova, there's little we can cache.)
* __config__ - The config directory stores all of the application and framework's configuration files, including general configuration, database connections, auto-loading, constants and many others.
* __controllers__ - Controllers are the heart of Nova and determine how HTTP requests should be handled. A Controller is simply a class file that is named in a way that can be associated with a URI. When a controller's name matches the first segment of a URI, it will be loaded.
* __core__ - CodeIgniter core libraries are specialized base libraries that are part of the core framework and initialized every time.
* __errors__ - The errors directory holds simple view files that are called in the event an error is encountered by CodeIgniter. Included in this directory is a 404 error page, a database error page, a PHP error page and a general error page.
* __helpers__ - Helpers, as the name suggests, help you with tasks. Each helper file is simply a collection of functions in a particular category. Unlike most other systems in CodeIgniter, helpers are not written in an Object Oriented format. They are simple, procedural functions. Each helper function performs one specific task, with no dependence on other functions.
* __hooks__ - Nova takes advantage of CodeIgniter's hook system to \"hook\" in to various points during the execution process to check whether maintenance mode is turned on, if the user has a supported browser or to find out if the user has a level 2 ban. If you develop any hooks, this is where you'll store them.
* __language__ - The language directory is where CodeIgniter will look for the language files needed to translate the system from English to whatever you language you want. In Nova 2, the language files are stored in the Nova module and a single language file pulls the necessary files in as well as giving admins the ability to override language items.
* __libraries__ - Libraries are PHP classes designed with a specific set of actions in mind. CodeIgniter contains many of these and we've also built some of our own for Nova as well.
* __logs__ - CodeIgniter has the ability to log all kinds of errors and information messages that can help in debugging. By default, Nova ships with the bare minimum being written to this directory, but if you need more information about what CodeIgniter is doing, you can turn up the error reporting and view the error logs here.
* __models__ - Models are PHP classes designed to work with information in your database. They provide a quick and easy way to pull information that doesn't require admins to write lots of database queries. Even better, models in Nova use CodeIgniter's Active Record class meaning they're easy to build and understand.
* __modules__ - Modules are a way to store related code that makes it easy to distribute. Module support is new in Nova 2 and requires a healthy understanding of how Nova and CodeIgniter work.
* __third_party__ - New to CodeIgniter 2 are application packages which are a way to set extra directories that contain libraries, models, helpers, etc. Currently, Nova 2 does not use CI 2 packages.
* __views__ - A view is simply a PHP page that contains the HTML markup that creates the presentation of the page you're viewing. Views are never called directly, they must be loaded by a controller.

## The Nova Directory

<p class=\"alert alert-danger\"><strong>Warning:</strong> Never edit core files unless you know what you're doing! Editing core files can cause the entire system and framework to fail.</p>

* __ci__
	* __core__ - This is the heart of CodeIgniter. Once the index file is executed, the last thing it does is to pull in the main CodeIgniter file from this directory.
	* __database__ - CodeIgniter comes with some robust database drivers that allow it to connect to MySQL, MS SQL, PostgreSQL, SQLite, Oracle and ODBC databases. While Nova only uses MySQL, these other drivers may come in handy in the future.
	* __fonts__ - CodeIgniter stores a single font in this directory for use in the system. Nova makes no use of this directory.
	* __helpers__ - Helpers, as the name suggests, help you with tasks. Each helper file is simply a collection of functions in a particular category. Unlike most other systems in CodeIgniter, helpers are not written in an Object Oriented format. They are simple, procedural functions. Each helper function performs one specific task, with no dependence on other functions.
	* __language__ - The language directory is where CodeIgniter will look for the language files needed to translate the system from English to whatever you language you want. In order to use additional languages, you must have a corresponding language directory in both this directory as well as the application's language folder.
	* __libraries__ - Libraries are PHP classes designed with a specific set of actions in mind. CodeIgniter contains many of these and we've also built some of our own for Nova as well.
* __licenses__
* __modules__
	* __assets__
		* __database__ - The database asset folder stores the default database config file that Nova's new setup process uses to write the database connection file. ___Never edit this file. Doing so will break the setup config process.___
		* __install__ - The install folder contains all of the assets needed to install the system. These assets are also used during the SMS upgrade process as well as during some of the database changes proccesses.
		* __js__ - Nova makes extensive use of jQuery and a wide array of plugins. The js folder holds all those Javascript pieces that are used by the system.
		* __update__ - The update folder contains all of the assets needed to update the system.
	* __core__
		* __config__ - While all of Nova's config files are in the application directory, there are often times where some of those files need to be edited on a regular basis. Because of that, \"base\" config files are in the Nova config directory so the initial values can be set and then overridden by the application version.
		* __controllers__ - In Nova 1, these controllers were found in the \"base\" directory. We've removed all Nova code from the application and moved those base controllers here. If you need to override a base controller, you'll need to copy the method(s) from these files.
		* __core__ -  CodeIgniter core libraries are specialized base libraries that are part of the core framework and initialized every time.
		* __helpers__ - Like other things in Nova 2, these are the base files that are then extended in the application directory. If you need to override a helper, you'll want to copy it from these base files.
		* __hooks__ - The hooks used in Nova are defined in this directory. If you need to modify an existing hook, copy it from here to the application directory's hook folder and edit it from there.
		* __language__ - Save for one files, all the language files are stored here.
		* __libraries__ - The base libraries used by Nova are stored here. If you need to modify an existing library, copy it (or the method(s) you need) to the application's libraries folder and edit from there.
		* __models__ - The base models used by Nova are stored here. If you need to modify an existing model, copy it (or the method(s) you need) to the application's models folder and edit from there.
		* __views__ - The base views used by Nova are stored here. If you need to modify an existing view, copy it to the specific skin you want it to apply to or the `_base_override` folder and edit from there.", 'keywords' => 'files, structure', 'tags' => [9]],

			['title' => "Genres in Nova", 'slug' => "genres", 'summary' => "", 'content' => "One of Nova's defining features is the ability to use genres outside of Star Trek, a genre which has been at the heart of SMS since its initial release in 2005. While Star Trek genres still play a large role in Nova, it's no longer the only genre you can use. So what goes in to a genre? There are a lot of pieces, but once you understand those pieces, you'll be well on your way to using genres to their full potential and maybe even creating your own genre installations!

## Files

### Asset Files

Asset files are the integral components of a genre and include images and ranks. Nova stores all genre assets in `app/assets/common`. Each genre is assigned its own directory that lines up with its genre code. For instance, the Deep Space Nine genre code is __DS9__ and its genre asset folder is `ds9`.

#### Images

If you have genre specific images, such as emblems for the manifest, those can be stored in the genre's images folder and used by Nova in various places throughout the system. Manifest emblem locations can be found by using the `cb_location` helper.

#### Ranks

Ranks are arguably one of the biggest asset pieces that change from genre to genre. Yes, the database changes, but the most noticable area are rank images. The ranks folder in the genre directory is where all the different rank sets are stored and accessed from. Like SMS, different rank sets are stored in different folders, but unlike SMS, you can name the rank sets independently from the folder name. If you want to add a rank set, you will upload it to `app/assets/common/{genre}/ranks`.

### The Database

We've managed to narrow all the genre-specific elements to three tables: departments, positions and ranks. Any genre you install into the database will have suffixed tables with the genre code. For the DS9 genre, the three tables are named `nova\_departments\_ds9`, `nova\_positions\_ds9` and `nova\_ranks\_ds9`. This allows multiple genres to be installed side-by-side in the database.

### The Install File

Nova stores the genre install files in `nova/modules/assets/install/genres`. There is one file for each genre that's stored in the format `{genre}\_data.php`. Essentially, genre files are nothing more than several large PHP arrays with all the information about departments, positions and ranks. That data is fed into the install script and uses the arrays along with CodeIgniter's Database Forge feature to create tables and insert data into them.

## Creating a Genre Install

If you're interested in creating a genre file, we recommend that you duplicate one of the existing genre data files and start from there. In order to create a genre file, you have to have departments, positions and ranks. If one of those components is missing, parts of the system will break without major modifications.

<p class=\"alert alert-warning\"><strong>Note:</strong> It's important that you understand PHP handling of single and double quotes and escaping quotes as necessary, otherwise you'll run in to a long series of errors that will be maddening trying to fix. In a nutshell, if you have a string surrounded by single quotes, you can only use another single quote in that string after escaping with the backslash (\). Here's how you would handle a few different types of strings:</p>

    'This is a string that does not need escaping.'

    'This is a string that does need to be escaped by it\'s got an extra single quote in it.'

    \"Alternately, you could switch to use double quotes so you don't have to escape any single quotes.\"", 'keywords' => 'genre', 'tags' => [9]],

			['title' => "Configuring Nova", 'slug' => "", 'summary' => "", 'content' => "## Genre

One of the most important configuration variables, the genre option will tell Nova what position, department, and rank data to use when installing the system as well as when accessing the database. If this is blank, the system will not install! If you want to change your genre after you've installed Nova, you'll need to change this variable to the three letter genre code for the genre you're going to.

## Meta Data

Nova comes with some default meta data, but admins can change the data to their preference through variables in the `app/config/nova.php` file. By default, Nova ships with the following meta data:

* __Description__ - Anodyne Productions' premier online RPG management software
* __Author__ - Anodyne Productions
* __Keywords__ - nova, rpg management, anodyne, rpg, sms

## RSS Settings

Nova allows people (crew and otherwise) to subscribe to RSS feeds with mission posts, personal logs, and news items. There are several options for configuring these in `app/config/nova.php`. More information about the configuration options can be found in the RSS Feeds page.

## Thresher Settings

Nova's integrated mini wiki, Thresher, has a single config file that allows admins to change the way content is stored and parsed. By default, Thresher will store and parse wiki page content as HTML, but you can also use BBCode, Markdown and Textile for storing and parsing. You can change the parse type in the Thresher config file found at `app/config/thresher.php`.

<p class=\"alert alert-warning\"><strong>Note:</strong> Once you have selected a parse type, you shouldn't change it. If you change the parse type, your wiki pages may not display properly.</p>", 'keywords' => 'config, configure, rss, thresher, wiki, metadata, seo, search engine', 'tags' => [9]],

			['title' => "Configuring CodeIgniter", 'slug' => "", 'summary' => "", 'content' => "## Basic System Settings

### Base URL

In SMS, it was called the web location variable. In CI, it's called the base URL. Nova sets the base URL dynamically so you should never have to touch this variable. If you find a situation where the base URL isn't accurate, you can change it in `app/config/config.php`.

<p class=\"alert alert-warning\"><strong>Note:</strong> Take great care when changing the base URL as it can cause Nova to break!</p>

### Index File

CodeIgniter comes with the ability to rename index.php to whatever you want. This is advantageous for a variety of reasons, namely if you want to run multiple sims from the same directory or if you want to create a splash page at index.php and point to another page for Nova. You can change the index.php file in `app/config/config.php`. Make sure you have changed the name of the index.php file, then put the changed name in the file.

<p class=\"alert alert-warning\"><strong>Note:</strong> The file must be a PHP file or Nova will not work!</p>

### Default Language

By default, Nova ships with English as its default language. If you have additional language folders in place, you can change the default language Nova is displayed in. (Content from the database will still be in English; those entries will have to be manually updated.) In addition to having a language folder in the CodeIgniter core, the Nova core also has a language folder that will need to have data for that language. More information can be found in the language documentation pages.</p>

### Character Set

CodeIgniter allows the default character set to be changed to whatever an admin wants. By default, it is set to __UTF-8__. For most situations, that should be fine. If you need to change it, you can find the preference in `app/config/config.php`.

### Error Logging

CodeIgniter allows admins to change the error logging threshold if they so choose. By default, Nova operates with error reporting turned off, but if you turn it on, you can change the amount of information that is dumped to the error logs. You can change the error logging options from `app/config/config.php`. In addition, you can change the location where the system logs are stored (if your host has changed it from the default location) and the date format for the error logs.

### Master Time Reference

Unlike SMS, Nova is a lot smarter with dates and times. By default, Nova will convert all dates to GMT to allow for users to set their individual time zones. You can choose to change this to the server's local time if you want, but doing so will break some of the timezone features in Nova. Admins can change this preference in the `app/config/config.php` file.

### Database

CodeIgniter has an extensive list of options for configuring connections to the database. These options are covered in more depth in the [install guide](article/nova-2/install-guide). Database connection information can be found in the `app/config/database.php` file.

## Advanced System Settings

### Auto-Loading

CodeIgniter comes with a lot of awesome helpers and libraries. By default, Nova auto-loads several of them we use quite often. You can add and remove from these lists in the `app/config/autoload.php` file.

By default, Nova auto-loads the following libraries: Database, Template, Menu, Input, Auth and User Panel. By default, Nova auto-loads the following helpers: Location, URL, Date, HTML, Language, and Form. For models, Nova auto-loads settings\_model and messages\_model. Finally, Nova auto-loads it's own configuration file (covered later in this document). For more information about auto-loading in CodeIgniter, please visit the [CodeIgniter User Guide](http://codeigniter.com/user_guide/general/autoloader.html).

<p class=\"alert alert-danger\"><strong>Warning:</strong> We don't recommend removing any of these as doing so will break Nova. In addition, use great care when adding items to auto-load as it will slow down Nova's run time.</p>

### URI Protocol

CodeIgniter gives admins the change the way the URI is retrieved. This item determines which server global should be used to retrieve the URI string. The default setting of __AUTO__ works for most servers. If your links do not seem to work, try one of the other options. CodeIgniter also allows __PATH_INFO__, __QUERY_STRING__, __REQUEST_URI__, and __ORIG_PATH_INFO__. We don't recommend changing this unless you absolutely have to!

### URL Suffix

CodeIgniter allows admins to add an additional suffix to the end of their URLs. More information about this can be found in the [CodeIgniter User Guide](http://codeigniter.com/user_guide/general/urls.html).

### System Hooks

CodeIgniter comes with a powerful hooks system for tapping in to the system during initialization at several different points. Nova does not use hooks, but if you want to develop a plugin or MOD that uses hooks, the feature will need to be enabled. You can enable system hooks by setting the config variable to __TRUE__. This config setting can be found in `app/config/config.php`. More information about system hooks can be found in the [CodeIgniter User Guide](http://codeigniter.com/user_guide/general/hooks.html). If you are using system hooks, you will define them in `app/config/hooks.php`.

### Class Extension Prefix

CodeIgniter's class-based approach allows core classes to be extended by using a simple prefix. By default, CI uses __MY___ as the prefix. You can change this if you need to, but be warned that changing this will break Nova at several points. You should use great caution when change this setting!

### Allowed URL Characters

CodeIgniter allows an admin to set what characters are permitted in the URL. By default, CI permits all letters, all numbers, as well as `~ % . : _ \ -.` You are encouraged to leave this setting alone. Changing this can have major security repercussions for your Nova site!

### Query Strings

By default CodeIgniter uses search-engine friendly segment based URLs: `www.your-site.com/who/what/where/`. You can optionally enable standard query string based URLs `www.your-site.com?who=me&amp;what=something&amp;where=here`. The other items let you set the query string \"words\" that will invoke your controllers and its functions: `www.your-site.com/index.php?c=controller&m=function`. You can change this in `app/config/config.php`.

<p class=\"alert alert-warning\"><strong>Note:</strong> Some of the helpers won't work as expected when this feature is enabled, since CodeIgniter is designed primarily to use segment based URLs.</p>

### Session Settings

Nova stores session data right in the database and CodeIgniter provides some configuration options. You shouldn't need to touch any of the session settings, but in the event you do need to, they can be found in the `app/config/config.php` file. You can change the name of the table where the data is stored, the time to update the session, whether to use the database or not, encrypting cookies (if they're being used to store session data), and other options. In addition, CodeIgniter also provides the ability to change cookie specific options.

<p class=\"alert alert-danger\"><strong>Warning:</strong> Changing any of these values can cause Nova to stop working altogether!</p>

### Global XSS Filtering

CodeIgniter has the option to filter everything for cross site scripting (XSS) attacks. By default, we don't enable this option as it can cause issues with passwords that use any special characters. Instead, we filter POST values for XSS issues in the controllers. If you want to change this, you can simply enable XSS filtering. The option can be found in the `app/config/config.php` file.

<p class=\"alert alert-danger\"><strong>Warning:</strong> Changing this will cause a pretty decent performance drop with Nova as filtering everything for XSS takes more resources.</p>

### Output Compression

CodeIgniter has a feature to allow for Gzipping output for faster page loads. Only enable this feature if you know your server can handling this and are reasonably confident that your users are using browsers that support this feature! The setting can be found in `app/config/config.php`.

### Rewrite PHP Short Tags

CodeIgniter has a feature that allows for rewriting PHP short tags on servers that don't have the option turned on in the PHP configuration, eliminating errors and mishandled pages. By default, Nova runs with this disabled as we've gone to great lengths not to use PHP short tags. You can change this setting from `app/config/config.php`, however, you may see a slight drop in performance by doing so.

### Constants

CodeIgniter comes with a small group of system constants for working with files and some characters. Those constants can be found in `app/config/constants.php`.

<p class=\"alert alert-warning\"><strong>Note:</strong> Anodyne will regularly update the constants in this file for system updates, so any constants you want to create should be put in the controllers or in the Nova config file. Altering any of these constants can cause some of Nova's feature to stop working!</p>

### Routes

CodeIgniter allows URLs to be re-routed. You can set up re-routing rules in `app/config/routes.php`. This page also sets the default controller (in Nova, it's __main__). More information about routes can be found in the [CodeIgniter User Guide](http://codeigniter.com/user_guide/general/routing.html).

## System Email Settings

Nova uses CodeIgniter's Email class for delivering email from the system to the users of the RPG. The Email class allows for setting a wide array of options for the emails and all those settings can be changed from the configuration file located at `app/config/email.php`. Below are some of the most common items admins may want to change. For more detailed information about CodeIgniter's Email class, please visit the [CodeIgniter User Guide](http://codeigniter.com/user_guide/libraries/email.html).

### Email Protocol

Depending on your server, you can change the protocol used to deliver email. By default, Nova uses PHP's `mail()` function. The options you can specify are __mail__, __sendmail__ or __smtp__.

<p class=\"alert alert-warning\"><strong>Note:</strong> If you specify SMTP as the delivery method, you will also have to specify the SMTP host, user, password, port and timeout. If you specify sendmail as the delivery method, you will also have to specify the path to sendmail. Please contact your host about these items.</p>

### Mail Type

Nova allows admins to change the type of email that are delivered to users. By default, Nova will attempt to deliver HTML emails, however, some email hosts can classify HTML emails as spam more quickly than text only emails. Because of that, admins can change the mail type to text to have emails delivered in the same format as SMS. The only options accepted by CodeIgniter for the mail type are __html__ and __text__.

## System FTP Settings

CodeIgniter provides an FTP class that Nova uses for trying to adjust file permissions during install and for deleting upload files. You can choose to set these settings if you want or ignore them. Nova will work either way. For more detailed information about CodeIgniter's FTP class, please visit the [CodeIgniter User Guide](http://codeigniter.com/user_guide/libraries/ftp.html).

From the FTP config file located at `app/config/ftp.php`, you can set your host name, username, password and port for use by CodeIgniter in connecting to your server for advanced operations. If you change settings in this file, make sure the file's permissions on the server are set to an appropriately safe level (664 should be fine).", 'keywords' => 'config, configure, codeigniter, ci, email, mail, uri, ftp, security, xss, routes, output, compression, session, class prefix, hook, autoloading, database', 'tags' => [9]],
		];
	}

}
