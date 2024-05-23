<?php

/**
 * Copyright 2024 Dynamologic Solutions
 *
 * This is a modified file with custom functionality
 * for usage in a generic way with API manager
 *
 */

namespace Intacct\Functions\Projects;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * Update an existing project record
 */
class ProjectUpdateSenegal extends AbstractProjectSenegal
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
        $xml->startElement('PROJECT');

        $standard_fields = $this->getStandardFields();

        if (isset($standard_fields["PROJECTID"])) {
            $xml->writeElement('PROJECTID', $standard_fields["PROJECTID"], true);
        } else if ($this->getRecordNo()){
            $xml->writeElement('RECORDNO', $this->getRecordNo(), true);
        } else {
            throw new InvalidArgumentException('Record No or Project ID is required for update');
        }

        if (isset($standard_fields["NAME"])) {
            $xml->writeElement('NAME', $standard_fields["NAME"], true);
        }

        if (isset($standard_fields["PROJECTCATEGORY"])) {
            $xml->writeElement('PROJECTCATEGORY', $standard_fields["PROJECTCATEGORY"], true);
        }

        foreach ($this->getBasicFields() as $basic_field) {
            if (isset($standard_fields[$basic_field])) {
                $xml->writeElement($basic_field, $standard_fields[$basic_field]);
            }
        }

        if (isset($standard_fields['STATUS'])) {
            $status_value = (is_bool($standard_fields['STATUS']) && $standard_fields['STATUS'])? 'active' : 'inactive';
            $xml->writeElement('STATUS', $status_value);
        }

        if (isset($standard_fields['CONTACTINFO'])) {
            $xml->startElement('CONTACTINFO');
            $xml->writeElement('CONTACTNAME', $standard_fields['CONTACTINFO'], true);
            $xml->endElement(); //CONTACTINFO
        }

        if (isset($standard_fields['BILLTO'])) {
            $xml->startElement('BILLTO');
            $xml->writeElement('CONTACTNAME', $standard_fields['BILLTO'], true);
            $xml->endElement(); //BILLTO
        }

        if (isset($standard_fields['SHIPTO'])) {
            $xml->startElement('SHIPTO');
            $xml->writeElement('CONTACTNAME', $standard_fields['SHIPTO'], true);
            $xml->endElement(); //SHIPTO
        }

        foreach ($this->getAdditionalFields() as $additional_field) {
            if (isset($standard_fields[$additional_field])) {
                $xml->writeElement($additional_field, $standard_fields[$additional_field]);
            }
        }

        $this->writeXmlImplicitCustomFields($xml);

        $xml->endElement(); //PROJECT
        $xml->endElement(); //update

        $xml->endElement(); //function
    }
}
