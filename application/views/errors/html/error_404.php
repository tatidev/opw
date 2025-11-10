<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
if( ! isset($CI))
{
    $CI = new CI_Controller();
}
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body style="margin: 0; font-family: 'Karla', sans-serif; font-size: 12px; min-height: 100%; background-color: #423c38;">
	<div style="width: 980px; margin-left: auto; margin-right: auto; background-color: #423c38; ">
		<div style="border-bottom: solid 1px #bfac02; width: 980px; position: fixed;z-index: 990;">
			<div style="background-color: #423c38; min-height: 80px; width: 100%; position: relative;">
				<a href='<?=base_url('home/1')?>'>
					<img src="<?=asset_url()?>images/opuzen_logo_background-color.jpg" style="width: 293px;height: auto;margin: 14px 0 0 20px; cursor: pointer;" >
				</a>
			</div>
		</div>
		<div style="padding-top: 111px;">
			<div style="clear: both; width: 100%; background-color: #423c38;">
				<div style="    width: 100%; overflow: hidden; margin-bottom: 6px;">
					<div style="margin-top: 18%; margin-bottom: 7%;">
						<div style=" min-height: 250px; font-weight: normal; line-height: 18px; color: white; text-align: justify; text-justify: inter-word; letter-spacing: 1px;">
								<div style="text-align: center; font-size: 25px; margin-top: -30px;">Oops.... Page not found</div>
								<div style="text-align: center; width: 60%; margin-top: 30px; margin-right: auto; margin-left: auto;">We are sorry for any inconvenience this might cause you, please go back to the home page to keep browsing our site. We hope you find what you were looking for.</div>
								<div style="text-align: center; margin-top: 30px;"><a href='<?=base_url('home/1')?>' style="padding: 10px 20px; background-color: #bfac02; color: #fff; text-decoration: none;">GO BACK</a></div>
						</div>
					</div>
				</div>
			</div>
			<div style="clear: both; width: 100%; background-color: #bfac02; color: #fff; text-align: center; font-size: 9px; padding: 5px 0;">&copy; <? echo date('Y'); ?> OPUZEN ALL RIGHTS RESERVED.</div>
		</div>
	</div>	
</body>
</html>