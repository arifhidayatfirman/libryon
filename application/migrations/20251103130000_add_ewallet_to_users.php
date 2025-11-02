<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_ewallet_to_users extends CI_Migration {

    public function up()
    {
        // Create donation_options table
        $this->dbforge->add_field(array(
            'option_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'icon_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'is_active' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'default' => '1',
            ),
        ));
        $this->dbforge->add_key('option_id', TRUE);
        $this->dbforge->create_table('donation_options');

        // Add columns to users table
        $fields = array(
            'donation_option_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'null' => TRUE,
                'after' => 'profile_picture'
            ),
            'donation_target' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
                'after' => 'donation_option_id'
            )
        );
        $this->dbforge->add_column('users', $fields);

        $this->db->query('ALTER TABLE `users` ADD CONSTRAINT `fk_users_donation_option` FOREIGN KEY (`donation_option_id`) REFERENCES `donation_options`(`option_id`) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down()
    {
        $this->db->query('ALTER TABLE `users` DROP FOREIGN KEY `fk_users_donation_option`');
        $this->dbforge->drop_column('users', 'donation_option_id');
        $this->dbforge->drop_column('users', 'donation_target');
        $this->dbforge->drop_table('donation_options');
    }
}
