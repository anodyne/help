<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateNova1Articles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach ($this->articles() as $article)
		{
			$article['product_id'] = 1;
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
		Article::where('product_id', 1)->delete();
	}

	public function articles()
	{
		return [
			['title' => "Nova 1.2 Changelog", 'slug' => "", 'summary' => "", 'content' => "## 1.2.6 <small>15 July 2011</small>

### Bug Fixes

* Addressed some major security issues.
* The Writing Control Panel included several wrong links.
* Character mission posts weren't accurately pulled from the database.

## 1.2.5 <small>16 June 2011</small>

### Bug Fixes

* Specification data wouldn't get added to the database table for old items if a new field was added.
* Deactivated users would retain their account flags (system administrator, game master, webmaster) and wouldn't have their access role changed.
* Reactivated users wouldn't be given a reasonable access role.

## 1.2.4 <small>25 January 2011</small>

### Nova Core

* Updated to jQuery UI 1.8.9.

### Bug Fixes

* Mission posts weren't accurately counted.
* The user acceptance email CCed in more people that needed to be.
* The manifest wouldn't load in Internet Explorer 7.

## 1.2.3 <small>04 January 2011</small>

### Bug Fixes

* Addressed issues handling deck listings and multiple specification items.

## 1.2.2 <small>30 December 2010</small>

### Bug Fixes

* Sub departments couldn't be managed from the Department management page.
* Mission post emails didn't display the authors properly.
* Addressed access issues created by the update from 1.1.2.

## 1.2.1 <small>23 December 2010</small>

### Bug Fixes

* Positions would disappeaer when being updated.
* Errors thrown when trying to update character images when there aren't any images present.
* Error thrown from the RSS feed.

## 1.2 <small>20 December 2010</small>

* Admins can now ban users from applying to the game (level 1) or even getting in to the site (level 2)
* If the system detects a Level 2 ban, the user will be redirected to a new page with information about why they aren't allowed to get to the site.
* The application report now shows the email address and IP address of the applicant.
* The email sent to the game master(s) from the join form now shows the IP address of the applicant.
* Made the contact form simpler.
* The contact form now uses proper form validation to make sure all the fields are completed properly.
* Department Management now has a new user interface to make working with departments easier.
* Position Management now splits departments out by manifest.
* Users can no longer get to any of the writing features if they don't have a character associated with their account.

### Nova Core

* Added a new validation error image.
* Added a new assignment image.
* Added the jQuery prettyPhoto plugin to replace jQuery Fancybox.
* Removed the jQuery Fancybox plugin.
* Updated to CodeIgniter 1.7.3.
* Updated to jQuery 1.4.4.
* Updated to jQuery UI 1.8.7.
* Updated to jQuery markItUp! 1.1.9.
* The Departments model now has methods for handling multiple manifests.
* The User model now has a method to pull user information based on characters in the database.
* Some of the models needed to be updated to correct for situations where the user or character ID isn't present.

### Bug Fixes

* The autoload config item tried to autoload the Input library. This isn't necessary since CodeIgniter loads it by default.
* Fixed some typos in the install data.
* Users without an active character would be shown in the activity warning panel on the Admin Control Panel.
* A codele post submitted by an applicant would just be a massive block of text in the email sent to the game master(s).
* Some specifications weren't properly upgraded during the SMS Upgrade process.
* A mission closing tag on the Create Characters page was causing some issues.
* The timezone menu in Site Settings pulled the wrong value from the database to populate the field with.
* The join form pulled one of its images from the admin section instead of the main section.
* Whitespace issues in Access Role management, News Item management, Personal Log management, Mission Post management and Department management.
* Fixed the errors thrown throughout the system.
* Some errors were thrown throughout the system when a user didn't have a character associated with their account.
* Flash message view couldn't be overridden with seamless substitution.
* Mission post emails were sent with the user's primary character name attached to it even if the primary character isn't associated with the post.
* Private message emails didn't contain the content of the private message.
* Personal logs didn't have the right date when they were first saved.
* Pending users would appear in the recipients dropdown for private messages.
* Changing a dynamic form field from text/textarea to dropdown wouldn't trigger the dropdown values section to open. This essentially rendered the field useless and would cause admins to have to delete the field and start over.", 'tags' => [4,8]],

			['title' => "Nova 1.1 Changelog", 'slug' => "", 'summary' => "", 'content' => "## 1.1.2 <small>14 October 2010</small>

### Nova Core

* Instead of duplicating code, Nova's form helper now extends the dropdown functions.
* When writing or editing a mission post, we now take the author list in to account in the author selection dropdown. (Thanks to Patric for helping with this.)

### Bug Fixes

* Addressed an issue when adding an author when creating or editing a mission post. (Thanks to Patric for this fix.)
* Nova would try to update a user's profile with a field that doesn't exist.
* Under very strange circumstances, Quick Install wouldn't work the way it's supposed to.

## 1.1.1 <small>27 September 2010</small>

### Nova Core

* Updated to jQuery UI 1.8.5.
* Updated to jQuery markItUp! 1.1.8.

### Bug Fixes

* The system wouldn't display if the template file couldn't be found (blank white screen).
* The general tour items category would be shown even if there weren't any general tour items.
* Skins with dashboard handles were showing bullets and having weird spacing issues.

## 1.1 <small>4 September 2010</small>

* Admins can now create multiple specification items.
* Admins can now associate tour items with a single specification item.
* Users (with proper permissions) can upload specification items through the upload interface.

### Nova Core

* Added the jQuery Fancybox plugin.
* Added the jQuery Reflection plugin and updated the system to use this plugin instead of reflection.js.
* Removed the jQuery Colorbox plugin.
* Removed the reflection.js plugin.
* Updated the jQuery UI to version 1.8.4.
* The specifications model now has new methods for handling specification items.
* Applied some minors updates to the mission groups listing user interface.

### Bug Fixes

* Ordered and unordered lists weren't properly styled in Thresher.
* Missions inside mission groups don't respect the mission order set for them.
* The author dropdown when replying to a private message wasn't populating with data in some cases.
* Mission post next and previous links were wrong under certain circumstances.
* Personal log next and previous links were wrong under certain circumstances.
* News item next and previous links were wrong under certain circumstances.
* The model methods that pulled command staff, game master and webmaster emails returned all users, not just active users.
* Error was thrown about an undefined class method when deleting uploaded items.", 'tags' => [4,8]],

			['title' => "Nova 1.0 Changelog", 'slug' => "", 'summary' => "", 'content' => "## 1.0.6 <small>14 July 2010</small>

### Nova Core

* The Character Bio management page shows a loader until everything has finished loading.
* Turned down the debug level (fatal errors and database errors are still shown).
* The recipients menu when writing a private message now separates active and inactive characters.
* Updated to jQuery UI 1.8.2.
* Updated to jQuery Colorbox 1.3.8.
* Removed some debug code from the Auth library since the Remember Me bug seems to have been solved.
* Added a method to the Characters model for inserting promotion records.
* Added a method to the Users model for removing user preference values.
* Addressed a security issue in CodeIgniter's Upload class.

### Bug Fixes

* Error thrown when posting a comment on a mission post.
* Error thrown when attempting to delete a character.
* Error thrown during step 2 of the update process for some admins.
* Error thrown when there's only one mission image set on the mission details page.
* Error thrown when there's only one tour iamge set on the tour details page.
* Error thrown when there's only one character image set on the character bio page.
* Acceptance and rejection messages were sent without any of the changes the admin made.
* Changing a character's status to and from active wouldn't set the open slots of the position(s).
* When creating a character, the position dropdowns showed all positions instead of only open positions.
* Rank history information wasn't being populated correctly.
* Turning off update notification still attempted to run the check.
* A user's email preferences remained active even after the user was deactivated.
* A user's email preferences weren't removed when the user was removed.

## 1.0.5 <small>06 June 2010</small>

### Bug Fixes

* Errors thrown after the SMS Upgrade process on Characters management.
* Error thrown after the SMS Upgrade process on NPC management.
* Errors thrown when editing a wiki page.
* Hidden departments were shown in the positions dropdown menu.
* A wrong variable was used in a model method.
* Addressed a security issue where docking request data wasn't filtered for XSS attacks.
* Docking request emails sent to the game master(s) had several bugs.
* Error thrown when updating a user to be inactive.
* There were no sanity checks on the type of variable needed when handling character deactivation.
* Errors thrown when rejecting a docking request.
* Unlinked NPCs wouldn't be able to use newly created bio fields.
* Site Options didn't allow admins with access to the Skin Catalogue to select skins in development.
* Join form instructions weren't displayed.

## 1.0.4 <small>12 May 2010</small>

### Nova Core

* The `MY_Input` library tries to filter for Microsoft Word special character a little better.
* The Archives feature now requires PHP 5.0 or higher.
* Thresher now requires PHP 5.0 or higher.
* Updated to jQuery UI 1.8.1.
* UPdated to jQuery markItUp! 1.1.7.

### Bug Fixes

* Error thrown when a user with Level 1 user account access updated their account.
* Saved personal logs could be shown along with activated personal logs for users with multiple characters associated with their account.
* Internet Explorer threw an exception on the Mission Post, Personal Log, News Item and Docked Item management pages.
* Error thrown on the contact page.
* Errors thrown on the Manage Bio page for users with Level 1 access.
* Character position was updated from the Manage Bio page even when they shouldn't be.
* The status change email wasn't populated properly.
* The Textile parser had some bugs. (Thanks to Dustin for catching these issues.)
* Addressed an issue with emails on some servers.
* Attempted to fix some errors thrown in some circumstances during updates.

## 1.0.3 <small>26 April 2010</small>

### Nova Core

* Removed the dependency on the versions array file. Instead, we try to pull a listing of the update directory dynamically (though we still use the array file in the the event the directory listing fails).
* Separated some code for character deletion between playing characters and NPCs.
* Added notices to the dynamic form management pages if there's no content available.
* Added some debug code to the Auth library to help track down the Remember Me bug.
* Cleaned up the Posts model.
* Added a parameter to a Post model method to help with issues in with unattented posts.
* When deactivating a user, we deactivate the user's characters at the same time.
* The Update Center to show the links to start the update regardless of whether there's information about the update or not.

### Bug Fixes

* The Create Wiki page link didn't show up in the sub navigation menu.
* Posts weren't accurately counting unattented posts when a character ID was passed in as an integer instead of an array.
* Errors were thrown when deleting characters and NPCs.
* Error was thrown when writing a Mission Post.
* The post notification stayed active even after the post had been updated and/or emailed out.
* Errors thrown when adding a rank.
* Error thrown when there are no fields in a specification form section.
* Error thrown in the Admin Control Panel.
* Wiki pages were being categorized as Uncategorized even if they had categories.
* Error thrown for missing option parameters.
* Error thrown when accepting or rejecting a docked ship application.
* Thresher wasn't using the right regions in the Template config file.

## 1.0.2 <small>20 April 2010</small>

### Nova Core

* The Ranks model uses the genre when looking for the default rank catalogue item.
* The Ranks model only pulls ranks sets from the current genre when getting all ranks.
* The Ranks model only pulls rank catalogue items for the current genre.
* The Ranks model `get_group_ranks()` method now has a parameter for a custom identifier.
* The Auth library checks for a user's status and will no longer allow pending users to log in.
* The Auth library will now allow 5 log in attempts before locking the user out.
* Admins can now add and edit the genre for Rank Catalogue items.
* The Upload Management page now shows a message if uploaded images weren't found in specific categories.
* Turned up the debug level so users could see any errors for debugging purposes.
* When a user updates their password and they're set to have Nova remember them, their cookie will be reset with the new password.

### Bug Fixes

* The Menu library wouldn't respect any access control put on main navigation menu items or sub navigation menu items.
* Undefined variable error was thrown in the Rank Catalogue.
* The Rank Catalogue wouldn't work well when multiple genres were installed.
* Uploaded images (besides bio images) couldn't be deleted.
* Authors were dropped off of mission posts because of some flawed logic.
* The codele post wasn't in the email sent to the game master(s).
* Ranks couldn't be added in Internet Explorer.
* Rank classes wouldn't be shown for rank sets without a blank name rank item.
* The user bio pointed to the wrong location for user posts and user awards.
* Listing all of a user's posts would display posts besides their own.
* When commenting on a mission post, an error would be thrown.
* Updating a news item threw a fatal error.
* Updating a personal log threw a fatall error.
* Log in error 6 presentation issues.
* The mission dropdown wasn't properly populated when viewing a saved post.
* Added a special call to the `MY_Input` library to do some text cleanup after filtering for XSS.
* News items could be posted without a category.
* There were some minor schema differences between SMS and Nova created by the SMS Upgrade process.
* Addressed some of the Remember Me lockout issues.

## 1.0.1 <small>16 April 2010</small>

* A database field wasn't properly added during the SMS Upgrade process.
* Models couldn't be autoloaded because `Base4.php` didn't extend `My_Loader`.
* An error was thrown because the `date_default_timezone_set` function doesn't exist in PHP before version 5.1.

## 1.0 <small>15 April 2010</small>

* Initial release", 'tags' => [4,8]],
		];
	}

}
