<?php namespace ProcessWire;

/**
 * Admin template just loads the admin application controller,
 * and admin is just an application built on top of ProcessWire.
 *
 * This demonstrates how you can use ProcessWire as a front-end
 * to another application.
 *
 * Feel free to hook admin-specific functionality from this file,
 * but remember to leave the require() statement below at the end.
 *
 */

// custom options page
if( page()->name == 'admin_options' ) input()->get->id = pages()->get('options')->id;
// custom blog page
if( page()->name == 'admin_blog' ) input()->get->id = pages()->get('template=blog-posts')->id;
// require admin templates
require($config->paths->adminTemplates . 'controller.php');
