<?php
class ControllerExtensionTltBlogTltBlogMenu extends Controller {
	public function index() {
		$this->load->language('extension/tltblog/tltblog_menu');
		
		$this->load->model('extension/tltblog/tltblog');
		$this->load->model('setting/setting');
		
		$data['tltblog_menu'] = array();
		$data['tltblog_menu']['enabled'] = false;
		
		if ($this->config->has('tltblog_menu')) {			
			if ($this->config->get('tltblog_menu')) {
				$data['tltblog_menu']['enabled'] = true;
				
				if ($this->config->get('tltblog_seo')) {
					require_once(DIR_APPLICATION . 'controller/extension/tltblog/tltblog_seo.php');
					$tltblog_seo = new ControllerExtensionTltBlogTltBlogSeo($this->registry);
					$this->url->addRewrite($tltblog_seo);
				}

				if ($this->config->has('tltblog_path')) {
					$path_array = $this->config->get('tltblog_path');

					if (isset($path_array[$this->config->get('config_language_id')])) {
					    $path = $this->config->get('config_language_id');
                    }
				} else {
					$path = 'blogs';
				}
				
				if ($this->config->has('tltblog_path_title')) {
					$tmp_title = $this->config->get('tltblog_path_title');
					$data['tltblog_menu']['blog_title'] = $tmp_title[$this->config->get('config_language_id')]['path_title'];
				} else {
					$data['tltblog_menu']['blog_title'] = $this->language->get('text_title');
				}
				
				$data['tltblog_menu']['blog_href'] = $this->url->link('extension/tltblog/tlttag', 'tltpath=' . $path);
				$data['tltblog_menu']['tags'] = array();
				
				$tags = $this->model_extension_tltblog_tltblog->getTltTags();
		
				foreach ($tags as $tag) {
					if ($tag['show_in_sitemap']) {
						$data['tltblog_menu']['tags'][] = array(
							'tlttag_id'  => $tag['tlttag_id'],
							'title' => $tag['title'],
							'href' => $this->url->link('extension/tltblog/tlttag', 'tltpath=' . $path . '&tlttag_id=' . $tag['tlttag_id'])
						);
					}
				}
			}
		}
		
		return $this->load->view('extension/tltblog/tltblog_menu', $data);		
	}
}