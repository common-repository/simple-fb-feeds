<?php
/*
Plugin Name: Simple FB Feeds
Plugin URI: https://wordpress.org/support/profile/amybeagh
Description: Simple FB Feeds - is the common way to display your facebook profile or business on your website. With our Simple FB Feeds you can do more.
Author: Amy Beagh 
Version: 1.0
Author URI: https://wordpress.org/support/profile/amybeagh
*/

class fbf_main_feeds_cl{
    
    public $options;
    
    public function __construct() {
        $this->options = get_option('fbfs_page_plugin_slider_option');
        $this->fpwfbwgt_page_slider_register_settings_all_fields();
    }
		
		public static function add_fb_page_slider_tools_options_pages(){
			add_options_page('Simple Facebook Feeds', 'Simple Facebook Feeds', 'administrator', __FILE__, array('fbf_main_feeds_cl','fpwfbwgt_page_slider_tools_option'));
		}
		
   	   public static function fpwfbwgt_page_slider_tools_option(){ ?>
            <div class="wrap">
                <div class="kgb-outer">
               
                <form method="post" action="options.php" enctype="multipart/form-data">
                    <?php settings_fields('fbfs_page_plugin_slider_option'); ?>
                    <?php do_settings_sections(__FILE__); ?>
                    <p class="submit">
                        <input name="submit" type="submit" class="fbf_but_primary" value="Save Changes"/>
                    </p>
                </form>
            </div>
           </div>
        <?php
        }
		
		
        public function fpwfbwgt_page_slider_register_settings_all_fields(){
            register_setting('fbfs_page_plugin_slider_option', 'fbfs_page_plugin_slider_option',array($this,'fbfs_page_validation_settings'));
            add_settings_section('fbfs_page_full_section', 'Simple Facebook Feeds Settings', array($this,'fbfs_page_full_section'), __FILE__);
			
            //Start Creating Fields and Options
            //fbf_url
            add_settings_field('fbf_url', 'Facebook Page URL', array($this,'pageURL_option'), __FILE__,'fbfs_page_full_section');
            //fbf_marginTop
            add_settings_field('fbf_marginTop', 'Margin Top', array($this,'marginTop_option'), __FILE__,'fbfs_page_full_section');
            
            //fbf_width
            add_settings_field('fbf_width', 'Slider Width', array($this,'width_option'), __FILE__,'fbfs_page_full_section');
            //fbf_height
            add_settings_field('fbf_height', 'Slider Height', array($this,'height_option'), __FILE__,'fbfs_page_full_section');
            
            //fbf_posts_option
            add_settings_field('fbf_posts', 'Display Posts', array($this,'posts_option'),__FILE__,'fbfs_page_full_section');
            //hide_cover_option options
            add_settings_field('hide_cover', 'Hide cover Image', array($this,'hide_cover_option'),__FILE__,'fbfs_page_full_section');
         
             //show_faces options
            add_settings_field('show_faces', 'Show Faces', array($this,'show_faces_option'),__FILE__,'fbfs_page_full_section');
            //fb_alignment option
             add_settings_field('fb_alignment', 'Slider Position', array($this,'position_option'),__FILE__,'fbfs_page_full_section');
            //jQuery options
			
			add_settings_field('fpw_status', 'Show on frontend', array($this,'fpw_status_settings'),__FILE__,'fbfs_page_full_section');
            
        }
        public function fbfs_page_validation_settings($plugin_options){
            return($plugin_options);
        }
        public function fbfs_page_full_section(){
            //optional
        }
       
        //fbf_url_option
        public function pageURL_option() {
            if(empty($this->options['fbf_url'])) $this->options['fbf_url'] = "https://www.facebook.com/facebook";
            echo "<input name='fbfs_page_plugin_slider_option[fbf_url]' type='text' value='{$this->options['fbf_url']}' />";
        }
         //marginTop_option
        public function marginTop_option() {
            if(empty($this->options['fbf_marginTop'])) $this->options['fbf_marginTop'] = "110";
            echo "<input name='fbfs_page_plugin_slider_option[fbf_marginTop]' type='text' value='{$this->options['fbf_marginTop']}' />";
        }
            //fb_alignment_settings
        public function position_option(){
            if(empty($this->options['fb_alignment'])) $this->options['fb_alignment'] = "left";
            $items = array('left','right');
            foreach($items as $item){
                $selected = ($this->options['fb_alignment'] === $item) ? 'checked = "checked"' : '';
				echo "<input type='radio' name='fbfs_page_plugin_slider_option[fb_alignment]' value='$item' $selected> ".ucfirst($item)."&nbsp;";
            }
        }
      
