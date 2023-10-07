<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo para manejar las categorías en la base de datos.
 */
class Sitemap_model extends BS_Model
{
    /**
     * Nombre de la tabla de categorías en la base de datos.
     * @var string
     */
    protected $table = 'sitemap_links';

    protected $setCreatedField = false;

    protected $setUpdatedField = false;

    private $priorityOptions = [
        '1.0' => 'maximum_priority',
        '0.9' => 'high_priority',
        '0.8' => 'medium_priority',
        '0.7' => 'low_priority',
        '0.6' => 'very_low_priority',
    ];

    public function getPriorityOptions()
    {
        return $this->priorityOptions;
    }

    public function generateSitemap()
    {
        $priorityOptions = $this->getPriorityOptions();
        $links = $this->db->get($this->table)->result();
    
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    
        foreach ($links as $link) {
            $priority = isset($priorityOptions[$link->priority]) ? $link->priority : '0.5';
    
            $sitemap .= "\t<url>\n";
            $sitemap .= "\t\t<loc>" . htmlspecialchars($link->url) . "</loc>\n";
            $sitemap .= "\t\t<priority>" . $priority . "</priority>\n";
            $sitemap .= "\t</url>\n";
        }
    
        $sitemap .= '</urlset>';
    
        // Ruta absoluta para el archivo de sitemap
        $sitemapFilePath = FCPATH . 'sitemap.xml';
    
        // Intenta guardar el archivo y manejar errores
        if (file_put_contents($sitemapFilePath, $sitemap) !== false) {
            // Archivo guardado con éxito
            return $sitemapFilePath;
        } else {
            // Manejar el error de escritura
            return false;
        }
    }
    

}