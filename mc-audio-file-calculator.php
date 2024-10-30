<?php
/*Plugin Name: MC Audio File Calculator
Plugin URI: https://Mid-Coast.com/audio-file-calculator
Description: Creates audio file size calculators on your website, both MP3 and WAV files.
Version: 2.1
Author: Mike Hickcox
Author URI: https://Mid-Coast.com
License: GPLv2 or later license
URI: https://www.gnu.org/licenses/gpl-2.0.html


    Copyright (C)2020  Mike Hickcox
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program. If not, see https://www.gnu.org/licenses.

*/
	if ( ! defined( 'ABSPATH' ) ) exit;

	// INCLUDE NEEDED FILE
     include 'inc/mcafc_options.php';


	// LOAD BOOTSTRAP CSS
	function mc6397mp3_enqueue_style() {
    wp_enqueue_style( 'mc6397afc-style', plugin_dir_url( __FILE__ )."css/bootstrap.css" );
}
	add_action( 'wp_enqueue_scripts', 'mc6397mp3_enqueue_style' );


	// MP3 FILE CALCULATOR

	function mc6397afcmp3($atts) {

	if (isset($_POST["mp3Time"])) {
    $mcafc_mp3time = intval($_POST["mp3Time"]);
    $mcafc_mp3bitRate = intval($_POST["bitRate"]);
    $mcafc_mp3result =((60 * $mcafc_mp3bitRate) * $mcafc_mp3time) / 8192 ;
    $mcafc_mp3result2 = number_format($mcafc_mp3result,2);
}

	$mc6397_MP3desc=get_option('mc6397afc_MP3');
	$mc6397mp3_text=get_option('mc6397afc_tSize');
	$mc6397_btn=get_option('mc6397afc_btn');

	ob_start();

?>

	<!doctype html>
	<html lang="en">
	<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	</head>

	<body>
	<form action="" method=POST>

	<form>
	<div class="col-9" style="font-size: <?php echo $mc6397mp3_text ?>px;">
	<?php if ($mc6397_MP3desc !== "No" )  {
	echo  "<strong>MP3 File Size Calculator</strong> <br><br> Enter the Running Time and select the Bit Rate. The file will be the same size whether it is stereo or mono. <br><br>";
}
	?>
	</div>

	<div class="form-group row" style="font-size: <?php echo $mc6397mp3_text ?>px;>
    <label for="time" class="col-5 col-form-label" ">Enter the Time in Minutes:</label> <br>
    <div class="col-3" <?php echo $mc6397mp3_text ?>px;">
      <input id="time" name="mp3Time" type="number" min="1" max="999" step="1" required="required">
    </div>
  </div>

  <div class="form-group row" style="font-size: <?php echo $mc6397mp3_text ?>px;">
    <label for="bitRate" class="col-5 col-form-label" style="font-size: <?php echo $mc6397mp3_text ?>px;">Select the Bit Rate</label> <br>
    <div class="col-3" >
      <select id="bitRate" name="bitRate" required="required">
        <option value="32">32</option>
        <option value="40">40</option>
        <option value="48">48</option>
        <option value="56">56</option>
        <option value="64">64</option>
        <option value="80">80</option>
        <option selected="selected" value="96">96</option>
        <option value="112">112</option>
        <option value="128">128</option>
        <option value="160">160</option>
        <option value="192">192</option>
        <option value="256">256</option>
        <option value="320">320</option>
      </select>
    </div>
  </div> 
  <div class="form-group row">
    <div class="center-block">
      <button name="submit" type="submit" class="btn btn<?php echo $mc6397_btn ?> btn-lg">Calculate File Size</button>
    </div>
  </div>
	</form>
	
	<p class="mp3result" style="font-size: <?php echo $mc6397mp3_text ?>px;">  <i class="fa fa-play"></i>
	<strong> <?php if (isset($mcafc_mp3result)) {echo $mcafc_mp3result2; echo " MB"; } ?> </strong>
	</p>
	
	</body>
	</html>

	<?php
	return ob_get_clean();
}

	add_shortcode('mcafc-mp3', 'mc6397afcmp3');


	// WAV FILE CALCULATOR

	function mc6397afcwav($atts) {
	if (isset($_POST["wavTime"])) {
    $mcafc_wavTime = intval($_POST["wavTime"]);
    $mcafc_wavChannels = intval($_POST["wavChannels"]);
    $mcafc_wavRate = intval($_POST["wavRate"]);
    $mcafc_wavBitDepth = intval($_POST["wavBitDepth"]);
    $mcafc_wavResult = (($mcafc_wavTime)*($mcafc_wavChannels)*($mcafc_wavRate)*($mcafc_wavBitDepth))/136.5333 ;  
    $mcafc_wavResult2 = number_format($mcafc_wavResult,2);
}

	$mc6397_WAVdesc=get_option('mc6397afc_WAV');
	$mc6397wav_text=get_option('mc6397afc_tSize');
	$mc6397_btn=get_option('mc6397afc_btn');

	ob_start();
?>

	<!doctype html>
	<html lang="en">
	<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>

	<body>
	<form action="" method=POST>
	<form>

	<div class="col-9" style="font-size: <?php echo $mc6397wav_text ?>px;">
	<?php if ($mc6397_WAVdesc !== "No" )  {
	echo  "<strong>WAV File Size Calculator</strong> <br><br> Enter the Running Time anc choose your own Channels, Sample Rate, and Bit Depth. The default settings are for CD level files.<br><br>";
}
 ?>
	</div>

	<div class="form-group row" style="font-size: <?php echo $mc6397wav_text ?>px;>
    <label for="time" class="col-4 col-form-label" ">Enter the Time in Minutes:</label> <br>
    <div class="col-3" <?php echo $mc6397wav_text ?>px;">
      <input id="time" name="wavTime" type="number" min="1" max="999" step="1" required="required">
    </div>
  </div>

    <div class="form-group row" style="font-size: <?php echo $mc6397wav_text ?>px;">
    <label class="col-4 col-form-label" style="font-size: <?php echo $mc6397wav_text ?>px;">Channels</label> 
    <div class="col-8">
      <div class="custom-controls-stacked">
        <div class="custom-control custom-radio">
          <input checked name="wavChannels" id="channels_0" type="radio" class="custom-control-input" value="2"> 
          <label for="channels_0" class="custom-control-label">Stereo</label>
        </div>
      </div>
      <div class="custom-controls-stacked">
        <div class="custom-control custom-radio">
          <input name="wavChannels" id="channels_1" type="radio" class="custom-control-input" value="1" required="required"> 
          <label for="channels_1" class="custom-control-label">Mono</label>
        </div>
      </div>
    </div>
  </div> 

  <div class="form-group row" style="font-size: <?php echo $mc6397wav_text ?>px;">
    <label class="col-4 col-form-label" style="font-size: <?php echo $mc6397wav_text ?>px;">Sample Rate (KHz)</label> 
    <div class="col-8">
      <div class="custom-controls-stacked">
        <div class="custom-control custom-radio">
          <input name="wavRate" id="rate_0" type="radio" class="custom-control-input" value="32"> 
          <label for="rate_0" class="custom-control-label">32</label>
        </div>
      </div>
      <div class="custom-controls-stacked">
        <div class="custom-control custom-radio">
          <input checked name="wavRate" id="rate_1" type="radio" class="custom-control-input" value="44.1"> 
          <label for="rate_1" class="custom-control-label">44.1 (CD)</label>
        </div>
      </div>
      <div class="custom-controls-stacked">
        <div class="custom-control custom-radio">
          <input name="wavRate" id="rate_2" type="radio" class="custom-control-input" value="48"> 
          <label for="rate_2" class="custom-control-label">48 (DAT)</label>
        </div>
      </div>
      <div class="custom-controls-stacked">
        <div class="custom-control custom-radio">
          <input name="wavRate" id="rate_3" type="radio" class="custom-control-input" value="96"> 
          <label for="rate_3" class="custom-control-label">96</label>
        </div>
      </div>
      <div class="custom-controls-stacked">
        <div class="custom-control custom-radio">
          <input name="wavRate" id="rate_4" type="radio" class="custom-control-input" value="192" required="required"> 
          <label for="rate_4" class="custom-control-label">192</label>
        </div>
      </div>
    </div>
  </div> 

  <div class="form-group row" style="font-size: <?php echo $mc6397wav_text ?>px;">
    <label class="col-4 col-form-label" style="font-size: <?php echo $mc6397wav_text ?>px;">Bit Depth</label> 
    <div class="col-8">
      <div class="custom-controls-stacked">
        <div class="custom-control custom-radio">
          <input checked name="wavBitDepth" id="bitDepth_0" type="radio" class="custom-control-input" value="16"> 
          <label for="bitDepth_0" class="custom-control-label" >16-bit (CD)</label>
        </div>
      </div>
      <div class="custom-controls-stacked">
        <div class="custom-control custom-radio">
          <input name="wavBitDepth" id="bitDepth_1" type="radio" class="custom-control-input" value="24" required="required"> 
          <label for="bitDepth_1" class="custom-control-label">24-bit</label>
        </div>
      </div>
    </div>
  </div> 

  <div class="form-group row">
    <div class="center-block">
      <button name="submit" type="submit" class="btn btn<?php echo $mc6397_btn ?> btn-lg">Calculate File Size</button>
    </div>
  </div>

	</form>
	<p class="wavResult" style="font-size: <?php echo $mc6397wav_text ?>px;"> <i class="fa fa-play"></i>
	<strong> <?php if (isset($mcafc_wavResult)) {echo $mcafc_wavResult2; echo " MB"; } ?> </strong>
	</p>

	</body>
	</html>

	<?php

	return ob_get_clean();
}

	add_shortcode('mcafc-wav', 'mc6397afcwav');


	// ADD SETTINGS LINK ON PLUGINS PAGE
	function mc6397afc_link($links) { 
		$settings_link = '<a href="options-general.php?page=mc6397afc">Settings</a>'; 
		array_unshift($links, $settings_link); 
		return $links; 
}
	$plugin = plugin_basename(__FILE__); 
	add_filter("plugin_action_links_$plugin", 'mc6397afc_link' );
