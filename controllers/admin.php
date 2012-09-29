<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  Example controller for sitemap generator
 */

class Admin extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('sitemap');
	}
	
	/**
	 * Example fictional method for saving news data
	 * @return void 
	 */
	public function save_news()
	{
		$newsdata = $this->input->post('newsdata', TRUE)

		// if the save was successful..
		if($this->news_model->save($newsdata))
		{
			rewrite_sitemap(); // rewriting the sitemap file
			$this->session->set_flashdata('success', 'News article successfully saved');
			redirect('admin/news');
		}
		// if something went wrong..
		else
		{
			$this->session->set_flashdata('error', 'Erros saving news article');
			redirect('admin/news');
		}
	}	

}