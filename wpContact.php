<?php
/*
Plugin Name: wpContact
Plugin URI: https://github.com/maxvgc/WpPgpContactForm
Version: 1.0
Description: A Wordpress widget that sends PGP messages via ajax.
Author: Max Galloway-Carson
Author URI: http://maxvgc.com

Copyright (C) 2012 Max Galloway-Carson maxvgc@gmail.com

This file is part of WpPgpContactForm.

WpPgpContactForm is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/
 
class Contact_Widget extends WP_Widget
{
  function Contact_Widget()
  {
    $widget_ops = array('classname' => 'Contact_Widget', 
    'description' => 'openpgp contact form');
    $this->WP_Widget('Contact_Widget', 'Contact Me', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args((array) $instance, array( 'title' => '' ));
    $title = $instance['title'];
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;
$urlHere = plugins_url(null, __FILE__);
$formPath = plugin_dir_path(__FILE__).'/form.php';

require_once($formPath);
printTheForm($urlHere);

    echo $after_widget;
  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("Contact_Widget");') );
 
?>