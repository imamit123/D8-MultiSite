<?php

/**
 * @file
 * Configuration file for Drupal's multi-site directory aliasing feature.
 *
 * Drupal searches for an appropriate configuration directory based on the
 * website's hostname and pathname. A detailed description of the rules for
 * discovering the configuration directory can be found in the comment
 * documentation in 'sites/default/default.settings.php'.
 *
 * This file allows you to define a set of aliases that map hostnames and
 * pathnames to configuration directories. These aliases are loaded prior to
 * scanning for directories, and they are exempt from the normal discovery
 * rules. The aliases are defined in an associative array named $sites, which
 * should look similar to the following:
 *
 * $sites = array(
 *   'devexample.com' => 'example.com',
 *   'localhost.example' => 'example.com',
 * );
 *
 * The above array will cause Drupal to look for a directory named
 * "example.com" in the sites directory whenever a request comes from
 * "example.com", "devexample.com", or "localhost/example". That is useful
 * on development servers, where the domain name may not be the same as the
 * domain of the live server. Since Drupal stores file paths into the database
 * (files, system table, etc.) this will ensure the paths are correct while
 * accessed on development servers.
 *
 * To use this file, copy and rename it such that its path plus filename is
 * 'sites/sites.php'. If you don't need to use multi-site directory aliasing,
 * then you can safely ignore this file, and Drupal will ignore it too.
 */

/**
 * Multi-site directory aliasing
 *
 * Edit the lines below to define directory aliases. Remove the leading hash
 * signs to enable.
 */
# $sites['devexample.com'] = 'example.com';
# $sites['localhost.example'] = 'example.com';

/**
 * Note: this section should match the name aliases specified in the vhost
 * entry.
 */



//local sites
$sites['local-channelworld.gailabs.com'] = 'channelworld';
$sites['local-cio.gailabs.com'] = 'cio';
$sites['local-computerworld.gailabs.com'] = 'computerworld';
$sites['local-idgnews.gailabs.com'] = 'idgnews';
$sites['local-csoonline.gailabs.com'] = 'csoonline';
$sites['local-greenenterpriseit.gailabs.com'] = 'greenenterpriseit';
$sites['local-readybusiness.gailabs.com'] = 'readybusiness';
$sites['local-fintech.gailabs.com'] = 'fintech';
//staging sites
$sites['stage-channelworld.gailabs.com'] = 'channelworld';
$sites['stage-cio.gailabs.com'] = 'cio';
$sites['stage-computerworld.gailabs.com'] = 'computerworld';
$sites['stage-connectedenterprise.gailabs.com'] = 'connectedenterprise';
$sites['stage-csoonline.gailabs.com'] = 'csoonline';
$sites['stage-greenenterpriseit.gailabs.com'] = 'greenenterpriseit';
$sites['stage-readybusiness.gailabs.com'] = 'readybusiness';
$sites['stage-fintech.gailabs.com'] = 'fintech';

//$sites['stage-idgnews.gailabs.com'] = 'idgnews';

// //dev sites
$sites['dev-channelworld.gailabs.com'] = 'channelworld';
$sites['dev-cio.gailabs.com'] = 'cio';
$sites['dev-computerworld.gailabs.com'] = 'computerworld';
$sites['dev-connectedenterprise.gailabs.com'] = 'connectedenterprise';
$sites['dev-csoonline.gailabs.com'] = 'csoonline';
$sites['dev-greenenterpriseit.gailabs.com'] = 'greenenterpriseit';
$sites['dev-readybusiness.gailabs.com'] = 'readybusiness';

$sites['staging.idgnews.in'] = 'default';
$sites['staging.channelworld.in'] = 'channelworld';
$sites['staging.cio.in'] = 'cio';
$sites['staging.computerworld.in'] = 'computerworld';
//$sites['staging.com'] = 'connectedenterprise';
$sites['staging.csoonline.in'] = 'csoonline';
//$sites['dev-greenenterpriseit.gailabs.com'] = 'greenenterpriseit';
$sites['staging.readybusiness.gailabs.com'] = 'readybusiness';

