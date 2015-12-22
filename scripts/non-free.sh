#!/bin/bash
#
# Install non-free plugins and themes

_dir="$(dirname "$0")"
plugins="gdlr-shortcode-1.0.zip masterslider-2.14.2.zip"
themes="megaproject-1.06.zip"

for plugin in $plugins; do
  wp plugin install --quiet --force --activate "$("$_dir/s3url.sh" "$PLUGIN_BUCKET" "$plugin")"
done

for theme in $themes; do
  wp theme install --quiet --force --activate "$("$_dir/s3url.sh" "$PLUGIN_BUCKET" "$theme")"
done
