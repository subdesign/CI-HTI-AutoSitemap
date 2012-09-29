<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  Example 'helper' library to compile content (urls) for sitemap
 *  You have to modify the queries adjusted to you DB,
 */

class Sitemaprunner 
{
	private $_ci;

	public function __construct()
	{
		$this->_ci =& get_instance();		
		$this->_ci->load->library('sitemaps');
	}

    public function run()
    {
        $this->_ci->load->model('news_m');
        
        /* NEWS */

        $posts = $this->_ci->db->select('slug, modify_date')->get_where('news', array('status' => 'active'))->result();

        foreach($posts AS $post)
        {
            $item = array(
                "loc"        => site_url('article/' . $post->slug),                
                "lastmod"    => date("c", strtotime($post->modify_date)),
                "changefreq" => "hourly",
                "priority"   => "0.8"
            );
            
            $this->_ci->sitemaps->add_item($item);
        }

        /* STATIC PAGES */    

        $result = $this->_ci->db->select('location')->get_where('pages', array('status' => 'active'))->order_by('order', 'ASC')->result();
        
        foreach($result as $r)
        {
            $item = array(
                'loc'        => site_url($r->location),
                'lastmod'    => '',
                'changefreq' => 'never',
                'priority'   => ''
            ); 

            $this->_ci->sitemaps->add_item($item);
        }

        /* EVENTS */

        if(can_do_feature('events'))
        {

            $this->_ci->load->model('event_m');

            $events = $this->_ci->db->select('date')->get_where('events', array('status' => 'active'))->result();

            foreach($events as $e)
            {
                $item = array(
                    'loc'        => site_url('events/'.$e->date),
                    'lastmod'    => '',
                    'changefreq' => 'never',
                    'priority'   => ''
                );

                $this->_ci->sitemaps->add_item($item);       
            }
        }

        /* GALLERIES */

        if(can_do_feature('gallery'))
        {
            $this->_ci->load->model('gallery_m');

            $galleries = $this->_ci->db->select('folder_name')->get_where('galleries', array('status' => 'active'))->result();

            foreach($galleries as $g)
            {
                $item = array(
                    'loc' => site_url('gallery/'.$g->folder_name),
                    'lastmod' => '',
                    'changefreq' => 'never',
                    'priority' => ''
                );

                $this->_ci->sitemaps->add_item($item);       
            }
        }
        
        $file_name = $this->_ci->sitemaps->build("./sitemap.xml");

        $reponses = $this->_ci->sitemaps->ping(site_url($file_name));
        
        // Debug by printing out the requests and status code responses
        log_message('debug', $reponses);
    }
}