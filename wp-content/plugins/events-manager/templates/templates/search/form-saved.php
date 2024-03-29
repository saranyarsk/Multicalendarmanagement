<?php
/* @var array $args */
$id =  esc_attr( $args['id'] );
$action_url = '#';
?>
<button type="button" class="em-tooltip-ddm em-clickable input button-secondary" style="background-color : white !important; width : 70px !important; padding: 0 35px 0 10px !important; background-position: calc(100% - 10px) 50% !important;">
    <svg height="25px" width="25px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
         viewBox="0 0 279.851 279.851" xml:space="preserve" style="margin-bottom : -7px;">
<g>
    <path style="fill:#E2574C;" d="M255.361,41.839c-41.444-41.453-82.538-23.339-115.433,6.23
		C107.016,18.5,66.264,0.062,24.487,41.839c-32.571,32.553-32.728,84.866,0,117.244C139.57,262.605,139.543,262.421,139.543,262.421
		s0.166,0.341,115.809-103.339C288.098,126.704,287.932,74.392,255.361,41.839z"/>
    <path style="fill:#CB4E44;" d="M139.92,48.06l-0.079-0.061v214.168c1.846-1.558,15.419-13.345,115.511-103.094
		c32.737-32.369,32.579-84.682,0-117.235C213.908,0.386,172.823,18.5,139.92,48.06z"/>
</g>
</svg>
</button>
<div class="em-tooltip-ddm-content">
    <a class="em-a2c-download" href="<?php echo $action_url; ?>&what=invoice" target="_blank"><?php echo esc_html__('Download (PDF)', 'events-manager-pro'); ?></a>
    <a class="em-a2c-download" href="<?php echo $action_url; ?>&what=invoice&html=1" target="_blank"><?php echo esc_html__('View HTML', 'events-manager-pro'); ?></a>
</div>