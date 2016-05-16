=== Plugin Name ===
Contributors: rmb185
Donate link: https://www.paypal.com/us/cgi-bin/webscr?cmd=_flow&SESSION=WW3LiAp4DccdyrD4QVR0c_XWINGbnIFFQKBrjdenB-0ZzQ33QBR1Xm7WMLK&dispatch=5885d80a13c0db1f8e263663d3faee8da8649a435e198e44a05ba053bc68d12e
Tags: sentry, logging, diagnostics, debugging
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
GitHub Plugin URI: https://github.com/ryanbagwell/wordpress-sentry
GitHub Branch: master

A plugin that sends error messages to the Sentry error logging system.

== Description ==

A plugin that sends error messages to the [Sentry error logging system](https://getsentry.com/welcome/).

== Installation ==

1. Upload the plugin's contents to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. In Settings > Sentry, add your Sentry DSN and set the error reporting threshold level.

== Bug reports and support ==

To report bugs and get help, see the [official github repository](https://github.com/ryanbagwell/wordpress-sentry/issues).

== Changelog ==

= 1.2 =

Adding the ability to access the Raven client directly to send custom error messages to sentry. Merge PR from @wk8.

= 1.1 =

Upgrade raven php client to v0.15.0

= 1.0 =

* Bumb version to 1.0 because the WordPress plugins page keeps showing Version 1 as the current version for some reason

= 0.5 =

* Bump version to correct errant stable version number

= 0.4 =

* Bump version to sync with wordpress.org plugins page

= 0.3 =

* Now registering php error handlers with Raven client to improve error reporting.

= 0.2 =

* Updated Raven PHP Client

= 0.1 =

* Added first release.

== Contributors ==

vbartusevicius (https://github.com/vbartusevicius)





