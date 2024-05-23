<?php

/**
 * Copyright 2024 Dynamologic Solutions
 *
 * This is a modified file with custom functionality
 * for usage in a generic way with API manager
 *
 */

namespace Intacct\Functions\AccountsReceivable;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * Create a new customer record
 */
class CustomerCreateSenegal extends AbstractCustomerSenegal
{
    /**
     * Write the function block XML
     *
     * @param XMLWriter $xml
     * @throw InvalidArgumentException
     */
    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('function');
        $xml->writeAttribute('controlid', $this->getControlId());

        $xml->startElement('create');
        $xml->startElement('CUSTOMER');

        $standard_fields = $this->getStandardFields();

        if (isset($standard_fields["CUSTOMERID"])) {
            // Customer ID is not required if auto-numbering is configured in module
            $xml->writeElement('CUSTOMERID', $standard_fields["CUSTOMERID"]);
        }

        if (!isset($standard_fields["NAME"])) {
            throw new InvalidArgumentException('Customer Name is required for create');
        }
        $xml->writeElement('NAME', $standard_fields["NAME"], true);

        $xml->startElement('DISPLAYCONTACT');

        // CONTACTNAME is auto created as '[CustomerName](C[CustomerID])'

        foreach ($this->getDisplayContactFields() as $display_contact_field) {
            if (isset($standard_fields[$display_contact_field])) {
                $xml->writeElement($display_contact_field, $standard_fields[$display_contact_field]);
            } else if ($display_contact_field == "PRINTAS"){
                $xml->writeElement('PRINTAS', $standard_fields["NAME"], true);
            }
        }

        $this->writeXmlMailAddress($xml);

        $xml->endElement(); //DISPLAYCONTACT

        if (isset($standard_fields['ONETIME'])) {
            $xml->writeElement('ONETIME', $standard_fields["ONETIME"]);
        }

        if (isset($standard_fields['STATUS'])) {
            $status_value = (is_bool($standard_fields['STATUS']) && $standard_fields['STATUS'])? 'active' : 'inactive';
            $xml->writeElement('STATUS', $status_value);
        }

        foreach ($this->getAdditionalFields() as $additional_field){
            if (isset($standard_fields[$additional_field])){
                $xml->writeElement($additional_field, $standard_fields[$additional_field]);
            }
        }

        // TODO Salesforce tab

        $this->writeXmlImplicitCustomFields($xml);

        $xml->endElement(); //CUSTOMER
        $xml->endElement(); //create

        $xml->endElement(); //function
    }
}
