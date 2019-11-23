# HvZ at FSU Website
### Website used by the group at Florida State Univeristy in 2010-2014 to run their Humans vs Zombies game.

I decided to open source this after years of it sitting quietly on my computer. I figured its a nice way to see how things might have been done by someone who was learning, and there are a few lessons of _what not to do_ in here, too. There are almost no libraries in here, everything is hand coded and created from scratch. The original copyright for this site is [CC BY-NC-ND 3.0](https://creativecommons.org/licenses/by-nc-nd/3.0/us/). It can be used for any NonCommercial purposes, Credit is Required, and No Derivatives. That's buried somewhere in one of these files

This entire application was written by hand over those four years. It went through quite a few iterations, but I didn't use any sort of source control. During that time, I was learning PHP while coding, so there is some funky stuff in here. Like hand-created XML files with PHP shoving raw strings into the fields. Or not actually setting the server url or anything and instead hoping the data returned by $_SERVER['SERVER_NAME'] is correct. It is quite impressive that some of this worked without any data loss or hacking. Especially since security was definitely an after thought, even though I was _convinced_ that I was securing this. I was also learning the magic of databases! So there are some odd tables, like `kills` and `kills2`. Both of them contain data about which players were tagged by whom, but why are they different? I don't know. Another great gem: When creating a new user, it sends them a message "Welcome, name". It sent it in the database. So when you look at the messages, you will have hundreds of the _exact same message_. I based a lot of the design and functionality off of Facebook circa 2010, since that was the audience I was targeting. 

There are two folders, 'ajax' and 'apps'. Both contain files to allow the Javascript to do Ajax requests. Some are component-like files which are included in a ton of places, some are not.

The database credentials are scattered throughout the project, but they are for a server that no longer exists and it points to 'localhost' so it isn't a big deal. Also the database schema (with no data) is under `/db/hvzatfsu.sql`

There is a folder called 'android' because I think I was prepping to make an Android app for the game. That would've been for Android Gingerbread, to put the time in perspective.

There's also a file called 'clock.html' - it is just a giant full screen clock. What is the reason? There is none.

I also worked on this before I learned how to use source control, so there are a few files like 'index.php' and then 'newindex.php' and 'index2.php'. Some of them are newer, some are blank. Some are identical.

I don't claim any credit for any of the images in here. Many were created by me for the website, but there are many in here that are from other libraries or other people. I can't remember who gave what, but if you would like your name on here, go ahead and make an edit. I removed all the personally identifying information from the photos.

### If you do any work on this, feel free to make a pull request against the repository. If you actually use this, feel free to open bugs and feature requests as well.

## Requirements
* PHP - 5.2.5, but I don't think there's any version-specific code in here. 
* MySQL - 5.1.30, I'd assume it should work on later versions without any major updates.
* Apache - I have no idea which version of Apache was being used.
* Linux (Windows might work, who knows)

## Features
* Membership
* Profile System
* Image uploads and reformatting (all done on the fly!)
* Forums
* Messages
* Notifications
* I think there's an email sender somewhere in here
* Admin console
* Kind of a marketplace - it was a futile effort to possibly create a source of income
* AND MORE! Seriously, I don't remember what's in here.

## Special Thanks
It's been at least 5 years since I've spoken to many of the names below, and it's been even longer since they've worked on this.

#### Development
* Geoffery Miller
* John Seigel
* Ryan Learn

#### Testing or Ideas or Forcing me to take a break
* Laura Bradley
* Andrew Clements
* Tyler Green
* Connie Tenorio
* Patrick Murphy
* Scott (Blue) Thomas
* Riley Lungmus
* Travis Sampiero
