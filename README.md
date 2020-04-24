# tcpdf-wrapper
A Wordpress wrapper for the popular PHP based TCPDF Library to generate PDF document on the fly.


Inspired by the TCPDF Library plugin of [Rheinard Korf](https://wordpress.org/plugins/tcpdf/), this plugin exposes the **TCPDF** library version 6.3.5 to be used by other plugins or themes. This greatly reduces the size of plugins and will ensure that you always have the latest TCPDF version (compatible with WordPress minimum requirements) available. You can also configure if you want to include the wrapper **globally** or **manually** within your plugin or theme.

### Credits
* autho Nicola Asuni info@tecnick.com
* copyrigh 2002-2020 Nicola Asuni - Tecnick.com LTD
* license http://www.gnu.org/copyleft/lesser.html GNU-LGPL v3 (see LICENSE.TXT)
* link http://www.tcpdf.org
* source https://github.com/tecnickcom/TCPDF

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/doublewp-tcpdf` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->TCPDF Library screen to configure the plugin

== Frequently Asked Questions ==

= How do I use this library for a specific plugin of mine? =
Please go to Settings-> TCPDF Library, Disable the global inclusion option and copy the sample code provided that needs to be added within your plugin.

= Can I use this plugin to generate PDF of my pages and post? =

Yes. However, you need to follow the [TCPDF documentation](https://tcpdf.org/examples/) and add the required code within your plugin/ theme to generate the PDF document of your page or a post.

== Changelog ==

= 1.0 =
* First stable release, using TCPDF version 6.3.5