        //fbf_width_option
        public function width_option() {
            if(empty($this->options['fbf_width'])) $this->options['fbf_width'] = "290";
            echo "<input name='fbfs_page_plugin_slider_option[fbf_width]' type='text' value='{$this->options['fbf_width']}' />";
        }
        //height_option
        public function height_option() {
            if(empty($this->options['fbf_height'])) $this->options['fbf_height'] = "390";
            echo "<input name='fbfs_page_plugin_slider_option[fbf_height]' type='text' value='{$this->options['fbf_height']}' />";
        }
        //show_faces_option
        public function show_faces_option(){
            if(empty($this->options['show_faces'])) $this->options['show_faces'] = "true";
            $items = array('true','false');
            foreach($items as $item){
                $selected = ($this->options['show_faces'] === $item) ? 'checked = "checked"' : '';
				echo "<input type='radio' name='fbfs_page_plugin_slider_option[show_faces]' value='$item' $selected> ".ucfirst($item)."&nbsp;";
            }
        }
        //fbf_posts_option
        public function posts_option(){
            if(empty($this->options['fbf_posts'])) $this->options['fbf_posts'] = "true";
            $items = array('true','false');
            foreach($items as $item){
                $selected = ($this->options['fbf_posts'] === $item) ? 'checked = "checked"' : '';
				echo "<input type='radio' name='fbfs_page_plugin_slider_option[fbf_posts]' value='$item' $selected> ".ucfirst($item)."&nbsp;";
            }
        }
       
        //hide_cover_option
        public function hide_cover_option(){
            if(empty($this->options['hide_cover'])) $this->options['hide_cover'] = "false";
            $items = array('false','true');
            foreach($items as $item){
                $selected = ($this->options['hide_cover'] === $item) ? 'checked = "checked"' : '';
                echo "<input type='radio' name='fbfs_page_plugin_slider_option[hide_cover]' value='$item' $selected> ".ucfirst($item)."&nbsp;";
				
            }
        }
        
       
	   //disabled_settings
		public function fpw_status_settings(){
			if(empty($this->options['fpw_status'])) $this->options['fpw_status'] = "on";
			$items = array('on','off');
			
		   foreach($items as $item){
				$selected = ($this->options['fpw_status'] === $item) ? 'checked = "checked"' : '';
				echo "<input type='radio' name='fbfs_page_plugin_slider_option[fpw_status]' value='$item' $selected> ".ucfirst($item)."&nbsp;";
			}
			
		}
    
