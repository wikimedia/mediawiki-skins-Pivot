# MediaWiki Pivot Skin

A [MediaWiki](http://www.mediawiki.org) skin that focuses on mobile first but will pivot to all viewports with elegance.
Supports responsive layouts and has classes predefined for [Semantic MediaWiki](https://www.semantic-mediawiki.org/wiki/Semantic_MediaWiki).
Built on the [Foundation Framework](https://get.foundation/) for CSS (version 5).

Read the docs below (short version) or see [pivot.wikiproject.net](https://pivot.wikiproject.net) for more detailed docs
with FAQs and examples of use.

## Download

First, copy the Foreground source files into your MediaWiki skins directory. You can either download the files and
extract them from, e.g. for MediaWiki 1.38.x:

    https://github.com/wikimedia/mediawiki-skins-Pivot/archive/refs/heads/REL1_38.zip

Use "REL_39.zip" for MediaWiki 1.39.x, etc.

You should extract that into a folder named `Pivot` in your `skins` directory.

Alternatively, you can use Git to clone the repository, which makes it very easy to update the code, using e.g. for
MediaWiki 1.38.x:

    git clone https://github.com/wikimedia/mediawiki-skins-Pivot.git Pivot

followed by

    git checkout REL1_38

Use `REL_39` for MediaWiki 1.39.x, etc.

## Setup

Once the skin is in place add the following line to your "LocalSettings.php" file:

    wfLoadSkin( 'Pivot' );

This will activate Pivot in your installation. At this point you can select it as a user skin in your user preferences.

To activate Pivot for all users and anonymous visitors, you need to set the `$wgDefaultSkin` variable and set it to `pivot`.

    $wgDefaultSkin = 'pivot';

## Configurations

Use following features in "LocalSettings.php" to change the behavior of the skin. 

- `'showActionsForAnon' => true` displays page actions for non-logged-in visitors.
- `'fixedNavBar' => false` will allow the NavBar to scroll with the content, `true` will lock the NavBar.
- `'usePivotTabs' => false` set to true to enable Foundation tabs markup in wiki pages.
- `'showHelpUnderTools' => true` a Link to "Help" will be created under "Tools".
- `'showRecentChangesUnderTool's => true` a Link to "recent changes" will be created under "Tools".
- `'wikiName' => $wgSitename` default is the sitename. Set to display a short version without changing the systems wikiname.
- `'wikiNameDesktop' => $wgSitename` default sitename. Set to display a longer name in desktop view.
- `'navbarIcon' => false` no icon in mobile view, `true` to use the global set logopath image of the wiki.
- `'preloadFontAwesome' => false` set to true to preload Font Awesome as a `<head>` element. Useful to overcome MIME type server configurations not set correctly.
- `'showFooterIcons' => false` will show text in place of footer icons, `true` will output the icons as globally set.
- `'addThisPUBID' => ''` empty string will not fire the AddThis script, `'ra-##-#######'` publisher ID will allow the run the AddThis script in async on content pages only.
- `'useAddThisShare' => ''` default empty string, do not use AddThis share, `your_addthis_specific_div_class_string` will insert the share toolbox div directly under page title, but before the tagline with your custom div class.
- `'useAddThisFollow' => ''` default empty string, do not use AddThis follow, `your_addthis_specific_div_class_string` will insert the follow toolbox div in the `right-footer` area before icon or text output with your custom div class.

These are the default values:

	$wgPivotFeatures = [
		'showActionsForAnon' => true,
		'fixedNavBar' => false,
		'usePivotTabs' => false,
		'showHelpUnderTools' => true,
		'showRecentChangesUnderTools' => true,
		'wikiName' =>$wgSitename,
		'wikiNameDesktop' => $wgSitename,
		'navbarIcon' => false,
		'preloadFontAwesome' => false,
		'showFooterIcons' => true,
		'addThisPUBID' => '',
		'useAddThisShare' => '',
		'useAddThisFollow' => ''
	];

You can change the default settings by adding the `$wgPivotFeatures` array with other values into you "LocalSettings.php"
file below the line activating the skin.

### Notes on other skins

As you build a wiki out with Pivot you will likely use the responsive grid from Foundation. This is key to making a
responsive wiki, and is one of the largest _migration_ requirements when you want to move a wiki that previously used
Vector (and likely a lot of tables for layout) to Pivot. Once you do this, the ability of a user to select whatever
skin will be removed. If you take full advantage of Pivot in your templates the lack of the Foundation grid will make
viewing the wiki using [Vector](https://www.mediawiki.org/wiki/Skin:Vector) or [MonoBook](https://www.mediawiki.org/wiki/Skin:MonoBook) 
very difficult.

Because of this, it is suggested that you set the `$wgSkipSkins` configuration parameter to make sure that everyone sees
the site as you intended it. This removes other skins from being user selectable options.

    // Pivot is specific, so lets disable other skins
    $wgSkipSkins = [
        'cologneblue',
        'minerva',
        'modern',
        'monobook',
        'timeless',
        'vector'
    ];

You may also want to allow users to set a User CSS if they want to tweak things inside of Pivot. This is entirely optional.

    # Allow User CSS, mostly for skin testing
    $wgAllowUserCss = true;

You can see a list of wikis with [Pivot installed at WikiApiary](https://wikiapiary.com/wiki/Skin:Pivot).