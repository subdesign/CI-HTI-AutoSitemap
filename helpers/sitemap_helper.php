<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  Helper function for sitemap generator library
 */

function rewrite_sitemap()
{
	$ci =& get_instance();
	$ci->load->library('sitemaprunner');
	$ci->sitemaprunner->run();
}