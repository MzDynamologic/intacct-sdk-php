<?php

/**
 * Copyright 2024 Dynamologic Solutions
 *
 * This is a modified file with custom functionality
 * for usage in a generic way with API manager
 *
 */

namespace Intacct\Functions\AccountsReceivable;

use Intacct\Functions\AbstractFunctionSenegal;
use Intacct\Functions\Traits\CustomFieldsTrait;
use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

abstract class AbstractCustomerSenegal extends AbstractFunctionSenegal
{

    use CustomFieldsTrait;

    protected function getDisplayContactFields(): array
    {
        return array(
            "PRINTAS",
            "COMPANYNAME",
            "TAXABLE",
            "TAXGROUP",
            "PREFIX",
            "FIRSTNAME",
            "LASTNAME",
            "INITIAL",
            "PHONE1",
            "PHONE2",
            "CELLPHONE",
            "PAGER",
            "FAX",
            "EMAIL1",
            "EMAIL2",
            "URL1",
            "URL2"
        );
    }

    protected function getAdditionalFields(): array
    {
        return array(
            'HIDEDISPLAYCONTACT',
            'CUSTTYPE',
            'CUSTREPID',
            'PARENTID',
            'GLGROUP',
            'TERRITORYID',
            'SUPDOCID',
            'TERMNAME',
            'OFFSETGLACCOUNTNO',
            'ARACCOUNT',
            'SHIPPINGMETHOD',
            'RESALENO',
            'TAXID',
            'CREDITLIMIT',
            'ONHOLD',
            'DELIVERYOPTIONS',
            'CUSTMESSAGEID',
            'COMMENTS',
            'CURRENCY',

            'ARINVOICEPRINTTEMPLATEID',
            'OEQUOTEPRINTTEMPLATEID',
            'OEORDERPRINTTEMPLATEID',
            'OELISTPRINTTEMPLATEID',
            'OEINVOICEPRINTTEMPLATEID',
            'OEADJPRINTTEMPLATEID',
            'OEOTHERPRINTTEMPLATEID',
        );
    }

    protected function getStandardFieldList(): array
    {
        $other_fields = array("NAME", "ONETIME", "STATUS", "CUSTOMERID");
        return array_merge($other_fields, $this->getMailingAddressFields(), $this->getDisplayContactFields(), $this->getAdditionalFields());
    }

    public function setStandardAndCustomFields($parameters)
    {
        $standard_field_keys = $this->getStandardFieldList();
        $standard_fields = [];
        $custom_fields = [];
        foreach ($parameters as $parameter_key => $parameter_value){
            if (in_array($parameter_key, $standard_field_keys)){
                // The field is a standard field
                $standard_fields[$parameter_key] = $parameter_value;
            } else {
                // The field is a custom field
                $custom_fields[$parameter_key] = $parameter_value;
            }
        }
        $this->setStandardFields($standard_fields);
        $this->setCustomFields($custom_fields);
        $this->setCustomFieldList(array_keys($custom_fields));
        return array("standard" => $standard_fields, "custom" => $custom_fields, "standard_field_keys" => $standard_field_keys);
    }
}
