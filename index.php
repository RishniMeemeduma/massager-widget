<?php
//error_reporting(E_ALL);
/*Plugin Name:Messager
Plugin URI:http://www.wordpress.ibase_commit
Description:testing Shortcode
Author:Rishni Meemeduma
Author URI:http://www.ris.tt
version:1.0
*/
class Messager extends WP_Widget{
function __construct(){
  $param = array(
    'description'=>'This is a testing messager widget',
    'name'=>'Messager'
  );
  parent::__construct('Messager','',$param);

}
public function  form($instance){
//  print_r($instance);
  extract($instance);
  ?>
  <p>
    <label for="<?php echo $this->get_field_id('title');?>">Title</label>
    <input
    class="widefat"
    id="<?php echo $this->get_field_id('title');?>"
    name="<?php echo $this->get_field_name('title');?>"
    value="<?php if(isset($title)) echo esc_attr($title);?>"
    />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('description')?>">Description</label>
    <textarea
    class="widefat"
    id="<?php echo $this->get_field_id('description');?>"
    rows="10"
    name="<?php echo $this->get_field_name('description');?>"><?php if(isset($description)) echo esc_attr($description); ?>
    </textarea>
  </p>
  <?php

}
public function widget($args,$instance){
extract($args);
extract($instance);
$title=apply_filters('widget_title',$title);
$description=apply_filters('widget_description',$description);

if(empty($title)) $title="My First widget";

echo $before_widget;
  echo $before_title.$title.$after_title;
  echo  "<p>$description</p>";
  echo $after_widget;

}
}
add_action('widgets_init','jw_register_messager');
function jw_register_messager(){
  register_widget('Messager');
}
