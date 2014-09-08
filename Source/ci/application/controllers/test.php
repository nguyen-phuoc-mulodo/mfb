<?php

class Test extends GB_Controller {
    function get_view($view) {
        $this->load->view($view);
    }
}
