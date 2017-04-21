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

    private function load_file()
    {
        return file_get_contents( $this->base_dir . self::JSON_FILE );
    }

    public function decode_data( $data )
    {
        if ( $this->decode )
        {
            return json_decode( $data, true );
        }
        else
        {
            return $data;
        }
    }

    public function get_licenses()
    {
        $json_content = $this->load_file();

        return $this->decode_data( $json_content );
    }

    public function get_license( $key )
    {
        $license = get_option( $key );

        return $this->decode_data( $license );
    }
}
