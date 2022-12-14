For MediaWiki (MW) 1.38 and later no dedicated tags will be created, i.e. for 1.38.x use branch
`REL1_38`. For MW 1.39.x use `REL1_39`, etc.

# Version 2.3.0
* [compatibility, CSS] Load MW core CSS that was dropped in MW 1.35
* [code] Drop Travis-CI and move to CircleCI
* [code] Update php-parallel-lint to a supported branch with PHP 8.0
* [deprecated, code] Updated deprecated code

## Version 2.2.2
* [bug, enhancement] Fix to allow multiple methods of login such as MW-OAuth2Client - Issue #99
* [bug, enhancement] Left-menu search (on mobile widths only) doesn't auto-complete #98

## Version 2.2.1
* [enhancement] Enumeration and Listings #54
* [bug] Search results page - limited width #58
* [bug] Syntax error in pivot.css Issue #89 
* [bug] Personal tools menu name not translated into other languages Issue #88
* [bug] Search autocomplete not available on small screens Issue #85
* [bug] The links in the menu titles on the left seem to be clickable off they should not be. Issue #68 

## Version 2.2.0
* [compatibility, deprecated] Fix for deprecated wfSuppressWarnings and wfRestoreWarnings with new Wikimedia\...
* [b/c break] Version minor bump, MW >= 1.31.0 now required
* [enhancement] Use of requires MW version in skin.json


## Version 2.1.1

* [CSS, enhancement] Improvements correcting Issues #72 and #69, images the MW way
* [CSS] Further improvements found similar to Search Input alignment on other form type pages

## Version 2.1.0

* [bug fix, compatibility] Replace wfRunHooks with Hooks::run PR #74 issue #75
* [bug fix, enhancement] Always adds the server name to the h1 tag issue #76 SEO related
* [CSS] Search Input alignment fix
* [CSS] Improvements and fixes after issue #76 was fixed
* [bug-fix, compatibility] Code loading changes, $out->addModuleScripts() to $out->addModules() issue #78
* [compatibility] Removal of fastclick.js as mobile browsers now deal with touch delay automatically

## Version 2.0.0

* [bug fix] Addressed serveral W3C validation errors with HTML output.
* [bug fix] update JavaScript of Foundation.js to stop deprecation warnings. Now version matches Foundation branch of Foundation 5.5.3 not released.
* [CSS, bug fix] various changes to CSS to fix bugs and address MediaWiki hidden CSS loading 
* [enhancement] ability to preload Font Awesome and bypass server setup errors, added as a feature setting
* [enhancement] move all Font Awesome icons to `::before` CSS from JS pivot.js
* [b/c changes] remove feature `'IeEdgeCode'` feature set to send a compatibility header
* [b/c changes] removing support for IE 9 and earlier

## Version 1.0.5

* [bug fix] Search link was not follow $wgScript path
* [language] Search input box localisation

## Version 1.0.4

* [bug fix] Don't style sitenotice and user message
* [bug fix] Echo compatibility with Echo REL_1_28 release
* [bug fix] Page indicator margins

## Version 1.0.3

* [enhancement] Added support for Visual Editor
* [enhancement] Added support for Page Indicators
* [bug fix] Minor CSS changes for Echo integration and NO Print elements

## Version 1.0.2

* [bug fix] AddThis div container
* [enhancement] Hide AddThis on non content pages by disabling <script> from running

## Version 1.0.1

* [enhancement] License update on Special:Version
* [bug fix] Echo notification sizing mobile CSS 
* [bug fix][enhancement] Move Echo notification container to page content area
* [enhancement] Echo notification count number hidden when 0

## Version 1.0.0

* Initial release of Pivot skin for MediaWiki