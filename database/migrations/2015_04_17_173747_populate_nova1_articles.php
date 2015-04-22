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

			['title' => "Installing Nova", 'slug' => "install", 'summary' => "", 'content' => "Installing Nova on your server is a relatively painless process that should only take a few minutes if you have all the pieces you need at the start. In order to install Nova on your server, you'll need the following information:

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

			['title' => "Requirements", 'slug' => "", 'summary' => "", 'content' => "## Server Requirements

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

			['title' => "Upgrading from SMS 2 to Nova", 'slug' => "upgrade", 'summary' => "", 'content' => "Upgrading from SMS to Nova is an easy process that should take anywhere between 5 and 10 minutes to complete depending on your server and Internet connection. In order to upgrade to Nova on your server, you'll need the following information:

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

			['title' => "Updating Nova", 'slug' => "", 'summary' => "", 'content' => "It isn't enough to just release a system like Nova, you have to maintain it and you have to make it better. Anodyne intends to exactly that with Nova in the same way we've done it with SMS for years now. Because of that, on a regular basis you can expect to be notified of updates to Nova. Some of these may be minor and only address bugs while others will be larger and introduce new functionality to the system.

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

			//['title' => "", 'slug' => "", 'summary' => "", 'content' => "", 'keywords' => "", 'tags' => []],
		];
	}

}
