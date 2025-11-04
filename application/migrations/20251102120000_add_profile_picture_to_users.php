<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_profile_picture_to_users extends CI_Migration {

    public function up()
    {
        $fields = array(
            'avatar_file' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
        );
        $this->dbforge->add_column('users', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('users', 'avatar_file');
    }
}