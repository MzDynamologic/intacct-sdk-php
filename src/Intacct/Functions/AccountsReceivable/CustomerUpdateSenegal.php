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
 * Update an existing customer record
 */
class CustomerUpdateSenegal extends AbstractCustomerSenegal
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

        $xml->startElement('update');
        $xml->startElement('CUSTOMER');

        $standard_fields = $this->getStandardFields();

        if (isset($standard_fields["CUSTOMERID"])) {
            $xml->writeElement('CUSTOMERID', $standard_fields["CUSTOMERID"], true);
        } else if ($this->getRecordNo()){
            $xml->writeElement('RECORDNO', $this->getRecordNo(), true);
        } else {
            throw new InvalidArgumentException('Record No or Customer ID is required for update');
        }

        if (isset($standard_fields["NAME"])) {
            $xml->writeElement('NAME', $standard_fields["NAME"], true);
        }

        $xml->startElement('DISPLAYCONTACT');

        foreach ($this->getDisplayContactFields() as $display_contact_field) {
            if (isset($standard_fields[$display_contact_field])) {
                $xml->writeElement($display_contact_field, $standard_fields[$display_contact_field]);
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
        $xml->endElement(); //update

        $xml->endElement(); //function
    }
}
