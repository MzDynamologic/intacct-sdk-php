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
 * Create a new vendor record
 */
class VendorCreateSenegal extends AbstractVendorSenegal
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
        $xml->startElement('VENDOR');

        $standard_fields = $this->getStandardFields();

        if (isset($standard_fields["VENDORID"])) {
            // Vendor ID is not required if auto-numbering is configured in module
            $xml->writeElement('VENDORID', $this->getVendorId());
        }

        if (isset($standard_fields["NAME"])) {
            $xml->writeElement('NAME', $standard_fields["NAME"], true);
        } else {
            throw new InvalidArgumentException('Vendor Name is required for create');
        }

        $xml->startElement('DISPLAYCONTACT');

        // CONTACTNAME is auto created as '[VendorName](V[VendorID])'

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
        $xml->endElement(); //create

        $xml->endElement(); //function
    }
}
