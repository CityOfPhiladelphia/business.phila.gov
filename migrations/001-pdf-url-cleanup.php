<?php

define('SHORTINIT', true);
require('wp/wp-load.php');
global $wpdb;

// Switch out wp-content/uploads for media
$sql = "update wp_postmeta set meta_value=replace(meta_value, 'wp-content/uploads', 'media') where meta_key='business_pdf'";
$wpdb->query($sql);

// Point at https
$sql = "update wp_postmeta set meta_value=replace(meta_value, 'http://business.phila.gov', 'https://business.phila.gov') where meta_key='business_pdf'";
$wpdb->query($sql);

// Full URLs
$sql = "update wp_postmeta set meta_value=replace(meta_value, '/media', 'https://business.phila.gov/media') where meta_key='business_pdf' and meta_value like '/media%'";
$wpdb->query($sql);
