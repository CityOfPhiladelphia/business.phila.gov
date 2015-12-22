#!/bin/bash
#
# Install non-free plugins and themes

_dir="$(dirname "$0")"
plugins="gdlr-shortcode-1.0.zip masterslider-2.20.4.zip"

for plugin in $plugins; do
  wp plugin install --quiet --force --activate "$("$_dir/s3url.sh" "$PLUGIN_BUCKET" "$plugin")"
done

wp theme install --quiet --force "$("$_dir/s3url.sh" "$PLUGIN_BUCKET" megaproject-1.07.zip)"
