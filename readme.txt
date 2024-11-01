=== Youtube Privacy ===
Contributors: aldarone
Donate link: https://flattr.com/profile/Aldarone
Tags: youtube, embed, privacy, ssl, nocookie
Requires at least: 2.9
Tested up to: 3.2.1
Stable tag: 1.0.1

This plugin relies on wordpress automatic embedding to allow you to embed youtube videos using the youtube-nocookie.com domain and with SSL encryption

== Description ==

This is a lightweight plugin to embed youtube in a way that respects your readers privacy.

It uses the standard wordpress syntax to embed youtube videos from https://www.youtube-nocookie.com instead of http://www.youtube.com so the video is encrypted with https and no cookies are send to track the user.

= Features =
* No special syntax. Just use automatic wordpress embedding introduced in WordPress 2.9. Put the video URL on a new line or (if you want to specify the size) between `[embed]` shorcode. [More info in the codex](http://codex.wordpress.org/Embeds).

* Uses HTTPS and youtube-nocookie.com for privacy.
* Mobile devices compatibility (HTML5 tag used if the device is compatible)

== Installation ==
1. Decompress the zip in your plugins directory.
2. Activate the plugin.
3. Enjoy.

== Changelog ==

= 1.0.1 =
* Minor update: Added an option panel to switch between `iframe` or `object` for the sake of compatibility.

= 1.0 =
* Fix: URL parameters for youtube player are no longer ignored. [See the list here](http://code.google.com/intl/fr-FR/apis/youtube/player_parameters.html).
* Changed `<iframe>` to `<object>` following W3C recommandations. (Object doesn't work with Safari mobile/Opera mobile)
* Changed size ratio to 16/9 from 4/3.
* The video controls fade out after a few seconds.

= 1.0a1 =
* First release: Juste embed the video from youtube-nocookie with HTTPS in an iframe.
