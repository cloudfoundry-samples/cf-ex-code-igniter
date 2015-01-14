<?php

class Migration_News extends CI_Migration {
    public function up() {
        $this->dbforge->add_field("id int(11) unsigned NOT NULL AUTO_INCREMENT");
        $this->dbforge->add_field("title varchar(128) NOT NULL");
        $this->dbforge->add_field("slug varchar(128) NOT NULL");
        $this->dbforge->add_field("text text NOT NULL");

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('slug');

        $this->dbforge->create_table('news', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('news');
    }
}

?>
