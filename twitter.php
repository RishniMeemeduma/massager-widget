<?php
//error_reporting(E_ALL);
/*Plugin Name:Twitter
Plugin URI:http://www.wordpress.ibase_commit
Description:testing Shortcode
Author:Rishni Meemeduma
Author URI:http://www.ris.tt
version:1.0
*/
class RM_Twitter_Widget extends WP_Widget{
  function __construct(){
    $param = array
    ('description' =>'Display the cache tweets' ,
      'name' =>'Display tweets' );
      parent::__construct('RM_Twitter_Widget','',$param);

  }

  public function form($instance){
    extract($instance);
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title');?>">Title:</label>
      <input
      class="widefat"
      id="<?php echo $this->get_field_id('title');?>"
      name="<?php echo $this->get_field_name('title');?>"
      value="<?php if(isset($title)) echo esc_attr($title);?>"
      />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('username');?>">Username:</label>
      <input
      class="widefat"
      id="<?php echo $this->get_field_id('username');?>"
      name="<?php echo $this->get_field_name('username');?>"
      value="<?php if(isset($username)) echo esc_attr($username);?>"
      />
    </p>
    <p>
      <label type="number" for="<?php echo $this->get_field_id('tweet_count');?>">Number of Tweet to Retreve:</label>
      <input
      class="widefat"
      style="width:40px"
      id="<?php echo $this->get_field_id('tweet_count');?>"
      name="<?php echo $this->get_field_name('tweet_count');?>"
      min="1"
      max="10"
      value="<?php echo !empty($tweet_count)? $tweet_count:5;?>"

      />
    </p>
    <?php
  }
  public function widget($args,$instance){
    print_r($instance);die();
    extract($args);
    extract($instance);

    if(empty($title)) $title='Recent Tweets';
    $data= $this->twitter($tweet_count,$username);


  }
  public function tweet_count(){
    if(empty($username)) return false;
  }
  public function fetch_tweets($tweet_count,$username){
    $tweets=wp_remote_get("http://twitter.com/statuses/user_timeline/$username.json");
    $tweets= json_decode($tweets['body']);

    if(isset($tweets->error))return false;
    foreach ($tweets as $tweet) {
      if($tweet_count--===0)break;
      echo $tweet->text;
    }

  }
}
add_action('widgets_init','rm_register_twitter');
function rm_register_twitter(){
  register_widget('RM_Twitter_Widget');
}
