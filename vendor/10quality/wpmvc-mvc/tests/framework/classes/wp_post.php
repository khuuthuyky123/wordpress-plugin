<?php
class WP_Post extends stdClass
{
    public function __construct($id)
    {
        $this->ID = $id;
        $this->post_name = $id <= 1000 ? ( $id === 15 ? 'parent' : 'hello-world' ) : 'attachment.png';
        $this->post_title = $id <= 1000 ? ( $id === 15 ? 'Parent' : trim('Hello World ' . $id) ) : 'http://localhost/wp-content/uploads/attachment.png';
        $this->post_content = 'Hello World';
        if ($id < 5)
            $this->post_parent = 15;
    }
}