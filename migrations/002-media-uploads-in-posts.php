<?php

define('SHORTINIT', true);
require('wp/wp-load.php');
global $wpdb;

// Switch out wp-content/uploads for media
$sql = "update wp_posts set post_content=replace(post_content, 'wp-content/uploads', 'media')";
$wpdb->query($sql);
