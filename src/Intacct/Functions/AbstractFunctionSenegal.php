<?php

/**
 * Copyright 2024 Dynamologic Solutions
 *
 * This is a modified file with custom functionality
 * for usage in a generic way with API manager
 *
 */

namespace Intacct\Functions;

use Intacct\Xml\XMLWriter;

abstract class AbstractFunctionSenegal extends AbstractFunction
{

    /** @var array */
    private $_standard_fields = [];

    public function setStandardFields($data){
        $this->_standard_fields = $data;
    }

    public function getStandardFields(): array
    {
        return $this->_standard_fields;
    }

    /** @var array */
    private $_standard_field_list = [];

    protected function setStandardFieldList($data){
        $this->_standard_field_list = $data;
    }

    protected function getStandardFieldList(): array
    {
        return $this->_standard_field_list;
    }

    /** @var array */
    private $_custom_field_list = [];

    protected function setCustomFieldList($data){
        $this->_custom_field_list = $data;
    }

    protected function getCustomFieldList(): array
    {
        return $this->_custom_field_list;
    }

    protected function getMailingAddressFields(): array
    {
        return array(
            "ADDRESS1",
            "ADDRESS2",
            "CITY",
            "STATE",
            "ZIP",
            "COUNTRY",
            "COUNTRYCODE",
        );
    }

    /**
     * @param XMLWriter $xml
     */
    public function writeXmlMailAddress(XMLWriter &$xml)
    {
        // mailing address
        $mailing_address_fields = $this->getMailingAddressFields();
        $address_is_set = false;
        foreach ($mailing_address_fields as $mailing_address_field){
            if (isset($standard_fields[$mailing_address_field])){
                $address_is_set = true;
                break;
            }
        }
        if ($address_is_set) {
            $xml->startElement('MAILADDRESS');

            foreach ($mailing_address_fields as $mailing_address_field){
                if (isset($standard_fields[$mailing_address_field])){
                    $xml->writeElement($mailing_address_field, $standard_fields[$mailing_address_field]);
                }
            }

            $xml->endElement(); //MAILADDRESS
        }
    }

    /**
     * Initializes the class with the given parameters.
     *
     * @param string $controlId Control ID, default=random UUID
     */
    public function __construct(string $controlId = '')
    {
        parent::__construct($controlId);
    }

    abstract public function writeXml(XMLWriter &$xml);
}
