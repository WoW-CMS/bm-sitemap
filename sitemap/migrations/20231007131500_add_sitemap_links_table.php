<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_sitemap_links_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'module' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => TRUE
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => TRUE
            ],
            'priority' => [
                'type' => 'DECIMAL',
                'constraint' => '3,1',
                'default' => '0.5'
            ],
            'last_modified datetime default current_timestamp on update current_timestamp',
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('sitemap_links');

        $data = [
            ['module' => 'Home', 'url' => base_url(), 'priority' => '1.0'],
            ['module' => 'UCP', 'url' => site_url('user'), 'priority' => '0.8'],
        ];
        $this->db->insert_batch('sitemap_links', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('sitemap_links');
    }
}
