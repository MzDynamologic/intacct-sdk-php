<?php

/**
 * Copyright 2024 Dynamologic Solutions
 *
 * This is a modified file with custom functionality
 * for usage in a generic way with API manager
 *
 */

namespace Intacct\Functions\AccountsPayable;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * Update an existing vendor record
 */
class VendorUpdateSenegal extends AbstractVendorSenegal
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
        $xml->startElement('VENDOR');

        $standard_fields = $this->getStandardFields();

        if ($this->getVendorId()) {
            $xml->writeElement('VENDORID', $this->getVendorId(), true);
        } else if ($this->getRecordNo()) {
            $xml->writeElement('RECORDNO', $this->getRecordNo(), true);
        } else {
            throw new InvalidArgumentException('Record No or Vendor ID is required for update');
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

        if (isset($standard_fields['CONTACTINFO'])) {
            $xml->startElement('CONTACTINFO');
            $xml->writeElement('CONTACTNAME', $standard_fields['CONTACTINFO'], true);
            $xml->endElement(); //CONTACTINFO
        }

        if (isset($standard_fields['PAYTO'])) {
            $xml->startElement('PAYTO');
            $xml->writeElement('CONTACTNAME', $standard_fields['PAYTO'], true);
            $xml->endElement(); //PAYTO
        }

        if (isset($standard_fields['RETURNTO'])) {
            $xml->startElement('RETURNTO');
            $xml->writeElement('CONTACTNAME', $standard_fields['RETURNTO'], true);
            $xml->endElement(); //RETURNTO
        }

        foreach ($this->getBillPaymentFields() as $additional_field){
            if (isset($standard_fields[$additional_field])){
                $xml->writeElement($additional_field, $standard_fields[$additional_field]);
            }
        }

        if (isset($standard_fields['OBJECTRESTRICTION'])) {
            $xml->writeElement('OBJECTRESTRICTION', $standard_fields['OBJECTRESTRICTION']);
        }

        foreach ($this->getRestrictionFields() as $restriction_field) {
            if (isset($standard_fields[$restriction_field]) && is_array($standard_fields[$restriction_field]) && count($standard_fields[$restriction_field]) > 0) {
                $xml->writeElement($restriction_field, $standard_fields[$restriction_field]);
            }
        }

        $this->writeXmlImplicitCustomFields($xml);

        $xml->endElement(); //VENDOR
        $xml->endElement(); //update

        $xml->endElement(); //function
    }
}
