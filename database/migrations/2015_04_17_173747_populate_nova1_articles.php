<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateNova1Articles extends Migration {

	protected $productId = 1;

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

			['title' => "Installing Nova", 'slug' => "install", 'summary' => "Step-by-step instructions on getting up and running with Nova 1", 'content' => "Installing Nova on your server is a relatively painless process that should only take a few minutes if you have all the pieces you need at the start. In order to install Nova on your server, you'll need the following information:

* Your database location (localhost or another means of connecting)
* Your database name
* Your database username &amp; password (these may or may not be the same as your FTP username &amp; password ... if you have questions, contact your host)
* Your FTP username &amp; password

## Step 1: Upload Nova

To begin with the install, you must upload the Nova files up to your server.

## Step 2: Configuring Nova

Before you can begin the installation, there are a couple steps you need to do.

### Database Connection

The first thing you'll need to do before installing Nova is to set up your database connection parameters. If the connection isn't setup properly, you won't be able to connect to the database to create the tables needed and insert the necessary data. To set your database connection parameters, open `application/config/database.php`. Several variables on the page need to be filled out in order to continue.

Simply fill in the variables with your own values, making sure that you don't remove any of the quotation marks in the process.

	\$db['default']['hostname'] = \"localhost\";
	\$db['default']['username'] = \"username\";
	\$db['default']['password'] = \"password\";
	\$db['default']['database'] = \"database_name\";
	\$db['default']['dbdriver'] = \"mysql\";
	\$db['default']['dbprefix'] = \"nova_\";

#### Explaining the Parameters

* __hostname__ - this is the hostname of your database server. In most cases, this is _localhost_, but if your host is setup differently or uses a socket, you may have to change this connection parameter.
* __username__ - this is the username you use to identify yourself to the database server. This isn't necessarily the same as your FTP username, so make sure you check with your host about what your database username is.
* __password__ - this is the password you use to authenticate yourself to the database server. This isn't necessarily the same as your FTP password, so make sure you check with your host about what your database password is.
* __database__ - this is the name of your database and tells Nova exactly where to look for the database tables and where to install the data. If you don't know what this is, contact your host.
* __dbdriver__ - the database driver is the type of database you're using. Currently, Nova allows MySQL and MySQLi connections to the database. For most users, MySQL is the best option, but if you know you have the mysqli interface on your server and are using a server with PHP 5 and MySQL 4.1 or higher, you can optionally choose to run Nova through the mysqli interface instead.
* __dbprefix__ - Nova uses a database prefix before each table name to allow you to install more than one instance of Nova in the same database or even to have multiple systems running from the same database. By default, this is set to _nova__, but you can change it to something else if need be.

#### Advanced Options

For users who have hosts with other options, CodeIgniter allows setting whether or not to cache queries, where to cache them to, whether to use a persistent connection and allowing changes to the charcter set and collation of the database. Changing these settings is only recommended for advanced users or if absolutely necessary.

### FTP Library

Nova allows users to upload their own images to the server and use them in their bios. In order to allow this feature, you have to configure the FTP library. In order to do that, you'll need to edit `application/config/ftp.php`.

* __hostname__ - this is the location of your server like you're connecting with your FTP client
* __username__ - this is your FTP username
* __password__ - this is your FTP password
* __port__ - this is the port you connect to your server over. If you use SFTP, use port 22, otherwise port 21 is fine.
* __passive__ - if your host requires a passive connection to the server, change this value to ___TRUE___
* __debug__ - if you need debug information for your FTP connection, change this value to ___TRUE___

## Step 3: Setting Up Your Genre

By default, Nova ships with DS9 as the default genre, but you can change that to a wide variety of options. In order to change this information, open `application/config/nova.php`.

Simply change the genre code to the genre you want. A complete list of available genres can be seen directly above this line of code. Putting in a value that is not in this list and does not have an install file and assets directory will cause the system to break!

	\$config['genre'] = \"DS9\";

### Other Options

The Nova config file also gives you other options to change. Besides changing your genre, you can also change the meta data associated with the site and RSS feed information.

## Step 4: Install the System

Once you have updated the database connection config file and set your genre, you can begin to install the system by opening a browser and navigating to your site. Nova will immediately check to see if the system is installed and if it isn't, redirect you to the installation page. From there, you can choose to do a fresh installation of Nova. Follow the process through to install Nova into your database to use for your RPG. The steps of the install process are as follows:

1. Create Nova database tables
2. Insert basic data into the tables
3. Create genre-specific tables and insert data into them
4. Set up your player account and the character name, rank and position of your primary character
5. Set up some basic system settings

## Step 5: Post-Installation

On PHP 5 systems, Nova will attempt to change several permissions in order to ensure all the upload features and backup features work properly. If you are running a server that uses PHP 4 or your server doesn't support allowing scripts to change permissions, you will have to make those changes manually. If you don't know how to change file permissions on your server, contact your host.

You will need to make sure that several directories are writable (777) in order for all the upload features to work:

* `application/assets/images`
* `application/assets/backups`
* `core/logs`", 'keywords' => "install", 'featured' => 1, 'tags' => [1,3]],

			['title' => "Nova License Agreement", 'slug' => "", 'summary' => "", 'content' => "Copyright (c) 2009, Anodyne Productions  
All rights reserved.

This license is a legal agreement between you and Anodyne Productions for the use of Nova Software (the \"Software\").  By obtaining the Software you agree to comply with the terms and conditions of this license.

## Permitted Use

You are permitted to use, display, modify, and distribute the Software and its documentation for any purpose, provided that the following conditions are met:

* Products or serviced derived from the Software may not be used for monetary gain without prior written consent from Anodyne Productions. This includes, but is not limited to: selling support, skins, modifications, or services.
* Redistribution of the complete Software or Software components are allowed through both official and third-party outlets provided that all conditions of the license are met.
* Redistributions in binary form (complete or component) must reproduce the above copyright notice in the documentation and/or other materials provided with the distribution.
* Any files that have been modified must carry notices stating the nature of the change and the names of those who changed them.
* Products derived from the Software may not be called \"Nova\", \"SMS\", or \"Anodyne\", nor may \"Nova\", \"SMS\", or \"Anodyne\" appear in their name, without prior written permission from Anodyne Productions.
* All conditions of the CodeIgniter licence must be properly met and the CodeIgniter license cannot be removed under any circumstances.

## Indemnity

You agree to indemnify and hold harmless the authors of the Software and any contributors for any direct, indirect, incidental, or consequential third-party claims, actions or suits, as well as any related expenses, liabilities, damages, settlements or fees arising from your use or misuse of the Software, or a violation of any terms of this license.

## Disclaimer of Warranty

THE SOFTWARE IS PROVIDED \"AS IS\", WITHOUT WARRANTY OF ANY KIND, EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, WARRANTIES OF QUALITY, PERFORMANCE, NON-INFRINGEMENT, MERCHANTABILITY, OR FITNESS FOR A PARTICULAR PURPOSE.

## Limitations of Liability

YOU ASSUME ALL RISK ASSOCIATED WITH THE INSTALLATION AND USE OF THE SOFTWARE. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS OF THE SOFTWARE BE LIABLE FOR CLAIMS, DAMAGES OR OTHER LIABILITY ARISING FROM, OUT OF, OR IN CONNECTION WITH THE SOFTWARE. LICENSE HOLDERS ARE SOLELY RESPONSIBLE FOR DETERMINING THE APPROPRIATENESS OF USE AND ASSUME ALL RISKS ASSOCIATED WITH ITS USE, INCLUDING BUT NOT LIMITED TO THE RISKS OF PROGRAM ERRORS, DAMAGE TO EQUIPMENT, LOSS OF DATA OR SOFTWARE PROGRAMS, OR UNAVAILABILITY OR INTERRUPTION OF OPERATIONS.", 'keywords' => "license", 'featured' => 1, 'tags' => [9]],

			['title' => "CodeIgniter License Agreement", 'slug' => "", 'summary' => "", 'content' => "Copyright (c) 2009, EllisLab, Inc.  
All rights reserved.

This license is a legal agreement between you and EllisLab Inc. for the use of CodeIgniter Software (the \"Software\"). By obtaining the Software you agree to comply with the terms and conditions of this license.

## Permitted Use

You are permitted to use, copy, modify, and distribute the Software and its documentation, with or without modification, for any purpose, provided that the following conditions are met:

* A copy of this license agreement must be included with the distribution.
* Redistributions of source code must retain the above copyright notice in all source code files.
* Redistributions in binary form must reproduce the above copyright notice in the documentation and/or other materials provided with the distribution.
* Any files that have been modified must carry notices stating the nature of the change and the names of those who changed them.
* Products derived from the Software must include an acknowledgment that they are derived from CodeIgniter in their documentation and/or other materials provided with the distribution.
* Products derived from the Software may not be called \"CodeIgniter\", nor may \"CodeIgniter\" appear in their name, without prior written permission from EllisLab, Inc.

## Indemnity

You agree to indemnify and hold harmless the authors of the Software and any contributors for any direct, indirect, incidental, or consequential third-party claims, actions or suits, as well as any related expenses, liabilities, damages, settlements or fees arising from your use or misuse of the Software, or a violation of any terms of this license.

## Disclaimer of Warranty

THE SOFTWARE IS PROVIDED \"AS IS\", WITHOUT WARRANTY OF ANY KIND, EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, WARRANTIES OF QUALITY, PERFORMANCE, NON-INFRINGEMENT, MERCHANTABILITY, OR FITNESS FOR A PARTICULAR PURPOSE.

## Limitations of Liability

YOU ASSUME ALL RISK ASSOCIATED WITH THE INSTALLATION AND USE OF THE SOFTWARE. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS OF THE SOFTWARE BE LIABLE FOR CLAIMS, DAMAGES OR OTHER LIABILITY ARISING FROM, OUT OF, OR IN CONNECTION WITH THE SOFTWARE. LICENSE HOLDERS ARE SOLELY RESPONSIBLE FOR DETERMINING THE APPROPRIATENESS OF USE AND ASSUME ALL RISKS ASSOCIATED WITH ITS USE, INCLUDING BUT NOT LIMITED TO THE RISKS OF PROGRAM ERRORS, DAMAGE TO EQUIPMENT, LOSS OF DATA OR SOFTWARE PROGRAMS, OR UNAVAILABILITY OR INTERRUPTION OF OPERATIONS.", 'keywords' => "license, codeigniter, ci", 'featured' => 1, 'tags' => [9]],

			['title' => "Nova 1 Requirements", 'slug' => "requirements", 'summary' => "The server and browser requirements for Nova 1", 'content' => "## Server Requirements

Nova comes with a server verification tool you can run before installing to ensure your server can run Nova without any problems. For those without access to the server or who want to verify the requirements ahead of time, the following items are the minimum requirements and Anodyne's recommendations.

### Minimum

In order to run Nova, your server must meet, at the minimum, the following criteria:

* PHP version 4.3.2 or newer (PHP 5.0 or newer required for Nova's mini-wiki and SMS Archives feature)
* MySQL version 4.1+ or MySQLi
* Apache or IIS
* Server memory limit of at least 8M
* 15MB of free space

### Recommedation

After extensive testing and development, Anodyne recommends the following server setup if it's available:

* PHP version 5.2 or newer
* MySQL version 5 or newer
* Server memory limit greater than 32M
* Apache 2 or higher
* Server running some form of *nix
* Register Globals turned __OFF__
* At least 30MB of free space

## Browser Requirements

In order to run at peak performance and with all features enabled, Nova requires that Javascript be turned __ON__. In addition, Anodyne recommends running a standards compliant browser like Firefox or Google Chrome for using the system. Nova will work in Internet Explorer 7 or higher, Firefox 2 or higher, Safari 3 or higher and Google Chrome.", 'keywords' => "php, mysql, requirements, browser", 'featured' => 1, 'tags' => [9]],

			['title' => "Upgrading from SMS 2 to Nova", 'slug' => "upgrade", 'summary' => "Step-by-step instructions for upgrading your content from SMS 2 to Nova 1", 'content' => "Upgrading from SMS to Nova is an easy process that should take anywhere between 5 and 10 minutes to complete depending on your server and Internet connection. In order to upgrade to Nova on your server, you'll need the following information:

* Your database location (localhost or another means of connecting)
* Your database name
* Your database username and password (these may or may not be the same as your FTP username and password ... if you have questions, contact your host)
* Your FTP username and password

In order to upgrade to Nova, you must be using the same database as your SMS tables are in. If you want to do an upgrade in another table, you'll need to export your SMS tables to a file and then import them into the new table to use during the upgrade process.

Before you begin, you'll also need to set the upgrade password and email address (discussed later).

<p class=\"alert alert-warning\"><strong>Note:</strong> This upgrade guide is long and can seem daunting, but we encourage you to read through the whole thing <strong>before</strong> beginning the upgrade process.</p>

## Step 1: Upload Nova

The first thing we recommend doing is backing up your SMS files to your computer. Once you have downloaded the files, you can store them some place safe in the event you need to access the files. You can also choose to push the files into their own sub directory on the server, but doing so can create complications if someone is posting on the old site.

To begin with the upgrade, delete all the files from the directory where you'll be storing Nova. Once the directory is cleaned out, you can safely upload the Nova files up to your server.

## Step 2: Configuring Nova

Before you can begin the installation, there are a couple steps you need to do.

### Database Connection

The first thing you'll need to do before installing Nova is to set up your database connection parameters. If the connection isn't setup properly, you won't be able to connect to the database to create the tables needed and insert the necessary data. To set your database connection parameters, open `application/config/database.php`. Several variables on the page need to be filled out in order to continue.

Simply fill in the variables with your own values, making sure that you don't remove any of the quotation marks in the process.

	\$db['default']['hostname'] = \"localhost\";
	\$db['default']['username'] = \"username\";
	\$db['default']['password'] = \"password\";
	\$db['default']['database'] = \"database_name\";
	\$db['default']['dbdriver'] = \"mysql\";
	\$db['default']['dbprefix'] = \"nova_\";

#### Explaining the Parameters

* __hostname__ - this is the hostname of your database server. In most cases, this is _localhost_, but if your host is setup differently or uses a socket, you may have to change this connection parameter.
* __username__ - this is the username you use to identify yourself to the database server. This isn't necessarily the same as your FTP username, so make sure you check with your host about what your database username is.
* __password__ - this is the password you use to authenticate yourself to the database server. This isn't necessarily the same as your FTP password, so make sure you check with your host about what your database password is.
* __database__ - this is the name of your database and tells Nova exactly where to look for the database tables and where to install the data. If you don't know what this is, contact your host.
* __dbdriver__ - the database driver is the type of database you're using. Currently, Nova allows MySQL and MySQLi connections to the database. For most users, MySQL is the best option, but if you know you have the mysqli interface on your server and are using a server with PHP 5 and MySQL 4.1 or higher, you can optionally choose to run Nova through the mysqli interface instead.
* __dbprefix__ - Nova uses a database prefix before each table name to allow you to install more than one instance of Nova in the same database or even to have multiple systems running from the same database. By default, this is set to _nova\__, but you can change it to something else if need be.

#### Advanced Options

For users who have hosts with other options, CodeIgniter allows setting whether or not to cache queries, where to cache them to, whether to use a persistent connection and allowing changes to the charcter set and collation of the database. Changing these settings is only recommended for advanced users or if absolutely necessary.

### FTP Library

Nova allows users to upload their own images to the server and use them in their bios. In order to allow this feature, you have to configure the FTP library. In order to do that, you'll need to edit `application/config/ftp.php`.

* __hostname__ - this is the location of your server like you're connecting with your FTP client
* __username__ - this is your FTP username
* __password__ - this is your FTP password
* __port__ - this is the port you connect to your server over. If you use SFTP, use port 22, otherwise port 21 is fine.
* __passive__ - if your host requires a passive connection to the server, change this value to __TRUE__
* __debug__ - if you need debug information for your FTP connection, change this value to __TRUE__

## Step 3: Setting Up Your Genre

By default, Nova ships with DS9 as the default genre, but you can change that to a wide variety of options. In order to change this information, open `application/config/nova.php`.

Simply change the genre code to the genre you want. A complete list of available genres can be seen directly above this line of code. Putting in a value that is not in this list and does not have an install file and assets directory will cause the system to break!

	\$config['genre'] = \"DS9\";

### Other Options

The Nova config file also gives you other options to change. Besides changing your genre, you can also change the meta data associated with the site and RSS feed information.

## Step 4: Set Your SMS Upgrade Options

You can choose which SMS items you want upgraded to Nova through the SMS config file located at `application/config/sms.php`. By default, Nova will upgrade the following items:

* Awards
* Some SMS global settings
	* Ship prefix, name and registry to sim name setting
	* The year the sim operates in
	* The way joint posts are counted
	* Email subject
	* The posting requirement in days
* Some SMS messages
	* Welcome message
	* The Sim message
	* Join disclaimer
	* Join sample post question
	* Acceptance email message
	* Rejection email message
* Missions
* Mission Posts
* Personal Logs
* News Items and Categories
* Specifications
* Tour Items

<p class=\"alert alert-warning\"><strong>Note:</strong> Characters and players will be automatically upgraded and the option cannot be turned off.</p>

### Changing the Upgrade Options

If you want to change the options for which items are upgraded, simply change the value of the item to __FALSE__. Unlike other places, the words false should __not__ be in quotation marks. An updated options array would look like this:

	\$config['sms'] = array(
		'awards'		=> TRUE,
		'settings'		=> FALSE,
		'logs'			=> TRUE,
		'missions'		=> TRUE,
		'news'			=> FALSE,
		'posts'			=> TRUE,
		'specs'			=> TRUE,
		'tour'			=> FALSE
	);

### Setting the Upgrade Password

Because of the difference in encryption hashes being used to store passwords, Nova __cannot__ transfer passwords from the SMS format to the Nova format. Because of this, you can set the password that all members of the sim will have to use in order to login the first time. Once they've logged in, they can change their password through the Accounts page. To change the password, simply change the `sms\_password` line in the SMS config file.

	\$config['sms_password'] = 'password';

<p class=\"alert alert-danger\"><strong>Note:</strong> We highly recommend you change the password before beginning the upgrade process!</p>

### Setting Your Email Address

In order to set proper access roles to allow you to login and manage your new Nova site, you will need to set the email address you use for your account in SMS in the SMS config file. This can be set in the SMS config file located at `application/config/sms.php`.

	\$config['sms_email'] = 'me@example.com';

<p class=\"alert alert-danger\"><strong>Note:</strong> If you don't change the email address, you will not have access to the management features when you log in!

## Step 5: Backup Your Database

Before you do anything with Nova, we recommend that you back up your SMS files and database before beginning.

<p class=\"alert alert-warning\"><strong>Note:</strong> The first thing Nova attempts to do when upgrading is backup your database and store it as a zip archive on your server. Larger SMS database may not be able to be backed up because of the resources required to do so. You should always manually backup your database before making major changes.</p>

## Step 6: Install Nova

To begin the upgrade process, open your browser and navigate to your site. Nova will automatically try to see if Nova is installed. If it isn't found, you will be redirected to the installation center where you can select the upgrade option. Simply follow the prompts through the process to install Nova and upgrade your data from the SMS format to the Nova format.

Once Nova is installed, the rest of the upgrade process will continue automatically.

## Step 7: Upgrade SMS

<p class=\"alert alert-warning\"><strong>Note:</strong> The only time Nova touches the SMS tables is to read or copy them and will never make any changes to them. The SMS tables will remain intact throughout the upgrade process.</p>

Due to the vast amount of data being transferred from the SMS tables to the Nova tables, the upgrade process can take several minutes to complete depending on your server and internet connection. Please be patient and don't hit the back button or close the browser. Doing so may require you to wipe out the Nova database tables and start all over again.

The following items will be upgraded during the upgrade process.

### SMS Site Globals and Messages

Nova stores site settings in a much different way allowing for admins to create new settings they can use in their own controller methods. Because of that and that many of SMS' site globals are obsolete, we only pull a select few items from the SMS database into the Nova settings table.

* The ship prefix, ship name and ship registry from SMS are combined into the sim name setting
* The sim year field is transferred
* The posting requirements field is transferred
* The way joint posts are counted is transferred
* The email subject is transferred

<p class=\"alert alert-warning\"><strong>Note:</strong> The first thing Nova does during this step is checks for the existence of a table called <strong>sms_settings</strong>. This is done because of issues some users have had that have required changing the name of the globals table in SMS. If Nova doesn't find that table, it'll fall back and use <strong>sms_globals</strong>. You do not need to change anything in your database to continue.</p>

In addition to site globals, Nova will also pull six of the messages out of SMS and put them into the proper places. The messages that will be pulled for the upgrade are:

* The welcome message
* The sim section message
* The join disclaimer
* The join page sample post question
* The acceptance email message
* The rejection email message

### Awards

Nova will copy the data from the SMS awards table to the Nova awards table. In the process, it will rename the fields to use the proper names and add columns as necessary. The reason we copy the data instead of looping through and inserting is to ensure the award IDs remain the same so that users don't lose their awards.

### Missions

Nova will copy the data from the SMS missions table to the Nova missions table. In the process, it will rename the fields to use the proper names and add columns as necessary. The reason we copy the data instead of looping through and inserting is to ensure the mission IDs remain the same so that mission posts don't lose their association with their missions.

### News Categories and Items

Nova will copy the data from the SMS news categories and new items tables to the respective Nova tables. In the process, it will rename the fields to use the proper names and add or remove columns as necessary. The reason we copy the data instead of looping through and inserting is to ensure the category IDs remain intact for the news items to use.

### Personal Logs

Nova will copy the data from the SMS personal logs table to the Nova personal logs table. In the process, it will rename the fields to use the proper names and add or remove columns as necessary.

### Mission Posts

Nova will copy the data from the SMS posts table to the Nova posts table. In the process, it will rename the fields to use the proper names and add or remove columns as necessary. Depending on the number of mission posts you have, this process could take several minutes to run.

### Specifications

Nova's specifications system was built in a very similar way to the way SMS is set up for specifications, so upgrading the data is relatively easy, though you may find some things are slightly off when it comes to defensive systems and weapons systems that you may have to manually update to be more accurate. Besides these minor issues, all your information should be transferred.

<p class=\"alert alert-warning\"><strong>Note:</strong> If you have made modifications to the specs pages and database table, those changes will not be transferred and you'll have to make those changes after the upgrade process is complete.</p>

### Tour Items

Nova's tour items system was built in a very similar way to the way SMS is set up for tour items, so upgrading the data is relatively easy.

<p class=\"alert alert-warning\"><strong>Note:</strong> If you have made modifications to the tour pages and database table, those changes will not be transferred and you'll have to make those changes after the upgrade process is complete.</p>

### Characters and Players

Easily the most intensive part of the upgrade process, Nova needs to take data from a single SMS table and disperse it across four different database tables and maintain the relationships between the data.

The first thing that'll be done is pulling player data from SMS and populating the Nova players table. Because people can have multiple accounts, Nova collects the most recent information for inserting into the database into a single entry. (The exception to this is the join date which uses the earliest entry.) Nova will use the real name, email address, join date, leave date, status and moderation flags.

After creating the player records, Nova will pull the character specific information out of SMS and insert basic data into the characters table and the rest of the data into the characters data table. For the basic information, Nova will use first name, middle name, last name, first position, second position, rank and images.

<p class=\"alert alert-warning\"><strong>Note:</strong> Nova uses a position translation function to try and convert SMS positions to Nova DS9 positions. For this to work perfectly, you need to have not made any changes to your positions table. If you have, you'll just have to update some of the characters' positions after the upgrade process is finished. The same goes for ranks.</p>

#### Passwords

SMS uses a 32-bit MD5 hash to store passwords, ensuring that only the account holder knows the password. Nova uses a more secure 40-bit SHA1 hash to store passwords. Because of the fact that MD5 hashes can't easily be decrypted, all users will have the same password until they login to change it. You can set the password in the SMS config file located at `application/config/sms.php`.

## Step 8: Post-Installation

On PHP 5 systems, Nova will attempt to change several permissions in order to ensure all the upload features and backup features work properly. If you are running a server that uses PHP 4 or your server doesn't support allowing scripts to change permissions, you will have to make those changes manually. If you don't know how to change file permissions on your server, contact your host.

You will need to make sure that several directories are writable (777) in order for all the upload features to work:

* `application/assets/images`
* `application/assets/backups`
* `core/logs`

## Known Errors

While we strive to make the upgrade process as seamless and accurate as possible, there's just no way to make it 100% accurate for 100% of the sims using SMS. If you've made any changes to your positions, departments or ranks, you'll have to manually make changes to characters. Because of the need to make these changes, Nova may throw errors (depending on what you've set your error reporting level to). These errors will go away when you've made the necessary updates. Below is a list of the errors you may encounter after an upgrade:

### Characters Management Page

Nova may throw an error about an undefined index in the characters_index.php file. This is caused by Nova looking for a department ID that doesn't exist. Once all your characters have been reassigned to their proper positions, the error will go away.

### NPCs Management Page

Nova may throw an error about an undefined index in the characters_npcs.php file. This is caused by Nova looking for a department ID that doesn't exist. Once all your NPCs have been reassigned to their proper positions, the error will go away.", 'keywords' => "sms, upgrade, migrate", 'featured' => 1, 'tags' => [1,3]],

			['title' => "Updating Nova", 'slug' => "", 'summary' => "Instructions for updating Nova 1 to a newer patch version with bug fixes and new features", 'content' => "It isn't enough to just release a system like Nova, you have to maintain it and you have to make it better. Anodyne intends to exactly that with Nova in the same way we've done it with SMS for years now. Because of that, on a regular basis you can expect to be notified of updates to Nova. Some of these may be minor and only address bugs while others will be larger and introduce new functionality to the system.

Please read the update notes that correspond to the version you are updating from.

<p class=\"alert alert-warning\"><strong>Note:</strong> These update notes only apply to the physical Nova files and not the database update portion. You can update the database from any version of Nova to a higher version.</p>

* [Updating from 1.2.5 to 1.2.6](/article/nova-1/update-125-126)
* [Updating from 1.2.4 to 1.2.5](/article/nova-1/update-124-125)
* [Updating from 1.2.3 to 1.2.4](/article/nova-1/update-123-124)
* [Updating from 1.2.2 to 1.2.3](/article/nova-1/update-122-123)
* [Updating from 1.2.1 to 1.2.2](/article/nova-1/update-121-122)
* [Updating from 1.2 to 1.2.1](/article/nova-1/update-120-121)
* [Updating from 1.1.2 to 1.2](/article/nova-1/update-112-120)
* [Updating from 1.1.1 to 1.1.2](/article/nova-1/update-111-112)
* [Updating from 1.1 to 1.1.1](/article/nova-1/update-110-111)
* [Updating from 1.0.6 to 1.1](/article/nova-1/update-106-110)
* [Updating from 1.0.5 to 1.0.6](/article/nova-1/update-105-106)
* [Updating from 1.0.4 to 1.0.5](/article/nova-1/update-104-105)
* [Updating from 1.0.3 to 1.0.4](/article/nova-1/update-103-104)
* [Updating from 1.0.2 to 1.0.3](/article/nova-1/update-102-103)
* [Updating from 1.0.1 to 1.0.2](/article/nova-1/update-101-102)
* [Updating from 1.0 to 1.0.1](/article/nova-1/update-100-101)

## Upload Notes

In each update page, we provide a list of files that have been changed. If you'd rather not go through files one by one, you can simply upload all the files at once, taking careful note of the situation below for Windows users.

### Windows Users

Over the years, we've come to realize that FTP clients on Windows aren't as robust as those found on Linux and Mac. Because of that, simply trying to overwrite a file(s) with your FTP client may not work and in fact, may end up causing issues in the long run. Because of the issue, we recommend that you first delete the files you're trying to update and then upload the fresh copies from the Nova zip archive to ensure everything is properly updated.

### Linux and Mac Users

To date, we have yet to see any issues with Linux or Mac FTP clients with regards to overwriting files. If you're still worried about the issue though, you can take the above precautions as well.

### Important Note

<p class=\"alert alert-danger\">When uploading files to your server, there are some files you <strong>do not</strong> want to overwrite. Pay careful attention to the list below!</p>

* `application/assets/backups`
* `application/assets/common`
* `application/assets/images` (unless specified)
* `application/config/database.php`
* `application/config/nova.php`
* `application/controllers` (except the base directory, you want to overwrite that)
* `application/models` (except the base directory, you want to overwrite that)
* `application/views` (except the _base directory, you want to overwrite that)", 'keywords' => "update", 'featured' => 1, 'tags' => [4]],

			['title' => "Updating from 1.0 to 1.0.1", 'slug' => "update-100-101", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

Replace these files and directories in your `core` folder with the new versions:

* `core/codeigniter/Base4.php`

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/assets/update/100.php`
* `application/assets/install`
* `application/index.php`
* `application/config/constants.php`
* `application/controllers/base/upgrade_base.php`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.0.1 to 1.0.2", 'slug' => "update-101-102", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

_There are no updates to the CodeIgniter core in Nova 1.0.2._

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/libraries/MY_Input.php`
* `application/assets/install`
* `application/assets/update`
* `application/index.php`
* `application/config/constants.php`
* `application/controllers/base/admin_base.php`
* `application/controllers/base/ajax_base.php`
* `application/controllers/base/login_base.php`
* `application/controllers/base/main_base.php`
* `application/controllers/base/manage_base.php`
* `application/controllers/base/site_base.php`
* `application/controllers/base/upload_base.php`
* `application/controllers/base/user_base.php`
* `application/controllers/base/write_base.php`
* `application/languages/english/base_lang.php`
* `application/languages/english/error_lang.php`
* `application/libraries/Auth.php`
* `application/libraries/Menu.php`
* `application/models/base/posts_model_base.php`
* `application/models/base/ranks_model_base.php`
* `application/views/_base/admin/ajax/add_catalogue_ranks.php`
* `application/views/_base/admin/ajax/edit_catalogue_ranks.php`
* `application/views/_base/admin/js/manage_ranks_js.php`
* `application/views/_base/admin/pages/site_catalogueranks.php`
* `application/views/_base/admin/pages/upload_manage.php`
* `application/views/_base/emails/html/main_join_gm.php`
* `application/views/_base/emails/text/main_join_gm.php`
* `application/views/_base/main/pages/personnel_user.php`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.0.2 to 1.0.3", 'slug' => "update-102-103", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

_There are no updates to the CodeIgniter core in Nova 1.0.3._

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/views/_base/admin/ajax/del_npc.php`
* `application/assets/install`
* `application/assets/update`
* `application/config/constants.php`
* `application/config/template.php`
* `application/controllers/base/admin_base.php`
* `application/controllers/base/ajax_base.php`
* `application/controllers/base/characters_base.php`
* `application/controllers/base/manage_base.php`
* `application/controllers/base/sim_base.php`
* `application/controllers/base/site_base.php`
* `application/controllers/base/update_base.php`
* `application/controllers/base/user_base.php`
* `application/controllers/base/wiki_base.php`
* `application/controllers/base/write_base.php`
* `application/language/english/base_lang.php`
* `application/language/english/text_lang.php`
* `application/libraries/Auth.php`
* `application/models/base/posts_model_base.php`
* `application/models/base/wiki_model_base.php`
* `application/views/_base/admin/js/characters_npcs_js.php`
* `application/views/_base/admin/pages/admin_index.php`
* `application/views/_base/admin/pages/site_bioform_all.php`
* `application/views/_base/admin/pages/site_dockingsections.php`
* `application/views/_base/admin/pages/site_specsform_all.php`
* `application/views/_base/ajax/userpanel_3.php`
* `application/views/_base/update/pages/update_check_main.php`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.0.3 to 1.0.4", 'slug' => "update-103-104", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

_There are no updates to the CodeIgniter core in Nova 1.0.4._

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/libraries/MY_Email.php`
* `application/assets/install`
* `application/assets/update`
* `application/assets/js/jquery.ui.accordion.min.js`
* `application/assets/js/jquery.ui.core.min.js`
* `application/assets/js/jquery.ui.datepicker.min.js`
* `application/assets/js/jquery.ui.mouse.min.js`
* `application/assets/js/jquery.ui.progressbar.min.js`
* `application/assets/js/jquery.ui.slider.min.js`
* `application/assets/js/jquery.ui.sortable.min.js`
* `application/assets/js/jquery.ui.tabs.min.js`
* `application/assets/js/jquery.ui.widget.min.js`
* `application/assets/js/markitup/jquery.markitup.js`
* `application/config/constants.php`
* `application/controllers/base/archive_base.php`
* `application/controllers/base/characters_base.php`
* `application/controllers/base/main_base.php`
* `application/controllers/base/manage_base.php`
* `application/controllers/base/user_base.php`
* `application/controllers/base/wiki_base.php`
* `application/libraries/MY_Input.php`
* `application/libraries/Thresher_Textile.php`
* `application/models/base/personallogs_model_base.php`
* `application/views/_base/admin/js/manage_posts_js.php`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.0.4 to 1.0.5", 'slug' => "update-104-105", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

_There are no updates to the CodeIgniter core in Nova 1.0.5._

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/assets/install`
* `application/assets/update`
* `application/config/constants.php`
* `application/controllers/base/ajax_base.php`
* `application/controllers/base/install_base.php`
* `application/controllers/base/main_base.php`
* `application/controllers/base/manage_base.php`
* `application/controllers/base/sim_base.php`
* `application/controllers/base/site_base.php`
* `application/controllers/base/update_base.php`
* `application/controllers/base/upgrade_base.php`
* `application/controllers/base/user_base.php`
* `application/controllers/base/wiki_base.php`
* `application/helpers/MY_form_helper.php`
* `application/views/_base/admin/pages/characters_index.php`
* `application/views/_base/admin/pages/characters_npcs.php`
* `application/views/_base/main/pages/main_join_2.php`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.0.5 to 1.0.6", 'slug' => "update-105-106", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

Replace these files and directories in your `core` folder with the new versions:

* `core/libraries/Upload.php`

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/assets/install`
* `application/assets/js`
* `application/assets/update`
* `index.php`
* `application/config/constants.php`
* `application/controllers/base/admin_base.php`
* `application/controllers/base/characters_base.php`
* `application/controllers/base/messages_base.php`
* `application/controllers/base/personnel_base.php`
* `application/controllers/base/sim_base.php`
* `application/controllers/base/update_base.php`
* `application/controllers/base/user_base.php`
* `application/language/english/base_lang.php`
* `application/libraries/Auth.php`
* `application/models/base/characters_model_base.php`
* `application/models/base/users_model_base.php`
* `application/views/_base/admin/js/characters_bio_js.php`
* `application/views/_base/admin/pages/characters_bio.php`
* `application/views/_base/admin/pages/characters_create.php`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.0.6 to 1.1", 'slug' => "update-106-110", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

_There are no updates to the CodeIgniter core in Nova 1.1._

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/assets/images/specs`
* `application/assets/install`
* `application/assets/js`
* `application/assets/update`
* `application/controllers/base`
* `application/assets/include_head_admin.php`
* `application/assets/include_head_login.php`
* `application/assets/include_head_main.php`
* `application/assets/include_head_wiki.php`
* `application/config/constants.php`
* `application/language/english/text_lang.php`
* `application/models/base/news_model_base.php`
* `application/models/base/personallogs_model_base.php`
* `application/models/base/posts_model_base.php`
* `application/models/base/specs_model_base.php`
* `application/models/base/tour_model_base.php`
* `application/models/base/users_model_base.php`
* `application/views/_base/admin/ajax/del_spec_item.php`
* `application/views/_base/admin/js/manage_specs_js.php`
* `application/views/_base/admin/js/manage_tour_js.php`
* `application/views/_base/admin/js/site_settings_js.php`
* `application/views/_base/admin/js/user_options_js.php`
* `application/views/_base/admin/pages/manage_specs.php`
* `application/views/_base/admin/pages/manage_specs_action.php`
* `application/views/_base/admin/pages/manage_tour.php`
* `application/views/_base/admin/pages/manage_tour_action.php`
* `application/views/_base/admin/pages/upload_manage.php`
* `application/views/_base/main/js/personnel_character_js.php`
* `application/views/_base/main/js/sim_missions_js.php`
* `application/views/_base/main/js/sim_specs_js.php`
* `application/views/_base/main/js/sim_tour_js.php`
* `application/views/_base/main/pages/personnel_character.php`
* `application/views/_base/main/pages/sim_missions_groups_all.php`
* `application/views/_base/main/pages/sim_missions_one.php`
* `application/views/_base/main/pages/sim_specs_all.php`
* `application/views/_base/main/pages/sim_specs_one.php`
* `application/views/_base/main/pages/sim_tour_all.php`
* `application/views/_base/main/pages/sim_tour_one.php`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.1 to 1.1.1", 'slug' => "update-110-111", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

_There are no updates to the CodeIgniter core in Nova 1.1.1._

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/assets/install`
* `application/assets/js`
* `application/assets/update`
* `application/assets/include_head_wiki.php`
* `application/controllers/base`
* `application/config/constants.php`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.1.1 to 1.1.2", 'slug' => "update-111-112", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

_There are no updates to the CodeIgniter core in Nova 1.1.2._

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/assets/install`
* `application/assets/update`
* `application/controllers/base/site_base.php`
* `application/config/constants.php`
* `application/helpers/MY_form_helper.php`
* `application/views/_base/admin/js/manage_posts_js.php`
* `application/views/_base/admin/js/write_missionpost_js.php`
* `application/views/_base/admin/pages/manage_posts.php`
* `application/views/_base/admin/pages/write_missionpost.php`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.1.2 to 1.2", 'slug' => "update-112-120", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

Replace these files and directories in your `core` folder with the new versions:
	
<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

* `core/codeigniter/CodeIgniter.php`
* `core/libraries/Router.php`

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/assets/install`
* `application/assets/js`
* `application/assets/update`
* `application/controllers/base`
* `application/assets/images/exclamation-red.png`
* `application/assets/include_head_admin.php`
* `application/assets/include_head_main.php`
* `application/assets/version.yml`
* `application/config/constants.php`
* `application/config/hooks.php`
* `application/helpers/MY_form_helper.php`
* `application/hooks/Utility.php`
* `application/language/english/base_lang.php`
* `application/language/english/email_lang.php`
* `application/language/english/error_lang.php`
* `application/language/english/text_lang.php`
* `application/libraries/User_panel.php`
* `application/models/base/depts_model_base.php`
* `application/models/base/positions_model_base.php`
* `application/models/base/system_model_base.php`
* `application/models/base/tour_model_base.php`
* `application/models/base/users_model_base.php`
* `application/views/_base/admin/ajax/add_dept.php`
* `application/views/_base/admin/ajax/del_ban.php`
* `application/views/_base/admin/ajax/del_manifest.php`
* `application/views/_base/admin/ajax/dup_dept.php`
* `application/views/_base/admin/ajax/edit_deck.php`
* `application/views/_base/admin/ajax/edit_dept.php`
* `application/views/_base/admin/ajax/edit_manifest.php`
* `application/views/_base/admin/images/arrow-circle-double-135.png`
* `application/views/_base/admin/images/icon-duplicate.png`
* `application/views/_base/admin/images/property-import.png`
* `application/views/_base/admin/js/manage_decks_js.php`
* `application/views/_base/admin/js/manage_depts_js.php`
* `application/views/_base/admin/js/site_bans_js.php`
* `application/views/_base/admin/js/site_manifests_js.php`
* `application/views/_base/admin/js/site_settings_js.php`
* `application/views/_base/admin/js/user_options_js.php`
* `application/views/_base/admin/pages/characters_create.php`
* `application/views/_base/admin/pages/manage_decks.php`
* `application/views/_base/admin/pages/manage_depts.php`
* `application/views/_base/admin/pages/manage_logs_ajax.php`
* `application/views/_base/admin/pages/manage_news_ajax.php`
* `application/views/_base/admin/pages/manage_positions.php`
* `application/views/_base/admin/pages/manage_posts_ajax.php`
* `application/views/_base/admin/pages/report_applications.php`
* `application/views/_base/admin/pages/site_bans.php`
* `application/views/_base/admin/pages/site_manifests.php`
* `application/views/_base/admin/pages/site_manifests_assign.php`
* `application/views/_base/admin/pages/site_roles.php`
* `application/views/_base/admin/pages/site_settings.php`
* `application/views/_base/admin/pages/user_options.php`
* `application/views/_base/main/js/personnel_character_js.php`
* `application/views/_base/main/js/personnel_index_js.php`
* `application/views/_base/main/js/sim_missions_js.php`
* `application/views/_base/main/js/sim_specs_js.php`
* `application/views/_base/main/js/sim_tour_js.php`
* `application/views/_base/main/pages/main_contact.php`
* `application/views/_base/main/pages/personnel_character.php`
* `application/views/_base/main/pages/personnel_index.php`
* `application/views/_base/main/pages/sim_missions_one.php`
* `application/views/_base/main/pages/sim_specs_one.php`
* `application/views/_base/main/pages/sim_tour_one.php`
* `banned.php`
* `exclamation.png`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.2 to 1.2.1", 'slug' => "update-120-121", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

_There are no updates to the CodeIgniter core in Nova 1.2.1._

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/assets/install`
* `application/assets/update`
* `application/controllers/base/ajax_base.php`
* `application/controllers/base/feed_base.php`
* `application/views/_base/admin/pages/manage_positions.php`
* `banned.php`
* `exclamation.png`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.2.1 to 1.2.2", 'slug' => "update-121-122", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

_There are no updates to the CodeIgniter core in Nova 1.2.2._

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/assets/install`
* `application/assets/update`
* `application/config/constants.php`
* `application/controllers/base/manage_base.php`
* `application/controllers/base/write_base.php`
* `application/views/_base/admin/pages/manage_depts.php`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.2.2 to 1.2.3", 'slug' => "update-122-123", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

_There are no updates to the CodeIgniter core in Nova 1.2.3._

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

<p class=\"alert alert-danger\"><strong>Warning:</strong> Any admins who updated to Nova 1.2 prior to 29 December 2010 are affected by a bug where all access roles were granted system administrator access privileges. Due to the potentially highly dynamic nature of access roles, there is no automated fix for this. You will need to manually change your access roles back to level more appropriate to how you operate your sim. Questions about this should be directed to Anodyne through the forums or Anodyne's contact form. We apologize for this inconvenience.</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/assets/install`
* `application/assets/update`
* `application/config/constants.php`
* `application/controllers/base/sim_base.php`
* `application/views/_base/main/pages/sim_decks.php`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.2.3 to 1.2.4", 'slug' => "update-123-124", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

_There are no updates to the CodeIgniter core in Nova 1.2.4._

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

<p class=\"alert alert-danger\"><strong>Warning:</strong> Any admins who updated to Nova 1.2 prior to 29 December 2010 are affected by a bug where all access roles were granted system administrator access privileges. Due to the potentially highly dynamic nature of access roles, there is no automated fix for this. You will need to manually change your access roles back to level more appropriate to how you operate your sim. Questions about this should be directed to Anodyne through the forums or Anodyne's contact form. We apologize for this inconvenience.</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/assets/install`
* `application/assets/js`
* `application/assets/update`
* `application/config/constants.php`
* `application/controllers/base/characters_base.php`
* `application/models/base/posts_model_base.php`
* `application/views/_base/main/js/personnel_index_js.php`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.2.4 to 1.2.5", 'slug' => "update-124-125", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

_There are no updates to the CodeIgniter core in Nova 1.2.5._

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

<p class=\"alert alert-danger\"><strong>Warning:</strong> Any admins who updated to Nova 1.2 prior to 29 December 2010 are affected by a bug where all access roles were granted system administrator access privileges. Due to the potentially highly dynamic nature of access roles, there is no automated fix for this. You will need to manually change your access roles back to level more appropriate to how you operate your sim. Questions about this should be directed to Anodyne through the forums or Anodyne's contact form. We apologize for this inconvenience.</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/assets/install`
* `application/assets/update`
* `application/config/constants.php`
* `application/controllers/base/install_base.php`
* `application/controllers/base/update_base.php`
* `application/controllers/base/upgrade_base.php`
* `application/controllers/base/user_base.php`
* `application/helpers/MY_date_helper.php`
* `application/models/base/specs_model_base.php`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Updating from 1.2.5 to 1.2.6", 'slug' => "update-125-126", 'summary' => "", 'content' => "## Step 1: Turn on Maintenance Mode

Nova includes a new feature called maintenance mode that allows admins to shut off access to the site to everyone except system administrators. This is especially handy when doing updates, ensuring no one is accessing the database while you're running the update.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can turn maintenance mode on from the Site Settings page in the Admin Control Panel.</p>

## Step 2: Update the CodeIgniter Core

_There are no updates to the CodeIgniter core in Nova 1.2.6._

## Step 3: Update the Nova Core

<p class=\"alert alert-danger\"><strong>Warning:</strong> Most Windows FTP clients have serious issues overwriting files on a server. To prevent issues, make sure you delete the file(s) you want to overwrite then upload the new version(s).</p>

<p class=\"alert alert-danger\"><strong>Warning:</strong> Any admins who updated to Nova 1.2 prior to 29 December 2010 are affected by a bug where all access roles were granted system administrator access privileges. Due to the potentially highly dynamic nature of access roles, there is no automated fix for this. You will need to manually change your access roles back to level more appropriate to how you operate your sim. Questions about this should be directed to Anodyne through the forums or Anodyne's contact form. We apologize for this inconvenience.</p>

Upload these files/directories in your `application` folder with the new versions, making sure to replace the old versions if they exist:

* `application/assets/install`
* `application/assets/update`
* `application/config/constants.php`
* `application/controllers/base/ajax_base.php`
* `application/models/base/posts_model_base.php`
* `application/views/_base/admin/pages/write_index.php`

## Step 4: Run the Update Script

Open your browser and navigate to `http://[yoursite]/index.php/update`. Verify your email address and password to be given access to the page and then click on the link to begin the database update.", 'keywords' => "", 'tags' => [4]],

			['title' => "Renaming the Application Directory", 'slug' => "", 'summary' => "Change the name of the application directory to something more fitting for your game", 'content' => "Nova is incredibly flexible and allows admins to change the name of the application folder in the event you want to run multiple installations of Nova from the same server directory. Changing the name of the application folder is pretty straightforward.

## The Scenario

You are running an RPG called USS Enterprise on your own web space. Out of the blue, your host notifies you that there's a conflict with a folder in your directory and you can't have a folder called application and need to change it right away to avoid further conflicts.

## The Steps

### 1. Rename the application folder

The first step is to upload a copy of Nova to your server and rename the application folder to <strong>enterprise</strong>.

### 2. Change the application folder variable

Each copy of Nova references the application folder by name, allowing you to easily change the name and location of the folder. (CodeIgniter, by default, stores the application folder inside the core, which is normally called system instead of core. For Nova, we've renamed the system folder for security reasons and moved the application folder outside of the CI core.) To change this variable, we have to open `index.php` which is located in the root Nova folder.

In `index.php`, find the line that defines the variable `\$app_folder`. Make that line read:

    \$app_folder = 'enterprise';

### 3. Upload your new file

With the changes complete, save the file and upload it to your server, overwriting the existing index.php file. When you navigate to your site, you won't notice anything different, but instead of reference a folder named `application`, Nova will instead be referencing a folder named `enterprise`.", 'keywords' => "rename, directory, application", 'tags' => [2]],

			['title' => "Translating Nova", 'slug' => "", 'summary' => "Learn how to provide other translations for Nova", 'content' => "Nova was built with internationalization in mind, so nearly every piece of text hard-coded to the system is actually stored in one massive language array. This allows Nova to be translated into a wide variety of languages to be used all around the world.

<p class=\"alert alert-warning\"><strong>Note:</strong> Your text editor must be set up to use UTF-8 file encodings. If your editor is set to something, including automatic, make sure you change it to UTF-8 to avoid your browser being unable to interpret accented and special characters.</p>

## The Process

The process of translating Nova to another language is a long and tedious process, but in doing so, you'll be helping out the global community by providing ways for people around the world to easily use Nova in their own language. Anyone who takes on the task of translating Nova has our eternal gratitude!</p>

### Creating the Language Directory

The first thing to do is duplicate the english directory found in `application/language` and rename the folder to the language you're translating. For this example, we'll use __spanish__. Once the directory is created, you will need to go through each language file in the directory and translate the strings one by one. In the process of developing Nova, we tried to do everything as one and two word groups to help translators. While the base language file may be several hundred lines long, each line usually only has one word on it to translate.

### Translate the CodeIgniter Core

The CodeIgniter community has provided a lot of different translations over the years which you may be able to find with a Google search. If the language you're translating Nova to isn't included in that list, you'll need to translate CodeIgniter as well using the same process as Nova.

<p class=\"alert alert-warning\"><strong>Note:</strong> Translation questions should be sent to Anodyne directly for the fastest and most accurate answer.</p>

## HTML Entities

The following definitions are used in the language files to give us properly formatted HTML entities for different characters. These items shouldn't be translated and should be used in place of the items they replace.

<div class=\"data-table data-table-bordered data-table-striped\">
<div class=\"row\">
<div class=\"col-xs-4 col-md-1\">

&gt;
</div>
<div class=\"col-xs-8 col-md-3\">

RARROW
</div>
<div class=\"col-xs-4 col-md-3\">

`&raquo;`
</div>
<div class=\"col-xs-8 col-md-5\">

A simple right arrow
</div>
</div>
<div class=\"row\">
<div class=\"col-xs-4 col-md-1\">

&lt;
</div>
<div class=\"col-xs-8 col-md-3\">

LARROW
</div>
<div class=\"col-xs-4 col-md-3\">

`&laquo;`
</div>
<div class=\"col-xs-8 col-md-5\">

A simple left arrow
</div>
</div>
<div class=\"row\">
<div class=\"col-xs-4 col-md-1\">

'
</div>
<div class=\"col-xs-8 col-md-3\">

RSQUO
</div>
<div class=\"col-xs-4 col-md-3\">

`&rsquo;`
</div>
<div class=\"col-xs-8 col-md-5\">

A fancy right apostrophe
</div>
</div>
<div class=\"row\">
<div class=\"col-xs-4 col-md-1\">

'
</div>
<div class=\"col-xs-8 col-md-3\">

LSQUO
</div>
<div class=\"col-xs-4 col-md-3\">

`&lsquo;`
</div>
<div class=\"col-xs-8 col-md-5\">

A fancy left apostrophe
</div>
</div>
<div class=\"row\">
<div class=\"col-xs-4 col-md-1\">

\-
</div>
<div class=\"col-xs-8 col-md-3\">

NDASH
</div>
<div class=\"col-xs-4 col-md-3\">

`&ndash;`
</div>
<div class=\"col-xs-8 col-md-5\">

A stylized dash
</div>
</div>
<div class=\"row\">
<div class=\"col-xs-4 col-md-1\">

&
</div>
<div class=\"col-xs-8 col-md-3\">

AMP
</div>
<div class=\"col-xs-4 col-md-3\">

`&amp;`
</div>
<div class=\"col-xs-8 col-md-5\">

An ampersand
</div>
</div>
</div>

## Keep In Mind...

### What NOT to Translate

The only thing you should translate is on the right side of the equal sign. You should never translate what's in the brackets on the left, otherwise you'll break Nova!

    \$lang['do_not_translate'] = 'translate this';

### Watch Your Quotes

It's important when translating Nova that you understand PHP handling of single and double quotes and escaping quotes as necessary, otherwise you'll run in to a long series of errors that will be maddening trying to fix. In a nutshell, if you have a string surrounded by single quotes, you can only use another single quote in that string after escaping with the backslash (\). Here's how you would handle a few different types of strings:

    'This is a string that does not need escaping.'

    'This is a string that does need to be escaped by it\'s got an extra single quote in it.'

    \"Alternately, you could switch to use double quotes so you don't have to escape any single quotes.\"

### Putting Strings Together

In addition, when using the HTML entity definitions listed above, you will have to concatenate strings, which you can see in several places in the language files. In PHP, you can concatenate strings using the period (.) like so:

    'This is a string that uses single quotes '. AMP .' an HTML entity';

    // would produce
    This is a string that uses single quotes & an HTML entity

### Right to Left Text Rendering

At this point, there is no support for languages that require right to left text rendering. We're actively pursuing RTL text rendering support in a future version of Nova. If you are interested in helping with this feature, please contact us.", 'keywords' => "translation, international, language, spanish", 'tags' => [2]],

			['title' => "Pretty URLs", 'slug' => "", 'summary' => "Learn how to remove the `index.php` part of the URL", 'content' => "Further adding to Nova's flexibility, you can create an `.htaccess` file that will allow users to access your site without the `index.php`. In order to do this, you need to have a host that allows `.htaccess` files and has `mod_rewrite` turned on. If you're not sure if your server matches these things, contact your host. Once you (or your host) have created the `.htaccess` file in your root directory, copy and paste the following code in:

    <IfModule mod_rewrite.c>
        RewriteEngine On
        # Leave 'RewriteBase /' if not installing into subfolder
        RewriteBase /nova1/
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule ^(.*)$ index.php?/$1 [L]
    </IfModule>

    <IfModule !mod_rewrite.c>
        # If we don't have mod_rewrite installed, all 404's
        # can be sent to index.php, and everything works as normal.
        # Submitted by: ElliotHaughin

        ErrorDocument 404 /index.php
    </IfModule>

<p class=\"alert alert-warning\"><strong>Note:</strong> If you have changed the name of your index file, you need to make the necessary change to the script where it tries to find the file. In addition, you'll need to set the RewriteBase to the proper subfolder or simple a slash if you aren't installing Nova in a subfolder.</p>", 'keywords' => "htaccess, url, index.php, remove", 'tags' => [2]],

			['title' => "Running Multiple Copies of Nova from the Same Directory", 'slug' => "multiple-apps", 'summary' => "If need be, you can run several copies of Nova off the same CodeIgniter core", 'content' => "Because Nova's framework allows the application folder and index file to be changed, it's possible to run multiple applications from the same CodeIgniter core. This can be advantageous for anyone who wants to run a bunch of RPGs from the same location.

## The Scenario

You are running a small group of Star Trek RPGs. Because there are only 3 RPGs in the group (the Enterprise, Excelsior and Voyager), none of you want to buy separate domains, so you insted decide to pool your money together and buy one domain then run all your RPGs from that domain. Your group is called 1st Fleet, so you buy the domain 1stfleet.com. Now that you have your domain and are set up, you want to run all 3 RPGs from ships.1stfleet.com.

<p class=\"alert alert-warning\"><strong>Note:</strong> The RPGs, fleet and all data in this tutorial are fake. Do not attempt to visit the sites or use the connection information.</p>

## The Steps

For each RPG in your group, you would make the following changes:

### 1. Rename the application folder

The first step is to upload a copy of Nova to your server and rename the application folder to __enterprise__ (or whatever your RPG's names are). As you'll see shortly, the reason we do this is so that in the event a new version of Nova comes out that the Enterprise game master wants to update to that the Excelsior game master doesn't want to update to, the Enterprise GM can still do the update without affecting the Excelsior site (that is unless the CodeIgniter version changes, but that's a completely different issue).

### 2. Change the application folder variable

Each copy of Nova references the application folder by name, allowing you to easily change the name and location of the folder. (CodeIgniter, by default, stores the application folder inside the core, which is normally called system instead of core. For Nova, we've renamed the system folder for security reasons and moved the application folder outside of the CI core.) To change this variable, we have to open `index.php` which is located in the root Nova folder.

In `index.php`, find the line that defines the variable `\$app_folder`. Make that line read:

    \$app_folder = 'enterprise';

### 3. Rename the index file

Now that we've changed the application folder, we need to change the index file. In this instance, rename `index.php` to `enterprise.php`. This allows us to get to the Enterprise site by going to http://ships.1stfleet.com/enterprise.php. The other RPGs would be referenced by going to excelsior.php and voyager.php.

At this point, your file structure should look something like this:

	- core
	- enterprise
	- excelsior
	- voyager
	    - enterprise.php
	    - excelsior.php
	    - license_codeigniter.txt
	    - license_nova.txt
	    - voyager.php

### 4. Update the Nova config file

Like the application folder, CodeIgniter references the index file as well so it can be changed to. The index file reference can be found in `application/config/config.php`. Once open, you need to find the `\$config['index_page']` line and change it to read:

    \$config['index_page'] = 'enterprise.php';

### 5. Update the database connections

Almost there! Since we have three separate RPGs, we'll want them to use their own databases. Nova allows one of two solutions in this case. First, you can run all three RPGs from the same database, just changing the prefix to separate the RPGs from each other. The second option is to use separate databases (if you have them). We'll show you both solutions here.

#### To use the same database

Open `application/config/database.php` and change the connection parameters to use the proper username, password and database that your host gave you. The only line that will need to be different from application to application is the prefix setting. Change the database prefix to look like this:

    \$db['default']['dbprefix'] = 'enterprise_';

#### To use the different databases

Open `application/config/database.php` and change the connection parameters to use the proper username, password and database that your host gave you. Unless you have multiple database accounts, it's likely the only line that will need to be different from application to application is the database setting. Change the database line to look like this:

    \$db['default']['database'] = '1stfleet_ships_enterprise';

### 6. Upload your files

With the changes complete, save the files and upload them to your server, overwriting the existing files. You'll access your site now by going to http://ships.1stfleet.com/enterprise.php.", 'keywords' => "multiple, applications, games, directory, rename", 'tags' => [2]],

			['title' => "Change Language Items", 'slug' => "", 'summary' => "Learn how to change specific language items to get your game terminology exactly how you want it", 'content' => "Not all RPGs are alike, so the use of generic terms like department, position and rank may not fit for everyone. Instead of digging in to the core, we've provided an easy way to go in and override the individual language items so you can customize your copy of Nova to exactly how you play your game.

For situations just like this, we've built an `app_lang` file in `application/language/{language}`. From this file, you can override any of the language keys in any of the files in the system. If you want to replace the term _position_ with the term _job_, you can do so by adding a language key to the `app_lang` file in the following format:

    \$lang['global_position'] = 'job';

If you have questions about what the language keys are, you can open the language files and find the one you want to replace. This replacement can be done for any item in the language files. Plus, Anodyne will never update the `app_lang` file, so any changes you make will remain intact through Nova updates.", 'keywords' => "language, game, terminology", 'tags' => [2]],

			['title' => "Rename the Index File", 'slug' => "", 'summary' => "Learn how to rename the index file to something else", 'content' => "Nova is incredibly flexible and allows admins to change the name of the file used to access the system. Changing the index file of the application is pretty straightforward.

## The Scenario

You are running an RPG called USS Enterprise on your own web space. You decide one day that you'd like to have a splash page that users go to before going to your site, but you don't want to screw around with a .htaccess file.

## The Steps

### 1. Rename the index file

You can rename the index file to whatever you want provided the file is still a PHP file. In this case, we're going to rename the file to `enterprise.php` so our splash page can be index.php.

### 2. Change the index page variable

Open `application/config/config.php` and find the variable `\$config['index_page']`. Now, we're going to change the content in quotes to the name of our file, including the .php extension. In the end, our variable should look like this:

    \$config['index_page'] = 'enterprise.php';

### 3. Save and upload

Save the `config.php` file and upload it to your server, overwriting the existing one. Next time we navigate to our site, we'll need to use the `enterprise.php` file instead of index.php. We can now develop our splash page at index.php so that users see that first before they get to our site.", 'keywords' => "rename, index.php", 'tags' => [2]],

			['title' => "Creating a New Rank Set", 'slug' => "", 'summary' => "Learn how to create a new rank set for use on your game", 'content' => "<p class=\"alert alert-warning\"><strong>Note:</strong> The example here uses DS9 as an example, but the same process can be used for any genre in the system.</p>

With the fairly recent advent of Kuro-RPG's alpha transparency rank sets, Anodyne's made a committment to use only alpha transparency rank sets if they're available from Kuro-RPG. However, there may be those who want to use a non-alpha transparency rank set. In this tutorial, we're going to create a new rank set that uses the Kuro-RPG DS9 Dress ranks (at the time of this publishing there was no alpha transparency available for that set).

## Background

It's important to understand what makes up a rank set before we dig in. A DS9 rank set consists of a preview image (aptly named preview.png, though you can change that name if you want), a blank image, blank images for each of the colors and rank images. In the DS9 rank sets, the preview image is a copy of the red captain image and the blank image is a copy of the black blank image.

## The Steps

### 1. Get the Ranks

The first step is to download the rank set from Kuro-RPG. For this tutorial, we're going to use the white color version. Once you have the rank set, make sure you've unzipped it to your Desktop.

<p class=\"alert alert-warning\"><strong>Note:</strong> Star Trek canon dictates that non-commissioned officers have different dress uniforms, but for the sake of brevity and clarity, we are ignoring that for this tutorial.</p>

### 2. Create Our Folder

We need a place to put our rank set, so create a folder called `dress` on your Desktop.

### 3. Grab the Blank Images

We're going to start by grabbing all of the necessary blank images. In the Kuro-RPG folder, find the images that have a `-blank.png` ending. The ones we're looking for are:

- `b-blank.png`
- `c-blank.png`
- `g-blank.png`
- `r-blank.png`
- `s-blank.png`
- `t-blank.png`
- `v-blank.png`
- `w-blank.png`
- `y-blank.png`

### 4. Create the Blank Image

Copy the `b-blank.png` image and rename it to `blank.png`.

### 5. Grab the Marine Ranks

Open the `marine` directory from the Kuro-RPG folder. We want to copy all of the Marine ranks from here over to our folder. The items we're looking for here are the `g-` ranks. Copy the following `g-` items over to our folder:

- `a5.png`
- `a4.png`
- `a3.png`
- `a2.png`
- `a1.png`
- `e1.png`
- `e2.png`
- `e3.png`
- `e4.png`
- `e5.png`
- `e6.png`
- `e7.png`
- `e8.png`
- `e9.png`
- `o1.png`
- `o2.png`
- `o3.png`
- `o4.png`
- `o5.png`
- `o6.png`
- `w1.png`
- `w2.png`
- `w3.png`
- `w4.png`

### 5. Grab the Naval Ranks

Now that we have our Marine ranks transferred over to our folder, let's focus on the naval ranks. Open the `naval-gold` directory from the Kuro-RPG folder. We want to copy all of the colored ranks from here over to our folder. The items we're looking for here are the `c-`, `r-`, `s-`, `t-`, `v-` and `y-`, ranks. Copy the following items from each color over to our folder:

- `a5.png`
- `a4.png`
- `a3.png`
- `a2.png`
- `a1.png`
- `c0.png`
- `c1.png`
- `c2.png`
- `c3.png`
- `c4.png`
- `e1.png`
- `e2.png`
- `e3.png`
- `e4.png`
- `e5.png`
- `e6.png`
- `e7.png`
- `e8.png`
- `e9.png`
- `o1.png`
- `o2.png`
- `o3.png`
- `o4.png`
- `o5.png`
- `o6.png`
- `w1.png`
- `w2.png`
- `w3.png`
- `w4.png`

Once those have been copied over, we need to finish up the Marine ranks. To finish the Marine ranks, grab the cadet ranks (c0, c1, c2, c3 and c4) from the `g-` group and copy them to our folder.

### 6. Create the Preview Image

Copy the `r-o6.png` image and rename it to `preview.png`.

### 7. Create the Rank Quick Install File

If you want to use the Nova Quick Install feature, you can create the `rank.yml` file in the directory. To create the Quick Install file, create a file called rank.yml and insert the following text inside:

	rank: Dress Ranks
	location: dress
	credits: The rank sets used in Nova were created by Kuro-chan of Kuro-RPG. The ranksets can be found at <a href='http://www.kuro-rpg.net' target='_blank'>Kuro-RPG</a>. Please do not copy or modify the images.
	preview: preview.png
	blank: blank.png
	extension: .png
	url: http://www.kuro-rpg.net/

With this file in the directory, if the admin hasn't created this rank set yet, the Rank Catalogue page will prompt them to install the rank set.

## Other Genres

Creating rank sets for other genres uses the same process. Each genre comes with one rank set, so you should begin by looking at the set up the ranks directory. In most cases, we haven't modified file names much beyond their original names. It's important to note that all the images have to be named the same as their default counterparts. The only thing that can change are the blank image, preview image and image extensions. Those items can be configured in the Rank Catalogue.", 'keywords' => "rank set, create, kuro", 'tags' => [2]],

			['title' => "Configuring Nova", 'slug' => "", 'summary' => "Nova comes with several advanced config options to alter the way it performs", 'content' => "## Genre

One of the most important configuration variables, the genre option will tell Nova what position, department, and rank data to use when installing the system as well as when accessing the database. If this is blank, the system will not install! By default, Nova ships with __DS9__ as the default genre.

## Meta Data

Nova comes with some default meta data, but admins can change the data to their preference through variables in the `application/config/nova.php` file. By default, Nova ships with the following meta data:

- __Description__ - Anodyne Productions' premier online RPG management software
- __Author__ - Anodyne Productions
- __Keywords__ - nova, rpg management, anodyne, rpg, sms

## RSS Settings

Nova allows people (crew and otherwise) to subscribe to RSS feeds with mission posts, personal logs, and news items. There are several options for configuring these in `application/config/nova.php`. More information about the configuration options can be found in the RSS Feeds page.

## Thresher Settings

Nova's integrated mini wiki, Thresher, has a single config file that allows admins to change the way content is stored and parsed. By default, Thresher will store and parse wiki page content as HTML, but you can also use BBCode, Markdown and Textile for storing and parsing. You can change the parse type in the Thresher config file found at `application/config/thresher.php`.

<p class=\"alert alert-warning\"><strong>Note:</strong> Once you have selected a parse type, you shouldn't change it. If you change the parse type, your wiki pages may not display properly.</p>", 'keywords' => "config, nova, genre, metadata, rss, wiki, thresher, parse", 'tags' => [7]],

			['title' => "Configuring CodeIgniter", 'slug' => "", 'summary' => "CodeIgniter can be configured in a variety of ways to alter the way things work. Learn how to configure it here.", 'content' => "## Basic System Settings

### Base URL

In SMS, it was called the web location variable. In CI, it's called the base URL. CodeIgniter sets the base URL dynamically so you should never have to touch this variable. If you find a situation where the base URL isn't accurate, you can change it in `application/config/config.php`.

<p class=\"alert alert-warning\"><strong>Note:</strong> Take great care when changing the base URL as it can cause Nova to break!</p>

### Index File

CodeIgniter comes with the ability to rename index.php to whatever you want. This is advantageous for a variety of reasons, namely if you want to run multiple sims from the same directory or if you want to create a splash page at index.php and point to another page for Nova. You can change the index.php file in `application/config/config.php`. Make sure you have changed the name of the index.php file, then put the changed name in the file.

<p class=\"alert alert-warning\"><strong>Note:</strong> The file must be a PHP file or Nova will not work!</p>

### Default Language

By default, Nova ships with English as its default language. If you have additional language folders in place, you can change the default language Nova is displayed in. (Content from the database will still be in English; those entries will have to be manually updated.) In addition to having a language folder in the CodeIgniter core, the Nova core also has a language folder that will need to have data for that language. More information can be found in the language documentation pages.

### Character Set

CodeIgniter allows the default character set to be changed to whatever an admin wants. By default, it is set to __UTF-8__. For most situations, that should be fine. If you need to change it, you can find the preference in `application/config/config.php`.

### Error Logging

CodeIgniter allows admins to change the error logging threshold if they so choose. By default, Nova operates with error reporting turned off, but if you turn it on, you can change the amount of information that is dumped to the error logs. You can change the error logging options from `application/config/config.php`. In addition, you can change the location where the system logs are stored (if your host has changed it from the default location) and the date format for the error logs.

### Master Time Reference

Unlike SMS, Nova is a lot smarter with dates and times. By default, Nova will convert all dates to GMT to allow for users to set their individual time zones. You can choose to change this to the server's local time if you want, but doing so will break some of the timezone features in Nova. Admins can change this preference in the `application/config/config.php` file.

### Database

CodeIgniter has an extensive list of options for configuring connections to the database. These options are covered in more depth in the Fresh Install Guide. Database connection information can be found in the `application/config/database.php` file.

## Advanced System Settings

### Auto-Loading

CodeIgniter comes with a lot of awesome helpers and libraries. By default, Nova auto-loads several of them we use quite often. You can add and remove from these lists in the `application/config/autoload.php` file.

By default, Nova auto-loads the following libraries: Database, Template, Menu, Input, Auth and User Panel. By default, Nova auto-loads the following helpers: Location, URL, Date, HTML, Language, and Form. For models, Nova auto-loads settings_model and messages_model. Finally, Nova auto-loads it's own configuration file (covered later in this document). For more information about auto-loading in CodeIgniter, please visit the [CodeIgniter User Guide](http://codeigniter.com/user_guide/general/autoloader.html).

<p class=\"alert alert-danger\"><strong>Warning:</strong> We don't recommend removing any of these as doing so will break Nova. In addition, use great care when adding items to auto-load as it will slow down Nova's run time.</p>

### URI Protocol

CodeIgniter gives admins the change the way the URI is retrieved. This item determines which server global should be used to retrieve the URI string. The default setting of __AUTO__ works for most servers. If your links do not seem to work, try one of the other options. CodeIgniter also allows __PATH_INFO__, __QUERY_STRING__, __REQUEST_URI__, and __ORIG_PATH_INFO__. We don't recommend changing this unless you absolutely have to!

### URL Suffix

CodeIgniter allows admins to add an additional suffix to the end of their URLs. More information about this can be found in the [CodeIgniter User Guide](http://codeigniter.com/user_guide/general/urls.html).

### System Hooks

CodeIgniter comes with a powerful hooks system for tapping in to the system during initialization at several different points. Nova does not use hooks, but if you want to develop a plugin or MOD that uses hooks, the feature will need to be enabled. You can enable system hooks by setting the config variable to __TRUE__. This config setting can be found in `application/config/config.php`. More information about system hooks can be found in the [CodeIgniter User Guide](http://codeigniter.com/user_guide/general/hooks.html). If you are using system hooks, you will define them in `application/config/hooks.php`.</p>

### Class Extension Prefix

CodeIgniter's class-based approach allows core classes to be extended by using a simple prefix. By default, CI uses `MY_` as the prefix. You can change this if you need to, but be warned that changing this will break Nova at several points. You should use great caution when change this setting!

### Allowed URL Characters

CodeIgniter allows an admin to set what characters are permitted in the URL. By default, CI permits all letters, all numbers, as well as `~ % . : _ \ -`. You are encouraged to leave this setting alone. Changing this can have major security repercussions for your Nova site!

### Query Strings

By default CodeIgniter uses search-engine friendly segment based URLs: `www.your-site.com/who/what/where/`. You can optionally enable standard query string based URLs `www.your-site.com?who=me&amp;what=something&amp;where=here`. The other items let you set the query string \"words\" that will invoke your controllers and its functions: `www.your-site.com/index.php?c=controller&m=function`. You can change this in `application/config/config.php`.

<p class=\"alert alert-warning\"><strong>Note:</strong> Some of the helpers won't work as expected when this feature is enabled, since CodeIgniter is designed primarily to use segment based URLs.</p>

### Session Settings

Nova stores session data right in the database and CodeIgniter provides some configuration options. You shouldn't need to touch any of the session settings, but in the event you do need to, they can be found in the `application/config/config.php` file. You can change the name of the table where the data is stored, the time to update the session, whether to use the database or not, encrypting cookies (if they're being used to store session data), and other options. In addition, CodeIgniter also provides the ability to change cookie specific options.

<p class=\"alert alert-danger\"><strong>Warning:</strong> Changing any of these values can cause Nova to stop working altogether!</p>

### Global XSS Filtering

CodeIgniter has the option to filter everything for cross site scripting (XSS) attacks. By default, we don't enable this option as it can cause issues with passwords that use any special characters. Instead, we filter POST values for XSS issues in the controllers. If you want to change this, you can simply enable XSS filtering. The option can be found in the `application/config/config.php` file.

<p class=\"alert alert-danger\"><strong>Warning:</strong> Changing this will cause a pretty decent performance drop with Nova as filtering everything for XSS takes more resources.</p>

### Output Compression

CodeIgniter has a feature to allow for Gzipping output for faster page loads. Only enable this feature if you know your server can handling this and are reasonably confident that your users are using browsers that support this feature! The setting can be found in `application/config/config.php`.

### Rewrite PHP Short Tags

CodeIgniter has a feature that allows for rewriting PHP short tags on servers that don't have the option turned on in the PHP configuration, eliminating errors and mishandled pages. By default, Nova runs with this disabled as we've gone to great lengths not to use PHP short tags. You can change this setting from `application/config/config.php`, however, you may see a slight drop in performance by doing so.

### Constants

CodeIgniter comes with a small group of system constants for working with files and some characters. Those constants can be found in `application/config/constants.php`.

<p class=\"alert alert-warning\"><strong>Note:</strong> Anodyne will regularly update the constants in this file for system updates, so any constants you want to create should be put in the controllers or in the Nova config file. Altering any of these constants can cause some of Nova's feature to stop working!</p>

### Routes

CodeIgniter allows URLs to be re-routed. You can set up re-routing rules in `application/config/routes.php`. This page also sets the default controller (in Nova, it's __main__). More information about routes can be found in the [CodeIgniter User Guide](http://codeigniter.com/user_guide/general/routing.html).

## System Email Settings

Nova uses CodeIgniter's Email class for delivering email from the system to the users of the RPG. The Email class allows for setting a wide array of options for the emails and all those settings can be changed from the configuration file located at `application/config/email.php`. Below are some of the most common items admins may want to change. For more detailed information about CodeIgniter's Email class, please visit the [CodeIgniter User Guide](http://codeigniter.com/user_guide/libraries/email.html).

### Email Protocol

Depending on your server, you can change the protocol used to deliver email. By default, Nova uses PHP's `mail()` function. The options you can specify are __mail__, __sendmail__ or __smtp__.

<p class=\"alert alert-warning\"><strong>Note:</strong> If you specify SMTP as the delivery method, you will also have to specify the SMTP host, user, password, port and timeout. If you specify sendmail as the delivery method, you will also have to specify the path to sendmail. Please contact your host about these items.</p>

### Mail Type

Nova allows admins to change the type of email that are delivered to users. By default, Nova will attempt to deliver HTML emails, however, some email hosts can classify HTML emails as spam more quickly than text only emails. Because of that, admins can change the mail type to text to have emails delivered in the same format as SMS. The only options accepted by CodeIgniter for the mail type are __html__ and __text__.

## System FTP Settings

CodeIgniter provides an FTP class that Nova uses for trying to adjust file permissions during install and for deleting upload files. You can choose to set these settings if you want or ignore them. Nova will work either way. For more detailed information about CodeIgniter's FTP class, please visit the [CodeIgniter User Guide](http://codeigniter.com/user_guide/libraries/ftp.html).

From the FTP config file located at `application/config/ftp.php`, you can set your host name, username, password and port for use by CodeIgniter in connecting to your server for advanced operations. If you change settings in this file, make sure the file's permissions on the server are set to an appropriately safe level (664 should be fine).", 'keywords' => "config, codeigniter, url, email, ftp, language, error, logging, database, autoloading, uri, hook, session, xss", 'tags' => [7]],

			['title' => "Views", 'slug' => "", 'summary' => "What is a view?", 'content' => "## What is a View?

Views are how Nova takes the information from the database and displays it in the browser. Views allow for separating the logic and presentation for Nova. Views are typically HTML or Javascript, but also contain variables passed into them from the controller.

## Understanding the Views Directory

In Nova, views are located in the `application/views` directory. Because of seamless substitution, there's a method to the way view files are stored in the view directory.

The \"default\" view file that's used by Nova is located in `application/views/_base`. Within the _base directory, we separate view files into the different template types: _admin_, _login_, _main_, and _wiki_. Inside each of the template type directories, we use the same structure: _ajax_, _images_, _js_, and _pages_. The only place we store view files are in the `js` and `pages` directories.

If you want to create a view file that will be used instead of Nova's default, you can put your version in `application/views/_base_override`, making sure that the view file goes in the right template type directory. So for instance, if you wanted to override the manifest view file, you'd put your copy of the file in `application/views/_base_override/main/pages/personnel_index.php`.

Finally, system skins are stored in the views directory as well. Skins, like the `_base_override` directory, can circumvent Nova's default view files. Much the same as the `_base_override` directory, a skin is broken down into the different template types. If you wanted to override the manifest view file only for your skin, you'd put your copy of the file in `application/views/[your skin]/main/pages/personnel_index.php`.

## Creating a View

Creating a view is as simple as creating a PHP file with what you want. The file __has__ to have the .php extension, otherwise you won't be able to use it since Nova wants all view files (Javascript views included) to be PHP files. Just because it's a PHP file doesn't mean you have to put any PHP code in there. Your PHP file can be made up entirely of HTML if you want.

    <h1>My New View File</h1>
	
    <p>This is an example of my new view file. It would have a .php extension, but as you can see, there's no PHP in here.</p>

When creating views for new pages, you should store your view files in `application/views/_base_override` to prevent it from being wiped out during an update. We frequently fix issues within the view files in `_base` and storing your view files in there could cause issues when updating.

## Using Views

Seamless substitution can seem like magic at first, but it's really just a simple process that looks in a few different locations for the right file and then loads it from the location where it finds it first. So how the heck do you make your files do that too? Nova uses a simple function to check for the existence of view files. If you want to plug in to seamless substitution, you can offload figuring out the location of your view file to Nova.

### Simple Views

If you have a simple view file called example.php, you can use Nova's built-in functions in your controller method to find the file and load it with the following code:

    \$view_loc = view_location('example', \$this->skin, 'main');

    \$this->template->write_view('content', \$view_loc);

The `view_location` function takes 3 parameters that you'll need to provide. The first is the name of the view file without the extension. If our file is example.php, then we'll pass `example` to the function. The second parameter we have to pass is the skin. Fortunately, all the controllers handle this, so you can simply pass the `\$this->skin` variable and it'll take care of the rest. The third and final parameter is the section. If you were creating a page in the main section, that'd be `main`. If you were creating a page in the admin section, that'd be `admin`.

The call to the template library's `write_view` method just renders your stuff in the template. You don't need to change anything about this if you have a simple view that doesn't use any PHP variables.

### Advanced Views

Sometimes, you need more than just a simple view file though. In those instances, only a couple things will change.

    \$data['foo'] = 'This is my variable';
	
    \$view_loc = view_location('example', \$this->skin, 'main');

    \$this->template->write_view('content', \$view_loc, \$data);

You can see that we've added a variable with information at the start and the `write_view` method has a third parameter with the variable where we've stored our information. By making these changes, we can reference the information in the `foo` variable by writing `<?php echo \$foo;?>`. Nova will take the information, put it in the right place and render everything in the browser.", 'keywords' => "view, php, presentation", 'tags' => [6,7]],

			['title' => "Libraries", 'slug' => "", 'summary' => "When we talk about PHP libraries, what do we mean?", 'content' => "A library is just a normal PHP class. It doesn't need to extend anything or follow any conventions. In Nova, libraries are stored in `application/libraries` and have the first letter of the filename capitalized. Our example library would look like this:

	class Example {
		
		function Example()
		{
			log_message('debug', 'Example Library Initialized');
		}
	}

You can add methods to your library like you normally would. Since Nova follows PHP 4 compatability, visibility keywords (public, private, protected) aren't available. If you want to make a method private (in a psuedo manner), simply append an underscore to the beginning of the method name. For instance, if we wanted a private method to add some numbers up, the name of the method would be `_add`.

## Loading a library

To load a library from your controller or model (you should never load a library from a view file), you'll need to manually call the load method, like this:

    \$this->load->library('example');

## Libraries in subdirectories

Libraries can be stored in subdirectories if you want to organize them in that way. If we wanted to store our example library in a directory called \"test\", we would load the library like this now:

    \$this->load->library('test/example');", 'keywords' => "library, php", 'tags' => [7]],

    		['title' => "Backup Guide", 'slug' => "", 'summary' => "", 'content' => "There's always a lot of taking about making sure to back up SMS and/or Nova before attempting to update it or upgrade from SMS to Nova, but how do you backup the systems? Creating a backup of either system is pretty straightforward.

## Backing Up SMS

Before you attempt to upgrade from SMS to Nova, you should create a backup of your SMS system in the event something goes wrong. The last thing you want is to lose data and be out of luck. We can't stress enough the importance of a solid backup.

New to Nova is a step at the start of the upgrade process that attempts to backup your database and store it on the server before doing the upgrade. Unfortunately, the backup process requires a lot of memory so if you have a large database, the backup may not be able to run. A message will notify you whether or not the process ran. In the event it's unable to run, the following steps will help you in backing up your SMS installation.

### The Files

The first step to creating a solid backup is to save the SMS files off your server to your computer. To do that, you'll need to have an FTP program to connect to the server. Once you've connected to your account with the username, password and location your host gave to you when your account was created, you can download the files. The best way of going about this is to create a folder on your Desktop called `sms_backup` and to copy all the files directly over to that folder. Make sure you get all the files! Once you have all the files, you can disconnect from the server and close your FTP program.

### The Database

The database is the most important part of the system. In order to backup your database, you'll need to access phpMyAdmin. On some hosts, you would've been given a direct link to phpMyAdmin and on others, you'll have access to it through cPanel. Once you've logged in to phpMyAdmin, make sure you've selected the database with your SMS tables. You'll know you're in the right place if you see a full list of all the SMS tables. Click on the Export tab across the top of the page.

In the export box, click Select All and make sure the SQL option is selected below. In the Options box to the right, make sure both Structure and Data checkboxes are checked. Finally, click the Save as File checkbox then Go. The system will offer you a download of the SQL database. Save the file to your `sms_backup` folder on your Desktop.

### Zip It Up

Now that you have your complete backup, you should zip your backup up into a zip archive and name it `sms_backup_{date}` where __{date}__ is today's date. Make sure you save the zip file in a safe place in case you need to get at it. That's it. You've successfully backed up SMS!

## Backing Up Nova

Before you attempt to update Nova, you should create a backup of your system in the event something goes wrong. The last thing you want is to lose data and be out of luck. We can't stress enough the importance of a solid backup.

New to Nova is a step at the start of the update process that attempts to backup your database and store it on the server before doing the update. Unfortunately, the backup process requires a lot of memory so if you have a large database, the backup may not be able to run. A message will notify you whether or not the process ran. In the event it's unable to run, the following steps will help you in backing up your Nova installation.

### The Files

The first step to creating a solid backup is to save the Nova files off your server to your computer. To do that, you'll need to have an FTP program to connect to the server. Once you've connected to your account with the username, password and location your host gave to you when your account was created, you can download the files. The best way of going about this is to create a folder on your Desktop called `nova_backup` and to copy all the files directly over to that folder. Make sure you get all the files! Once you have all the files, you can disconnect from the server and close your FTP program.

### The Database

The database is the most important part of the system. In order to backup your database, you'll need to access phpMyAdmin. On some hosts, you would've been given a direct link to phpMyAdmin and on others, you'll have access to it through cPanel. Once you've logged in to phpMyAdmin, make sure you've selected the database with your Nova tables. You'll know you're in the right place if you see a full list of all the Nova tables. Click on the Export tab across the top of the page.

In the export box, click Select All and make sure the SQL option is selected below. In the Options box to the right, make sure both Structure and Data checkboxes are checked. Finally, click the Save as File checkbox then Go. The system will offer you a download of the SQL database. Save the file to your `nova_backup` folder on your Desktop.

### Zip It Up

Now that you have your complete backup, you should zip your backup up into a zip archive and name it `nova_backup_{date}` where __{date}__ is today's date. Make sure you save the zip file in a safe place in case you need to get at it. That's it. You've successfully backed up Nova!", 'keywords' => "backup, zip", 'tags' => [2]],

			['title' => "An Introduction to Models", 'slug' => "intro-to-models", 'summary' => "Learn what a model is and some basic usage", 'content' => "Models are PHP classes that are designed to work with information in your database. In Nova, models allow you to create, retrieve, update, and delete information from the database. In Nova, we have chosen to use CodeIgniter's Active Record database functions for ease of use. Active Record makes building database queries easier and faster. In addition, if Nova was to ever be able to function on multiple database types, using Active Record would ensure that none of the queries would have to be re-written for new database syntax; Active Record takes care of that for us.

Models are stored in the `application/models` folder. To allow for extensibility, we have created a folder called `base` where we store all of the base models, and then we extend them in the root folder. We'll use the awards model as an example. In `application/models/base/awards_model_base.php`, we have our basic methods for accessing awards information, updating awards, creating new awards, and deleting awards.

### Loading a Model

Before a model can be used in a controller, it must first be loaded. By default, Nova auto-loads the settings and messages models for use anywhere in the system. This means that you do not need to load either of those models in your own pages since the system loads them automatically. All other models have to be loaded manually with the following code:

	\$this->load->model('awards_model');

You would then use the model by referencing it in your controller method:

	\$award = \$this->awards_model->get_award(\$id);

You can alternatively assign your model to a different object name by specifying it in the second paramter, like so:

	\$this->load->model('awards_model', 'awards');
	\$award = \$this->awards->get_award(\$id);", 'keywords' => "php, class, model", 'tags' => [7]],

			['title' => "Adding Methods to a Model", 'slug' => "add-methods-to-model", 'summary' => "Learn how to add your own methods to an existing model in Nova", 'content' => "Inevitably, you will come across a situation where the model methods included with Nova just don't do what you want. In those instances, you should create a new model method. It's important that you never try to update an existing model method. Doing so may break parts of the system that use that model method. Fortunately, models, like controllers, were thought of with extensibility in mind, so adding a new method is easy.

The first place to look to see if there's a model method that you can use is in `application/models/base`. If, in the specific model file (usually, each model will interact with one database table) you can't find something, you can open the model file in the `application/models` folder. It's important that you don't edit anything in the `models/base` folder! This includes adding your own methods to the base models. We've made the models extendable so that you can add your own model methods to Nova, and when an update comes around, you don't lose your model in the process of updating.

The model files have everything you need to get started, you simply have to add the method and your calls to the database. Let's say we want to retrieve the award name (and just the award name) from the database for a given award ID. We can do this easily with the following code:

	function get_award_name(\$id = '')
	{
	    \$this->db->from('awards');
	    \$this->db->where('award_id', \$id);

	    \$query = \$this->db->get();

	    return \$query;
	}

That method will return an object that has every piece of data about the award whose ID we passed in as the first parameter. That's all well and good, but we don't want everything, we just want the name. So let's narrow down what our method is returning.

	function get_award_name(\$id = '')
	{
	    \$this->db->from('awards');
	    \$this->db->where('award_id', \$id);

	    \$query = \$this->db->get();

	    if (\$query->num_rows() > 0)
	    {
	        \$row = \$query->row();

	        return \$row->award_name;
	    }

	    return FALSE;
	}

Now, let's break down exactly what's happening in this method. First, we're building our query using CodeIgniter's Active Record library. If we wanted to, we could do a select before the from, but if we don't, it won't hurt anything. Then, we add a where clause. By default, if you don't specify an operator, it uses equal. If you want to use another operator, you'd just need to add it to the end of the first parameter, like so:

	\$this->db->where('award_id >', \$id);

The final query that Nova will produce from this is `SELECT * FROM nova_awards WHERE award_id = 1`. (That assumes that the ID passed in to the method in the controller is 1.) We assign the get method to our variable and the query is run automatically. After the query has run, it sends back an object with all the information and data returned from the query. To avoid errors, we want to first check to make sure there are actually records being returned. Active Record has a handy object method called `num_rows()` that will return the number of rows being returned. If that number is greater than zero, we're going to keep going, otherwise, the method will return `FALSE`. Assuming we have one row being returned, we'll assign the first row in the object to its own variable, then return the variable we want. You'll notice that he second part of the `\$row` variable (the award_name) lines up with the field we're pulling from the database. Now, using the code below will assign the name of the award to the variable `\$award`.

	\$award = \$this->awards->get_award_name(1);

That, in a nutshell, is how you would create your own model methods. Take a look at all the different model methods Nova uses to get a better idea for the kinds of things you can do. Also, make sure to check out the following links for more information about Active Record and CodeIgniter's Database class:

[CodeIgniter Database class](http://codeigniter.com/user_guide/database/index.html)

[CodeIgniter Active Record](http://codeigniter.com/user_guide/database/active_record.html)", 'keywords' => "php, class, model, add, seamless substitution", 'tags' => [7]],

			['title' => "Working with Model Data", 'slug' => "", 'summary' => "Models can return their data in a variety of ways. Learn the different ways and how to use the data.", 'content' => "In Nova, models are an integral part of interacting with the massive amounts of data stored in the database. If you want to do any type of significant development with Nova, you'll definitely have to be comfortable with models. Using them is the easy part, but using what they return is another matter altogether.

For the most part, Nova is going to return data from models in one of a four ways:

- __String__ - In some cases, a model will simply spit out a string of text that can be assigned to a variable and/or echoed out.
- __Boolean__ - In some cases, a model will return a boolean value of either `TRUE` or `FLASE` which you can use in your logic.
- __Array__ - Arrays are everywhere in Nova, so knowing how to work with them is a must. In some cases, Nova's models compile the data it's just pulled into an array and then hands the array off to your script to be used and manipulated.
- __Object__ - The most common way that models will return their data is as an object. In most cases, Nova will return the full object, but other times, it'll only return a row object with a single record.

## Working with Strings

Strings are probably the simplest return form to work with, but are also the rarest found in Nova's models. One of the most prominent items you may find yourself using is the `get_authors()` model method which returns a simple string of character names.

	\$authors = \$this->char->get_authors('1,2', TRUE);

	echo \$authors;

	// would produce:
	Captain Jean-Luc Picard & Commander William Riker

## Working with Booleans

Like strings, booleans are incredibly easy to work with. A boolean is nothing more than a TRUE/FALSE value. Once you have the value back, you can do logic based on the return.

	\$access = \$this->auth->check_access('admin/index');

In the above code, if a user has access to the Admin Control Panel, the access variable will be `TRUE`, otherwise, it'll be `FALSE`. The only thing we need to make sure we do is use the `===` comparison operator instead of `==`. The double equal sign looks for equality, but the triple equal looks for two values being identical and of the same type. That's an important distinction to make as `1` could also be equal to `TRUE` and `0` equal to `FALSE`, but using the triple equal ensures that that confusion won't happen.

With the above code, we'd be able to do things like:

	if (\$access === TRUE)
	{
		echo 'You have access to this page!';
	}
	else
	{
		echo 'You do not have access, go away!';
	}

	// this could also be written:
	\$var = (\$access === TRUE) ? 'You have access to this page!' : 'You do not have access, go away!';

	echo \$var;

## Working with Arrays

There are a handful of models in Nova that will return arrays instead of strings or boolean items. This is done mainly for ease of use for the type of data that's being return. (In addition, there are some models in Nova that take arrays as arguments.) Let's take the `get_character_emails()` model as an example:

	\$emails = \$this->char->get_character_emails('1,3,7,19');

	// would give you an array that looks like:
	Array(
		[1] => john@example.com,
		[2] => dave@example.com,
		[4] => bill@example.com,
		[9] => jane@example.com
	)

	// the pattern here is:
	[player_id] => email

	// note that player ID and character ID will most often not be the same

Now, we have an array with some player IDs and email addresses that I can loop through and take additional action on or use just like a normal array in PHP, including imploding it into a string. This kind of thing can be really handy when sending out emails. Take something like this as an example:

	\$emails = \$this->char->get_character_emails('1,3,7,19');

	\$string = implode(',', \$emails);

	\$this->email->from('me@example.com', 'David');
	\$this->email->to(\$string);
	\$this->email->subject('Hey');
	\$this->email->message(\"Hey guys, how's it going?\");

	\$this->email->send();

The above code would send an email to those four players with the subject of Hey and the message I specified.

<p class=\"alert alert-warning\"><strong>Note:</strong> Lines of code unnecessary to this example have been removed from the email example above. The code will not work as is and is meant only for explanation purposes.</p>

## Working with Objects

Nova is programmed with object oriented programming principles. Having at least a simple understanding of OOP programming will help you a lot when developing for Nova, though it isn't required. When Nova's models return objects, it'll either be a full result set object with everything or a simple row object that'll have a single item from the set of data that was pulled back. Below are how to use both.

If you were to dump the contents of the object a model returns, you'd see something like this:

	CI_DB_mysql_result Object
	(
	    [conn_id] => Resource id #44
	    [result_id] => Resource id #117
	    [result_array] => Array
	        (
	        )

	    [result_object] => Array
	        (
	        )

	    [current_row] => 0
	    [num_rows] => 7
	    [row_data] => 
	)

The object contains all the information returned from the query that our model runs, including the full reset set, the number of rows, the current row and several other pieces of information. (You can see from this too that a query object has both a result object and a result array, though Nova doesn't use the result array anywhere). Once we have this information, we can start to work with the information.

### Full Result Set Object

Because CodeIgniter (and Nova) are built with object oriented principles, that's the primary means by which we're going to work with data. The example below is simple and just grabs all active characters and puts them into an array we can pass to the view file to loop through.

	\$characters = \$this->char->get_all_characters();

	if (\$characters->num_rows() > 0)
	{
		foreach (\$characters->result() as \$c)
		{
			\$data['characters'][\$c->charid]['first_name'] = \$c->first_name;
			\$data['characters'][\$c->charid]['middle_name'] = \$c->middle_name;
			\$data['characters'][\$c->charid]['last_name'] = \$c->last_name;
		}
	}

The first thing we have to do is get the information from the characters model. The `get_all_characters()` method returns a full result set object for us to use. However, before we get the data, we have to do a little sanity checking to make sure we don't throw any errors. We do that by using the object's `num_rows()` method. As long as there are more than zero records, we're going to continue. Next, we use a foreach loop to go through the result set (indicated as the `result()` method).

Now that we're inside our foreach loop, we can start to assign information to our data array. To reference items inside the object set, we use the arrow (`->`) along with the variable we set in our foreach loop (in this case, `\$c`). After that, we can simply pull specific fields by referencing them by name. In this instance, the final data array can be passed to the view and used like all other data arrays in the Nova.

### Single Row Object

Sometimes we want to have the full result set when we work with data coming from a model, but there are times were we know that we only have one record, so we don't need the full result set object, only the row object. In our object we saw above, there's an item in the object called `row_data` that can be used to just get the last row in the result set. If we know we're only going to have a single item coming back, then we only need to use the row data. In some cases, Nova will only return the row object.

So what's the biggest difference? Well, let's take a look at an example and we'll see. In this instance, we want to get information about a specific character.

	\$character = \$this->char->get_character(1);

	if (\$character !== FALSE)
	{
		\$data['character']['first_name'] = \$character->first_name;
		\$data['character']['middle_name'] = \$character->middle_name;
		\$data['character']['last_name'] = \$character->last_name;
	}

In this example, we've assigned the single row object that `get_character()` returns to a variable. In models that return a single row object, Nova does some of the sanity check for you. If there's nothing there, the model returns `FALSE`, otherwise, it'll give you the row object. Because of that, we now have our object assigned to the character variable. After we make sure that there's something in the object, we can simply assign items to our array like we did with a full result set object and then pass our array on to the view.

<p class=\"alert alert-warning\"><strong>Note:</strong> You can pass objects to views instead of arrays if you want, but generally speaking, Nova will always pass an array as it's a little more straightforward to work with and eliminates the need to do more loops in the view files.</p>", 'keywords' => "php, class, model, array, string, object, row, boolean", 'tags' => [7]],

			['title' => "Extending Nova: An Introduction", 'slug' => "extend-intro", 'summary' => "Let's start to talk about extending Nova with a brief introduction", 'content' => "Nova has been designed from the ground up with the idea of extensibility. It's relatively easy to add to or modify Nova's behavior without ever touching the core application files, meaning that when we release an update, your changes stay intact. Let's take a look at how we're going to extend the various pieces of Nova.

## Controllers

Controllers are the heart and soul of Nova. Entire sections and their pages are generated from the controllers and methods. Because of that, controllers are arguably the most important piece that needs to be extensible. One thing that's very important to understand is how CodeIgniter handles loading pages. One of the main functions of controllers is to determine how HTTP requests should be handled. Ultimately, a controller is simply a class file that is named in a way that can be associated with a URI. When a controller's name matches the first segment of a URI, it will be loaded.

There are two options for extending a Nova controller: adding and modifying. Let's look at each carefully.

### Adding a Page to Nova

In order to add a page to Nova, we have to add a method to the controller. A method is nothing more than a function inside a class. We've worked hard to make sure that it's very easy to jump in and start extending the controllers (assuming you know PHP). In the `controllers` directory, you'll notice that the files in there are almost completely empty in addition to a directory called `base`. Base is where Anodyne does all it's work and it's where you'll find all the existing controllers and methods. Main.php is what you can use to add and modify the default behaviors. Anodyne will never update any of the non-base controllers!

We'll get to modifying a method later on, but for now, let's say we want to create a page that displays all the ranks. We'll start by opening `main.php` in a text editor. There are a few things to point out here. First, you'll see that we include the main_base file at the top, this allows us to add and modify the methods in this file and allow them to overwrite what's in `main_base`. Next, you'll see the class declaration. This should never be changed, otherwise, the system will break! Finally, you'll see the contructor, a method that gets called at the top of every single method by default. After that is where we can start our own method. After the closing bracket of the constructor, add the following code:

	function ranks()
	{
		echo 'This is my ranks page!';
	}

If you were to go to `http://yoursite/index.php/main/ranks` before you save this file, an error would be displayed that it can't find that page. Once you save `main.php` and try going to that page, you'll see your text in the browser. That's it. You've just created the first part of a new page in the main section of Nova.

### Modifying an Existing Page

In addition to creating brand new pages, it's possible to overwrite an existing page in Nova with one of our own. Doing so is really as easy and copying and pasting. To modifying an existing method, all you need to do is copy the method from `main_base.php` and pasting it into `main.php` (or whichever files you're working with). Once you have the method in the non-base file, you can modify the method to do whatever you want. You can then use seamless substitution to replace view files, Javascript view files and images to further enhance your modifications.

Using a system like this means that whenever Anodyne updates Nova, your changes stay intact so long as you don't accidentally overwrite the entire directory. No more having to redo all your modifications with every update release or holding off on an update because you don't want to lose changes you've made!", 'keywords' => "controller, view, extend, seamless substitution", 'tags' => [2,7]],

			['title' => "Extending Nova: Templates & Views, Oh My!", 'slug' => "extend-templates-views", 'summary' => "With a skeleton set up, let's fill it out with a view and some data", 'content' => "Nova uses a simplified template system, accurately named Template. Instead of building the template through multiple pages, a single HTML/PHP file is used and \"regions\" are defined where content appears. We're not going to get in to the specifics of Template in this tutorial, but one thing we do need to do is to call the template code in our method. So let's pull up main.php and keep working on our new ranks page.

In the last tutorial, we ended up creating a simple method in main.php that looked like this:

	function ranks()
	{
		echo 'This is my ranks page!';
	}

Let's add some meat to this controller and start to break apart the presentation and logic. The first thing we're going to do is add code that tells the template what to do for our page. You can remove the echo statement and add the following code to your method (between the braces):

	// write the data to the template
	\$this->template->write('title', 'Ranks');
	\$this->template->write_view('content', \$view_loc, \$data);

	// render the template
	\$this->template->render();

These 3 lines of code are paramount to getting Nova to display what we want; these tell the template where to pull the content from. The first line tells our method to write something to the title region, and the second parameter tells it what to write. In this case, we're adding Ranks to the title of the page after the ship name. The second line tells our method to write a view to the content region. The second parameter tells the template where to look for the view file, and the third parameter is actually going to be passing data from the controller method to the view file for the browser to display. Finally, the last line renders the template in it's entirety.

<p class=\"alert alert-warning\"><strong>Note:</strong> Without the last line, your page won't display, it'll just be a blank, white page.</p>

In the line that writes the view file to the content region, you see the `\$view_loc` variable where I said we were telling the system where to look for our view file. That variable will contain information about where our view file is. In our method, above the code we just added, let's add the following line of code:

	// figure out where the view file should be coming from
	\$view_loc = view_location('main_ranks', \$this->skin, 'main');

So what does this code do? We've built a handy little helper for Nova that helps figure out what skin is being used and where it should be pulling view files from. View files are the PHP files that have all the HTML code for our pages. In this case, we're looking for the `main_ranks.php` view file in whatever the current skin is and in the main section. Of course, that file doesn't exist right now, so we need to create it. Create a file called `main_ranks.php` in the `views/_base/main/pages` directory. It should look like this:

	<?php echo text_output(\$header, 'h1', 'page-head');?>
	<?php echo text_output(\$message);?>

One of the advantages of the `view_location` helper is that it checks the current skin to see if there's a view in the skin's pages directory with that name. If it finds a file, it'll use the skin's version of the file instead of whatever's in `_base`. For creating a new page, that doesn't do us a lot of good, because then other skins can't use it. However, when we get into modifying existing pages, that'll become a huge part because it allows us to \"overwrite\" the `_base` view file with our own, meaning our skin can have a unique layout for a page and it doesn't ever affect the system default.

Back to our new view file. The `text_output()` part is a helper that will generate our HTML for us. The first parameter you see is the variable we're passing from the controller (which doesn't exist just yet). The second parameter is the element you want the text to be wrapped in. You can use any HTML element here (h1, h2, h3, h3, h5, h6, p, div, span, quote, etc.). In addition, if you don't want it to have an element, you can simply put nothing in between those single quotes. Finally, the third parameter (which is optional), tells the helper what class to put on the element. In this case, we're putting our text in an H1 element with a class of page-head. That's it. If we tried to load the page now, it would generate a few errors though, so let's keep powering through and finish this tutorial up!

Back in `main.php`, we're going to add two new lines of code after we declare `\$view_loc`:

	\$data['header'] = 'My Ranks';
	\$data['message'] = \"This is the page where I'm going to see all my rank images!\";

Just like that, we've created variables that are passed to the view file. Those two variables we created in the view file? You guessed it, they line up with the names here and will display the data we've set them to. You'll notice that our base variable here is `\$data` and that we passed a variable named `\$data` to our `write_view` function. Making more sense now? Go ahead and refresh the page in your browser and you'll see the text we put in here.

Congratulations, you've just added a view file and told our method to send our data from the method to the new view file!", 'keywords' => "template, view", 'tags' => [2,7]],

			['title' => "Extending Nova: Models, Ooh La La!", 'slug' => "extend-models-1", 'summary' => "Static pages are fine, but let's start interacting with a database to make our page more dynamic", 'content' => "Static pages are all well in good, but Nova has a wealth of information stored in the database and we want to be able to pull that information out and use it on our new page, right? Absolutely. So now we have to dive in and start messing around with models. In CodeIgniter, models are the way we interact with the database. The model does the heavy lift and sends an object back to the controller method. From there, we can parse the information out and use it in our method and view.

We could use an existing model method for this project, but that would defeat the purpose of learning how to really extend Nova, so we're going to create a new model method and introduce you to Active Record. Much like the controllers directory has a `base` folder, the models folder is the same way. Like the controllers, Anodyne does all of its work in the base folder, allowing you to add or modify model methods without touching core files. The same rules that apply to controllers apply to models. So let's open up `application/models/ranks_model.php` in a text editor and create a new method after the constructor.

	function get_rank_list()
	{

	}

The first thing we need to do is select the table where we want to pull our information from. Since we've created this in the ranks model, it makes sense that we're going to be accessing the ranks table. Generally speaking, we have a model for each table of the database. Of course, we've combined a bunch (posts and post comments, for instance, are in the same model). Also, CodeIgniter has a very useful library called Active Record which lets us build queries programmatically. This, potentially, allows Nova to be ported to use a different database platform and still work. So first up, let's grab the table. Add the following line to our method:

	\$this->db->from('ranks_'. GENRE);

Now, this is an interesting method because we have to take into account the genre we're using. Let's break this down a little further. From is, like it's SQL counterpart, simply a statement that says `SELECT something FROM table`. With Active Record, if we don't provide a select statement, it automatically uses `*`, or select everything. Our statement here is selecting everything from `nova_ranks_ds9` (assuming we're using the ds9 genre). The `nova_` prefix is added by Active Record automatically. If we were to run this query, it would look like `SELECT * FROM nova_ranks_ds9`. Pretty straightforward. So next line:

	\$this->db->where('rank_display', 'y');

Now, we're adding a where statement. This statement makes sure we're only pulling rank items that are set to display. This will make our query look like `SELECT * FROM nova_ranks_ds9 WHERE rank_display = 'y'`. Pretty straightforward. If we wanted to, we could add other operators by adding them right after the first parameter (`'rank_display !='` or `'rank_display >'`, etc.). So now, out method looks like:

	\$this->db->from('ranks_'. GENRE);
	\$this->db->where('rank_display', 'y');

	\$query = \$this->db->get();

	return \$query;

As you can see, we've added two lines, and as you guesed it, they do the actual query. We've assigned the query to a variable aptly named `\$query`. Active Record will run the query and assign the object it returns to that variable. After that, we simply return the query variables so we can use it in our controller method. So in the end, our method looks like this:

	function get_rank_list()
	{
		\$this->db->from('ranks_'. GENRE);
		\$this->db->where('rank_display', 'y');
		
		\$query = \$this->db->get();
		
		return \$query;
	}

Next time, we're going to plug that model in to our controller and use it to pass information from the database right to our view file!", 'keywords' => "model", 'tags' => [2,7]],

			['title' => "Extending Nova: Models, Ooh La La! Part 2", 'slug' => "extend-models-2", 'summary' => "After doing some basic interaction with the database, let's hook up our new model method to our controller", 'content' => "In the last tutorial, we talked about models and building a simple model method to get all the ranks in the database that are set to display. In the end, we told our model method to return the query object so we can use it in our controller. That's what we're going to do now; we're going to tell our controller to pull the information from the database, assign it to a variable, do some sanity checking, and finally put everything into an array that we can pass to our view (we could pass an object, but Nova tends to pass arrays).

So to review, our controller method currently looks like this:

	function ranks()
	{
		// figure out where the view file should be coming from
		\$view_loc = view_location('main_ranks', \$this->skin, 'main');
		
		\$data['header'] = 'My Ranks';
		\$data['message'] = \"This is the page where I'm going to see all my rank images!\";
		
		// write the data to the template
		\$this->template->write('title', 'Ranks');
		\$this->template->write_view('content', \$view_loc, \$data);

		// render the template
		\$this->template->render();
	}

Let's start by loading the model. Because of needing to maintain backwards compatability with PHP4, CodeIgniter doesn't support magically loading models when they're used. Some day though. In the meantime, we'll need to load our model. To load the model, put the following line at the top of the method (all inside the brackets):

	\$this->load->model('ranks_model');

This makes any method of our ranks model available to us by using `\$this->ranks_model->method_name()`. Let's simplify even a little further:

	\$this->load->model('ranks_model', 'ranks');

Now, we can access our ranks model by using `\$this->ranks->method_name()` instead. It's just a tad simpler. Please refer to the documentation about models to read about the systemwide model naming scheme. If you cross paths with another model, it will cause issues on your page.

Now that we've loaded our model, we can assign our method to a variable, like so:

	\$ranks = \$this->ranks->get_rank_list();

As soon as the server gets to that point, it triggers the model to run and assign the result of the query to an object in the variable `\$ranks`. From here, we can do some sanity checking and then loop through the object and get what we need. First, we're going to make sure there's actually something in the object.

	if (\$ranks->num_rows() > 0)
	{

	}

The `num_rows()` method is built in to CodeIgniter and will give you the number of rows returned in the query. We just want to make sure there's at least one. If there is, it'll execute whatever code we put in between those braces. Now, between those braces, let's loop through the object.

	foreach (\$ranks->result() as \$rank)
	{

	}

Now, we're taking the results from the ranks object and assigning them to a variable called rank for the duration of the loop. We'll be able to access everything in the object as `\$rank->field_name`. So, let's start building an array to hold all our information that we're going to pass on to the view. Inside the foreach loop braces, let's start assigning things to the array.

	\$data['ranks'][\$rank->rank_id]['name'] = \$rank->rank_name;
	\$data['ranks'][\$rank->rank_id]['image'] = \$rank->rank_image;

You'll remember that we pass a variable to the view called `\$data`. Well, we're using the same variable, just creating a new array off that variable. In this case, we're creating an array called `ranks`. The ranks array is multi-dimensional, meaning it has more than 1 level.  You'll also see after the `\$rank->` is the field name that matches the field we're pulling from the database. In the end, our array is going to look a little like this:

	Array (
		[1] => Array(
			[name] => Admiral
			[image] => r-a4
		),
		[2] => Array(
			[name] => Vice Admiral
			[image] => r-a3
		)
	)

Of course, this array works, but we want to make sure we're pulling all the information so we can see a full image and not just a path. To do that, we need to add another line of code up at the top of our method:

	\$extension = \$this->ranks->get_rank_extension(\$this->rank);

What we've done here is assign the rank set's image extension to a variable that we'll be able to re-use throughout our method. The parameter we're passing to the method is a controller-wide (and systemwide) variable that determine the current rank set that's being used. This model method will grab the extension for us to use. Back down in our foreach loop, we're going to take our array another level deeper. Change the image item to look like this:

	\$data['ranks'][\$rank->rank_id]['image'] = array(
		'src' => rank_location(\$this->rank, \$rank->rank_image, \$extension),
		'alt' => \$rank->rank_name
	);

Now, our array looks a little like this (the path name will vary based on your server setup):

	Array (
		[1] => Array(
			[name] => Admiral
			[image] => Array (
				[src] => application/assets/common/ds9/ranks/default/r-a4.png,
				[alt] => Admiral
			)
		),
		[2] => Array(
			[name] => Vice Admiral
			[image] => Array (
				[src] => application/assets/common/ds9/ranks/default/r-a3.png,
				[alt] => Vice Admiral
			)
		)
	)

The array will continue as long as it has data to keep putting in there. Now, all we have to do is pass the `\$data` variable to the view and then loop through that variable in the view and we'll have a full list of ranks coming from the database.

To recap, our controller method should now look like this:

	function ranks()
	{
		// load the model
		\$this->load->model('ranks_model', 'ranks');
		
		// grab the ranks from the db
		\$ranks = \$this->ranks->get_rank_list();
		
		// grab the extension
		\$extension = \$this->ranks->get_rank_extension(\$this->rank);
		
		// make sure there's something in the object
		if (\$ranks->num_rows() > 0)
		{
			// assign the items to an array for the view
			foreach (\$ranks->result() as \$rank)
			{
				\$data['ranks'][\$rank->rank_id]['name'] = \$rank->rank_name;
				\$data['ranks'][\$rank->rank_id]['image'] = array(
					'src' => rank_location(\$this->rank, \$rank->rank_image, \$extension),
					'alt' => \$rank->rank_name
				);
			}
		}
		
		// figure out where the view file should be coming from
		\$view_loc = view_location('main_ranks', \$this->skin, 'main');
		
		\$data['header'] = 'My Ranks';
		\$data['message'] = \"This is the page where I'm going to see all my rank images!\";
		
		// write the data to the template
		\$this->template->write('title', 'Ranks');
		\$this->template->write_view('content', \$view_loc, \$data);

		// render the template
		\$this->template->render();
	}

In our next tutorial, we'll look at what happens on the view side of things to get these to print out in a nice list.", 'keywords' => "model, controller", 'tags' => [2,7]],

			['title' => "Extending Nova: Controller, Meet View", 'slug' => "extend-controller-view", 'summary' => "With data coming out of the database and into our controller, let's create a view to display the information", 'content' => "We've done the heavy lifting in the controller and model so far and we have all our information. Now, it's time to spit that data out into our view file so that people can see the list of ranks we have available. We'll start by opening the view file we created in our second tutorial. To recap, the view (located at `appplication/views/_base/main/pages/main_ranks.php`) should look like this:

	<?php echo text_output(\$header, 'h1', 'page_head');?>
	<?php echo text_output(\$message);?>

We've already told our controller to pass the information to the view, so we have those items available to us without doing anything special, we just have to use the variables! Let's start by again making sure the variable exists to avoid errors if the query doesn't return anything from our model.

	<?php if (isset(\$ranks)): ?>

	<?php endif; ?>

You'll notice we're using a variable called `\$ranks`. Remember that in our controller, we passed the array to the view as `\$data['ranks']`. All we're doing now is removing the `\$data` part and assigning the ranks array to its own variable. Additionally, Nova uses PHP's alternate syntax in view files to keep PHP statements contained to a single line. This makes it easier for people who aren't as familiar with PHP as they don't have to worry about tracking braces and such. Inside that statement, let's loop through our ranks array.

	<?php foreach (\$ranks as \$rank): ?>

	<?php endforeach; ?>

Again, we're using the alternate syntax for the foreach loop. This will step through each item in the array and give us access to the values through `\$rank['key']`. Inside our foreach loop, let's spit out the rank information.

	<?php echo \$rank['name'] .' '. img(\$rank['image']);?><br />

That will print the name of our rank, a space, then the image. In this instance, we're using a CodeIgniter helper for creating an image tag. Once you've saved the file, you can navigate to your browser and see a full listing of ranks out of the database.

Your view should now look like this:

	<?php echo text_output(\$header, 'h1', 'page_head');?>
	<?php echo text_output(\$message);?>

	<?php if (isset(\$ranks)): ?>
		<?php foreach (\$ranks as \$rank): ?>
			<?php echo \$rank['name'] .' '. img(\$rank['image']);?><br />
		<?php endforeach; ?>
	<?php endif; ?>

That's it. The above is the only presentational code you need and you have a full list of ranks. Congratulations, you've just created a brand new page that has database interactivity!", 'keywords' => "model, controller, view", 'tags' => [2,7]],

			['title' => "Extending Nova: Replacing Pages", 'slug' => "extend-replacing-pages", 'summary' => "Now that we've laid a good foundation for extending Nova, let's dive into the topic of replacing existing pages", 'content' => "Some basic extending stuff is all well and good, but in most cases, you want to do more complex stuff than just changing a view file. What if you wanted to change the default behavior of an existing page? The concepts are the same, but in practice, it's a little trickier than just adding a file to a folder. So let's cook up a scenario and dive in to extend Nova!

## The Scenario

Let's say we want to display a different welcome message based on whether the user is logged in to the site or not. The process isn't that difficult and once you do it once, you'll be on your way.

## The Steps

Since Nova gets its welcome message from the database, we can create a new message to be used for users who are logged in. To do this, we need to log in to the system and create a new message from the Messages &amp; Titles page. You can create a new message by clicking on the Add New Message link. In the modal window that pops up, put in the following information:

	Message Label: Alternate Welcome Message
	Message Key: welcome_alt
	Type: Page Titles
	Content: Welcome back to Nova! Make sure you check your private messages for any new messages.

Once you've hit submit, the message will be created in the database and you'll be able to use it. Now that that part is finished, let's go to work changing the behavior of the page.

### Extending the Main Controller

To start, we're going to need to open two files: `application/controllers/main.php` and `application/controllers/base/main_base.php`. Let's focus on the base controller for right now.

The way extending a controller works is that you're essentially laying a new method over top of the existing one. That means Nova only understands the new method and not the old one, but if you were rename or remove your method, it'll be able to see the old method and use that. We're going to cover up the old method. To do this, we need to copy the entire `index` method.

<p class=\"alert alert-warning\"><strong>Note:</strong> In object oriented programming like Nova, a method is how a function inside a class is described.</p>

In `application/controllers/base/main_base.php`, copy the entire `index` function. This includes everthing from the word `function` all the way to the curly brace before the next word function.

	function index()
	{
		/* load the models */
		\$this->load->model('news_model', 'news');
		
		/* run any model or lib methods */
		\$news = \$this->news->get_news_items(5, \$this->session->userdata('userid'));
		
		if (\$news->num_rows() > 0 && \$this->options['show_news'] == 'y')
		{
			\$i = 1;
			\$datestring = \$this->options['date_format']; /* set the datestring */
			
			foreach (\$news->result() as \$row)
			{ /* populate the news item data */
				\$date = gmt_to_local(\$row->news_date, \$this->timezone, \$this->dst);
				
				\$data['news'][\$i]['id'] = \$row->news_id;
				\$data['news'][\$i]['title'] = \$row->news_title;
				\$data['news'][\$i]['content'] = \$row->news_content;
				\$data['news'][\$i]['date'] = mdate(\$datestring, \$date);
				\$data['news'][\$i]['category'] = \$row->newscat_name;
				\$data['news'][\$i]['author'] = \$this->char->get_character_name(\$row->news_author_character, TRUE);
				
				++\$i;
			}
		}
		
		/* header and welcome message */
		\$data['header'] = \$this->msgs->get_message('welcome_head');
		\$data['msg_welcome'] = \$this->msgs->get_message('welcome_msg');
		
		/* labels */
		\$data['label'] = array(
			'news' => ucwords(lang('status_latest') .' '. lang('global_news')),
			'posted' => ucfirst(lang('actions_posted') .' '. lang('labels_on')),
			'by' => lang('labels_by'),
			'in' => lang('labels_in'),
		);
		
		/* figure out where the view files should be coming from */
		\$view_loc = view_location('main_index', \$this->skin, 'main');
		\$js_loc = js_location('main_index_js', \$this->skin, 'main');
		
		/* write the data to the template */
		\$this->template->write('title', ucfirst(lang('labels_main')));
		\$this->template->write_view('content', \$view_loc, \$data);
		\$this->template->write_view('javascript', \$js_loc);
		
		/* render the template */
		\$this->template->render();
	}

Next, we need to paste what we've copied into `application/controllers/main.php` after the comment that says _/** your methods here **/_. If we saved the `main.php` file right now and uploaded it, we wouldn't notice any differences, but in a few minutes, we'll see a bunch of differences.

### The Auth Library

Nova's Auth library is a great tool with a lot of useful methods, one of which is checking whether or not someone is logged in. This situation is precisely one of those situations where we can use the Auth library.

### The Logic

We need to start by removing the `\$data['msg_welcome']` line. This is where we're going to do all of our work. Hit enter a few times to give yourself a place to code. Next, let's create the basis of our if/else logic.

	if ()
	{
	    # code...
	}
	else
	{
	    # some more code...
	}

This is the basic foundation we're going to build on. If the condition we give it is true, it'll execute the code inside the braces, otherwise, it'll execute whatever we put in the else statement. So let's start by giving it a condition to test.

	if (\$this->auth->is_logged_in())

The Auth library is auto-loaded by the system so it's always available so we don't need to worry about loading the library. The `auth` part tells us we're dealing with the Auth library and `is_logged_in()` is our method that we're calling. This will check to if the current user is logged in and return `TRUE` if they are or `FALSE` if they aren't.

Now that we have a condition for the page to check, let's tell it what to do if the condition is true.

	\$data['msg_welcome'] = \$this->msgs->get_message('welcome_alt');

Notice we've supplied the `get_message()` function with the key of the message we created earlier. That tells the messages model to grab the message from the database with that key. It'll return the full text for us to use in the view file. In our else statement, we can tell the system to do something different.

	\$data['msg_welcome'] = \$this->msgs->get_message('welcome_msg');

### Final Code

It's not much code, but we've just managed to change Nova's welcome page to show different messages based on whether the user is logged in or not. Our final method will look like this:

	function index()
	{
		/* load the models */
		\$this->load->model('news_model', 'news');
		
		/* run any model or lib methods */
		\$news = \$this->news->get_news_items(5, \$this->session->userdata('userid'));
		
		if (\$news->num_rows() > 0 && \$this->options['show_news'] == 'y')
		{
			\$i = 1;
			\$datestring = \$this->options['date_format']; /* set the datestring */
			
			foreach (\$news->result() as \$row)
			{ /* populate the news item data */
				\$date = gmt_to_local(\$row->news_date, \$this->timezone, \$this->dst);
				
				\$data['news'][\$i]['id'] = \$row->news_id;
				\$data['news'][\$i]['title'] = \$row->news_title;
				\$data['news'][\$i]['content'] = \$row->news_content;
				\$data['news'][\$i]['date'] = mdate(\$datestring, \$date);
				\$data['news'][\$i]['category'] = \$row->newscat_name;
				\$data['news'][\$i]['author'] = \$this->char->get_character_name(\$row->news_author_character, TRUE);
				
				++\$i;
			}
		}
		
		/* header and welcome message */
		\$data['header'] = \$this->msgs->get_message('welcome_head');
		
		if (\$this->auth->is_logged_in())
		{
			\$data['msg_welcome'] = \$this->msgs->get_message('welcome_alt');
		}
		else
		{
			\$data['msg_welcome'] = \$this->msgs->get_message('welcome_msg');
		}
		
		/* labels */
		\$data['label'] = array(
			'news' => ucwords(lang('status_latest') .' '. lang('global_news')),
			'posted' => ucfirst(lang('actions_posted') .' '. lang('labels_on')),
			'by' => lang('labels_by'),
			'in' => lang('labels_in'),
		);
		
		/* figure out where the view files should be coming from */
		\$view_loc = view_location('main_index', \$this->skin, 'main');
		\$js_loc = js_location('main_index_js', \$this->skin, 'main');
		
		/* write the data to the template */
		\$this->template->write('title', ucfirst(lang('labels_main')));
		\$this->template->write_view('content', \$view_loc, \$data);
		\$this->template->write_view('javascript', \$js_loc);
		
		/* render the template */
		\$this->template->render();
	}

### Ternary Operators

We can clean up the code a little more by using ternary operators. In that instance, your block of logic would be reduced to a single line of code:

	\$data['msg_welcome'] = (\$this->auth->is_logged_in()) ? \$this->msgs->get_message('welcome_alt') : \$this->msgs->get_message('welcome_msg');

## Other Options

Using CodeIgniter's built in libraries, there are a lot of different things like this you could do. Below are a couple you can try.

	// show a message if the user is using Internet Explorer
	\$this->load->library('user_agent');

	if (\$this->agent->browser() == 'Internet Explorer')
	{
		echo \"You really shouldn't be using Internet Explorer!\";
	}

	===============================

	// show a message if the user is a system administrator
	if (\$this->auth->is_sysadmin(\$this->session->userdata('userid')))
	{
		echo \"You are a system administrator!\";
	}

	===============================

	// show a message if there's a specific item in the URI
	if (\$this->uri->segment(3) == 'foo')
	{
		echo \"The third URI segment is foo.\";
	}

	===============================

	// show a message if someone has a specific access level on the current page
	if (\$this->auth->get_access_level() == 2)
	{
		echo \"You have level 2 access.\";
	}

Obviously you wouldn't just echo out sentences. Inside your logic you could do more work and take certain actions only in the event that those conditions are true. Play around with it and see what you can come up with!", 'keywords' => "seamless substitution, controller, model, view", 'tags' => [2,7]],

			['title' => "Controllers", 'slug' => "", 'summary' => "What is a controller?", 'content' => "Controllers are classes that can be reached through the URL and take care of handling the request from the browser. A controller calls models and other classes to fetch the information and finally will pass everything to a view for output. If a URL like `www.yoursite.com/example/index` is requested, the first segment will be which controller is called (\"example\") and the second which method of that controller is called (\"index\").

## Creating a controller

In Nova, controllers are put in the `application/controllers` directory. At the very least, they need to extend the Controller class. Below is an example of the controller \"example\":

	class Example extends Controller {

		function Example()
		{
			parent::Controller();
		}

		function index()
		{
			\$data['header'] = 'My New Controller';
			
			\$this->template->write('title', \$data['header']);
			\$this->template->write_view('content', '_base_override/main/pages/example_index', \$data);
			
			\$this->template->render();
		}
	}

Anyone familiar with PHP will recognize that our constructor doesn't use PHP's `contruct()` method nor do controller methods have a visibility scope (public, private, protected). This is because we maintain PHP 4 compatability. A future version of Nova 1 will require PHP 5.0 or higher, but for now, we recommend that if you're distributing your work to other Nova sims that you make sure all your code works on PHP 4.3.2 and higher.

## Using more parameters from the URL

In addition to pulling the controller and method from the URL, Nova can also pull additional parameters from the URL that you can pass from page to page. It's important though that you realize the security implications of doing so. Anything like usernames, passwords or any sensitive information should not be passed over the URL.

For the URL `www.yoursite.com/example/index/action/2`, you can access the final two segments using the following code:

	\$data['type'] = \$this->uri->segment(3);
	\$data['id'] = \$this->uri->segment(4);

Notice that we're referencing segments 3 and 4 since segments 1 and 2 are the controller and method respectively. Once you have these segments, you can do any type of logic with them that you'd like using standard PHP logic.

## Editing a controller

In Nova, controllers are a two part entity. The first part is the base controller, always located in `application/controllers/base` and having a \"_base\" after the name of the file. This is the file we create and shouldn't be edited. Instead, if you want to edit a controller, you should use the file located in `application/controllers`. So if you wanted to edit the \"sim\" controller to edit an existing page, you would copy the method you want from `application/controllers/base/sim_base.php` and paste it into `application/controllers/sim.php`, make your edits, save it and upload it to the server.", 'keywords' => "php, class, controller", 'tags' => [7]],

			//['title' => "", 'slug' => "", 'summary' => "", 'content' => "", 'keywords' => "", 'tags' => []],
		];
	}

}
