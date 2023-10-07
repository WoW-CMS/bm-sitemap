<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_module_installed('sitemap', true);

        $this->load->model([
            'sitemap_model',
        ]);

        $this->load->language('sitemap');
    }

    public function index()
    {
        $data =  [
            'total_sitemaps' => $this->sitemap_model->count_all(),
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('admin', $data);
    }

    public function manage()
    {
        $data = [
            'sitemap' => $this->sitemap_model->find_all(),
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('manage', $data);
    }

    public function add()
    {
        require_permission('add.sitemap');
    
        $data = [
            'priorityOptions' => $this->sitemap_model->getPriorityOptions(),
        ];
    
        $this->template->title(lang('admin_panel'), config_item('app_name'));
    
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('name', lang('name'), 'trim|required');
            $this->form_validation->set_rules('url', lang('url'), 'trim|required|callback_validate_url|is_unique[sitemap_links.url]');
            $this->form_validation->set_rules('select_priority', lang('priority'), 'trim|required|in_list[1.0,0.9,0.8,0.7,0.6]'); // Ajusta las opciones según tus necesidades
    
            if ($this->form_validation->run()) {
                $priority = $this->input->post('select_priority'); 
                
                $this->sitemap_model->insert([
                    'module'   => $this->input->post('name'),
                    'url'   => strtolower($this->input->post('url')),
                    'priority'   => $priority,
                ]);
    
                $sitemapId = $this->db->insert_id();
    
                $this->log_model->create('sitemap links', 'add', 'Added a Sitemap URL', [
                    'sitemap' => $this->input->post('name')
                ], 'sitemap/admin/edit/' . $sitemapId);
    
                $this->generate();
            
                $this->session->set_flashdata('success', lang('alert_sitemap_added'));
                redirect(site_url('sitemap/admin/manage'));
            } else {
                $this->template->build('add', $data);
            }
        } else {
            $this->template->build('add', $data);
        }
    }

    public function edit($sitemapId = null)
    {
        require_permission('edit.sitemap');

        $sitemap = $this->sitemap_model->find(['id' => $sitemapId]);

        if (empty($sitemap)) {
            show_404();
        }

        $data = [
            'priorityOptions' => $this->sitemap_model->getPriorityOptions(),
            'sitemap' => $sitemap,
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('name', lang('name'), 'trim|required');
        $this->form_validation->set_rules('url', lang('url'), 'trim|required|callback_validate_url');
        $this->form_validation->set_rules('select_priority', lang('priority'), 'trim|required|in_list[1.0,0.9,0.8,0.7,0.6]'); // Ajusta las opciones según tus necesidades
    
        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $set = [
                'module'   => $this->input->post('name'),
                'url'   => strtolower($this->input->post('url')),
                'priority' => $this->input->post('select_priority')
            ];

            $this->sitemap_model->update($set, ['id' => $sitemapId]);

            $this->log_model->create('sitemap links', 'edit', 'Edited a Sitemap', [
                'sitemap' => $this->input->post('name')
            ], 'sitemap/admin/edit' . $sitemapId);

            $this->generate();

            redirect(site_url('sitemap/admin/manage'));
        } else {
            $this->template->build('edit', $data);
        }
    }

    /**
     * Delete store category
     *
     * @param int $categoryId
     * @return void
     */
    public function delete($sitemapId = null)
    {
        $sitemap = $this->sitemap_model->find(['id' => $sitemapId]);

        if (empty($sitemap)) {
            show_404();
        }

        $this->sitemap_model->delete(['id' => $sitemapId]);

        $this->log_model->create('sitemap links', 'delete', 'Deleted a category', [
            'Sitemap' => $sitemap->module
        ]);

        $this->session->set_flashdata('success', lang('alert_category_deleted'));
        redirect(site_url('sitemap/admin/manage'));
    }
    

    public function generate()
    {
        // Generar el sitemap
        $sitemapFilePath = $this->sitemap_model->generateSitemap();

        if ($sitemapFilePath) {
            // Redirigir a la URL del sitemap
            $sitemapUrl = site_url('sitemap/admin');
            redirect($sitemapUrl);
        } else {
            // Manejar el error si la generación del sitemap falla
            echo 'Error al generar el sitemap.';
        }
    }
    
    public function validate_url($url)
    {
        if (preg_match('/^(http:\/\/|https:\/\/)/i', $url)) {
            return true; // La URL es válida
        } else {
            $this->form_validation->set_message('validate_url', 'La URL debe comenzar con "http://" o "https://".');
            return false; // La URL no es válida
        }
    }
}