        // put jQuery settings before here
    }
    add_action('admin_menu', 'fbfs_page_slider_trigger_options_function');
    
    function fbfs_page_slider_trigger_options_function(){
        fbf_main_feeds_cl::add_fb_page_slider_tools_options_pages();
    }
    
    add_action('admin_init','fbfs_page_slider_trigger_create_object');
    function fbfs_page_slider_trigger_create_object(){
        new fbf_main_feeds_cl();
    }
	
    add_action('wp_footer','fbfs_page_slider_add_content_in_footer');
    function fbfs_page_slider_add_content_in_footer(){
        
    $options1 = get_option('fbfs_page_plugin_slider_option');
    extract($options1);
    
    $fbf_facebook_page_out = '';
    $fbf_facebook_page_out .= 
    '<div class="fb-page" data-href="'.$fbf_url.'" data-width="'.$fbf_width.'" data-height="'.$fbf_height.'" 
    data-hide-cover="'.$hide_cover.'" 
    data-show-facepile="'.$show_faces.'" 
    data-show-posts="'.$fbf_posts.'">
    </div>';
    $fb_imgURL = plugins_url('assets/fb-img_new.png', __FILE__);
    if($fpw_status == 'on'):
    ?>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=262562957268319";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        
        
        <?php if($fb_alignment=='left'){?>
        <div id="real_facebook_display">
            <div id="fsbbox1" class="fb_area_left"><a class="open" id="fbf_link" href="javascript:;"><img class="outer" style="right: -46px;top: 0;" src="<?php echo $fb_imgURL;?>" alt=""></a>
                <div id="fsbbox2" class="fb_inner_area_left">
                <?php echo $fbf_facebook_page_out; ?>
                </div>
            </div>
        </div>
        

		<style type="text/css">
        
        div.fb_area_left{
        
            left: -<?php echo trim($fbf_width+10);?>px;         
            top: <?php echo $fbf_marginTop;?>px;         
            z-index: 10000;         
            height:<?php echo trim($fbf_height+30);?>px;        
            -webkit-transition: all .5s ease-in-out;        
            -moz-transition: all .5s ease-in-out;        
            -o-transition: all .5s ease-in-out;        
            transition: all .5s ease-in-out;        
            }
        
        div.fb_area_left.fb_show{        
            left:0;}	
        
        div.fb_inner_area_left{        
            text-align: left;        
            width:<?php echo trim($fbf_width);?>px;        
            height:<?php echo trim($fbf_height);?>px;        
            }
        
        
        </style>
        
        
        <?php } else { ?>
        <div id="real_facebook_display">
            <div id="fsbbox1" class="fb_area_right">
                        <a class="open" id="fbf_link" href="javascript:;"><img class="outer" style="top: 0px;left:-46px;" src="<?php echo $fb_imgURL;?>" alt=""></a>
            <div id="fsbbox2" class="fb_inner_area_right">
                    <?php echo $fbf_facebook_page_out; ?>
                    
                </div>
              
            </div>
        </div>
        
        
        <style type="text/css">
        
        div.fb_area_right{        
            right: -<?php echo trim($fbf_width+10);?>px;        
            top: <?php echo $fbf_marginTop;?>px;        
            z-index: 10000;         
            height:<?php echo trim($fbf_height+30);?>px;        
            -webkit-transition: all .5s ease-in-out;        
            -moz-transition: all .5s ease-in-out;        
            -o-transition: all .5s ease-in-out;        
            transition: all .5s ease-in-out;        
            }
        
        div.fb_area_right.fb_show{        
            right:0;        
            }	
        
        div.fb_inner_area_right{        
            text-align: left;        
            width:<?php echo trim($fbf_width);?>px;        
            height:<?php echo trim($fbf_height);?>px;        
            }
        
        div.fb_area_right .contacticonlink {        
            left: -32px;        
            text-align: left;        
        }		
        
        </style>
		<?php } ?>
        <script type="text/javascript">
        
        jQuery(document).ready(function() {
            jQuery('#fbf_link').click(function(){
                jQuery(this).parent().toggleClass('fb_show');
        
        });});
        </script>
        
        <?php
		endif;
        }	
		
	add_action( 'wp_enqueue_scripts', 'fbf_register_page_slider_style' );
	 function fbf_register_page_slider_style() {
		wp_register_style( 'fbf_register_page_slider_style', plugins_url( 'assets/fpwfbwgt_style.css' , __FILE__ ) );
		wp_enqueue_style( 'fbf_register_page_slider_style' );
	 }
	 
	add_action( 'admin_enqueue_scripts', 'fpf_register_add_csss' );

	function fpf_register_add_csss() {
		wp_register_style( 'fpw_add_css', plugins_url( 'assets/fb_feedscss.css' , __FILE__ ) );
		wp_enqueue_style( 'fpw_add_css' );
	}  
	
	
	/* shortcode start */
	
    add_shortcode('fbf-profile-feeds-display','fpwfbwgt_widget_shortcode');
        function fpwfbwgt_widget_shortcode(){
        
        $options = get_option('fbfs_page_plugin_slider_option');
        extract($options);
    
		$shotcode_facebook_output = '';
		$shotcode_facebook_output .= 
		'<div class="fb-page" data-href="'.$fbf_url.'" 
		data-width="'.$fbf_width.'" data-height="'.$fbf_height.'" 
		data-hide-cover="'.$hide_cover.'" 
		data-show-facepile="'.$show_faces.'" 
		data-show-posts="'.$fbf_posts.'">
		</div>';
    	?>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=262562957268319";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        
        <?php
		
       	 	return '<div id="facebook-page-shortcode">'.$shotcode_facebook_output.'</div>';
        }
		
	/* end shorcode */     