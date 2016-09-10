<?php
/*
Plugin Name: Henry's Date Field
Plugin URI:  https://github.com/anraiki
Description: A simple datefield form that can be easily formatted.
Version:     1.0
Author:      Henry Tran
Author URI:  http://anraiki.com
Text Domain: henry-datefield
*/
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

class HenryDateField extends WP_Widget {

  function __construct() {
    parent::__construct(false, "Henry's Datefield");
  }

  function widget($args, $instance) {
    echo '<input type="text" id="henry-datepicker">';
    echo '
      <script type="text/javascript">
      jQuery(document).ready(function(){
          jQuery( "#henry-datepicker" ).datepicker( {dateFormat : "'.$instance["format"].'"} );
      });
      </script>
    ';
  }

  function form($instance) {
    $format = array(
      "mm/dd/yy",
      "yy-mm-dd",
      "d M, y",
      "d MM, y",
      "DD, d MM, yy"
    );

    $instance['format'] = (!empty($instance['format'])) ? $instance['format'] : 'mm/dd/yy';

    foreach($format as $value) {
      if($value == $instance["format"])
        $options .= "<option selected value='".$value."'>".$value."</option>";
      else
        $options .= "<option value='".$value."'>".$value."</option>";
    }

    echo '
      <label for="'.esc_attr($this->get_field_id('format')).'">Date format options:</label>
        <select
          id="'.esc_attr($this->get_field_id('format')).'"
          name="'.esc_attr($this->get_field_name('format')).'">
            '.$options.'
        </select>
      </p>
    ';
  }

  function update($new_instance, $old_instance) {
    $instance = array();
    $instance['format'] = (!empty( $new_instance["format"])) ?  $new_instance['format'] : 'yy-mm-dd';
    return $instance;
  }

}

function register_henry_widget() {
	register_widget( 'HenryDateField' );
}

add_action( 'widgets_init', 'register_henry_widget' );


?>
