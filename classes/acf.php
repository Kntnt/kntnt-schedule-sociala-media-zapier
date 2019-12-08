<?php

namespace Kntnt\Schedule_Sociala_Media_Zapier;

class ACF {

    use WPML;

    private $has_linkedin;

    private $has_facebook;

    private $has_twitter;

    public function run() {

        $this->init_lang();

        $this->has_linkedin = (bool) $this->webhook( 'linkedin' );
        $this->has_facebook = (bool) $this->webhook( 'facebook' );
        $this->has_twitter = (bool) $this->webhook( 'twitter' );

        add_filter( 'acf/prepare_field/key=field_5de3d3c09e8a6', [ $this, 'missing_webhooks_message' ] );

        add_filter( 'acf/prepare_field/key=field_5de3d40b9e8a7', [ $this, 'linkedin_fields' ] );
        add_filter( 'acf/prepare_field/key=field_5de3d44b9e8aa', [ $this, 'linkedin_fields' ] );

        add_filter( 'acf/prepare_field/key=field_5de3d4269e8a8', [ $this, 'facebook_fields' ] );
        add_filter( 'acf/prepare_field/key=field_5de3e11763ca8', [ $this, 'facebook_fields' ] );

        add_filter( 'acf/prepare_field/key=field_5de3d42f9e8a9', [ $this, 'twitter_fields' ] );
        add_filter( 'acf/prepare_field/key=field_5de3e1f4f470e', [ $this, 'twitter_fields' ] );

        require Plugin::template( 'acf-fields.php' );

    }

    public function missing_webhooks_message( $field ) {
        return $this->has_linkedin || $this->has_facebook || $this->has_twitter ? false : $field;
    }

    public function linkedin_fields( $field ) {
        return $this->has_linkedin ? $field : false;
    }

    public function facebook_fields( $field ) {
        return $this->has_facebook ? $field : false;
    }

    public function twitter_fields( $field ) {
        return $this->has_twitter ? $field : false;
    }

}
