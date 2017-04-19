<?php

class License {

    const JSON_FILE = 'licenses.json';

    private $decode;

    private $base_dir;

    public function __construct( $decode=true )
    {
        $this->decode = $decode;
        $this->base_dir = plugin_dir_path( dirname( __FILE__ . '/' ) );
    }

    public function get_licenses()
    {
        // Load json file content
        $json_content = file_get_contents( $this->base_dir . self::JSON_FILE );

        if ( $this->decode )
        {
            return json_decode( $json_content, true );
        }
        else
        {
            return $json_content;
        }
    }
}
