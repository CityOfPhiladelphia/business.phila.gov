#!/bin/bash
#
# Install private plugins

_dir="$(dirname "$0")"
plugins="megaproject-1.06.zip"

for plugin in $plugins; do
  wp plugin install --quiet --force --activate "$("$_dir/s3url.sh" "$PLUGIN_BUCKET" "$plugin")"
done
