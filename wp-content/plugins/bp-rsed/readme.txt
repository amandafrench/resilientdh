=== BP Restrict Signup by Email Domain  ===
Contributors: r-a-y, cuny-academic-commons
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=V9AUZCMECZEQJ
Tags: buddypress, registration
Requires at least: WordPress 3.4.x, BuddyPress 1.6
Tested up to: WordPress 4.4.x, BuddyPress 2.5.x
License: GPLv2 or later
Stable tag: 1.0.0
 
Only allow users with email addresses from certain domains to register in BuddyPress.

== Description ==

User registration spam is prevalent in BuddyPress.

One way to dramatically decrease signup spam is to restrict the email address domains that users can sign up with.

WordPress multisite has a native option called "Limited Email Registrations".  But this option requires you to enter the full email domain.  For example, if you only wanted to allow .edu email addresses to register, this is not possible.

This plugin restricts registrations to the email domains that you specify and works in WordPress single-site and multi-site.

Plugin was developed for the [CUNY Academic Commons](http://commons.gc.cuny.edu).  Licensed under the GPLv2 or later.

[Follow development on GitHub](https://github.com/cuny-academic-commons/bp-rsed).

Tested on BuddyPress 2.5, but should work all the way down to BuddyPress 1.6.

== Installation ==

* Download, install and activate this plugin.
* Login to the WP admin dashboard and navigate to the "Settings > BuddyPress" page.  Next, click on the "Options" tab.  (If you're using BuddyPress 2.4 or lower, click on the "Settings" tab).
* You should see a new section called "Email Address Restrictions".
* Under "Whitelist Email Domains", list the email domains that users can register with.

eg. If you type in:

    .edu
    .org
    mycustomdomain.com

This will only allow users with .edu, .org, or mycustomdomain.com email addresses to register on the site.

Any other email address will be blocked from registration.

* To customize the error message and registration blurb, edit the other two fields.

== Screenshots ==

https://cloud.githubusercontent.com/assets/505921/13607183/e1aacee8-e503-11e5-9663-cc2965d3eabe.png

== Changelog ==

= 1.0.0 =
* Initial public release
