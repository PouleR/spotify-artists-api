<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: spotify/login5/v3/identifiers/identifiers.proto

namespace Spotify\Login5\V3\Identifiers;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>spotify.login5.v3.identifiers.PhoneNumber</code>
 */
class PhoneNumber extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string number = 1;</code>
     */
    protected $number = '';
    /**
     * Generated from protobuf field <code>string iso_country_code = 2;</code>
     */
    protected $iso_country_code = '';
    /**
     * Generated from protobuf field <code>string country_calling_code = 3;</code>
     */
    protected $country_calling_code = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $number
     *     @type string $iso_country_code
     *     @type string $country_calling_code
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Spotify\Login5\V3\Identifiers\Identifiers::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string number = 1;</code>
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Generated from protobuf field <code>string number = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setNumber($var)
    {
        GPBUtil::checkString($var, True);
        $this->number = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string iso_country_code = 2;</code>
     * @return string
     */
    public function getIsoCountryCode()
    {
        return $this->iso_country_code;
    }

    /**
     * Generated from protobuf field <code>string iso_country_code = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setIsoCountryCode($var)
    {
        GPBUtil::checkString($var, True);
        $this->iso_country_code = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string country_calling_code = 3;</code>
     * @return string
     */
    public function getCountryCallingCode()
    {
        return $this->country_calling_code;
    }

    /**
     * Generated from protobuf field <code>string country_calling_code = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setCountryCallingCode($var)
    {
        GPBUtil::checkString($var, True);
        $this->country_calling_code = $var;

        return $this;
    }

}

