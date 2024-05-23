<?php

/**
 * Copyright 2024 Dynamologic Solutions
 *
 * This is a modified file with custom functionality
 * for usage in a generic way with API manager
 *
 */

namespace Intacct\Functions\Projects;

use Intacct\Functions\AbstractFunctionSenegal;
use Intacct\Functions\Traits\CustomFieldsTrait;

abstract class AbstractProjectSenegal extends AbstractFunctionSenegal
{

    use CustomFieldsTrait;

    protected function getBasicFields(): array
    {
        return array(
            "DESCRIPTION",
            "PARENTID",
            "INVOICEWITHPARENT",
            "PROJECTTYPE",
            "PROJECTSTATUS",
            "CUSTOMERID",
            "MANAGERID",
            "CUSTUSERID",
            "SALESCONTACTID",
            "DOCNUMBER",
            "USERRESTRICTIONS"
        );
    }

    protected function getAdditionalFields(): array
    {
        return array(
            'TERMNAME',
            'BILLINGTYPE',
            'BEGINDATE',
            'ENDDATE',
            'DEPARTMENTID',
            'LOCATIONID',
            'CLASSID',
            'SUPDOCID',
            'BILLABLEEXPDEFAULT',
            'BILLABLEAPPODEFAULT',
            'OBSPERCENTCOMPLETE',
            'CURRENCY',
            'SONUMBER',
            'PONUMBER',
            'POAMOUNT',
            'PQNUMBER',
            'CONTRACTAMOUNT',
            'BILLINGPRICING',
            'BILLINGRATE',
            'EXPENSEPRICING',
            'EXPENSERATE',
            'POAPPRICING',
            'POAPRATE',
            'BUDGETAMOUNT',
            'BUDGETEDCOST',
            'BUDGETQTY',
            'BUDGETID',
            'INVOICEMESSAGE',
            'INVOICECURRENCY',
        );
    }

    protected function getStandardFieldList(): array
    {
        $other_fields = array("NAME", "STATUS", "PROJECTID", "PROJECTCATEGORY", "CONTACTINFO", "BILLTO", "SHIPTO");
        return array_merge($other_fields, $this->getBasicFields(), $this->getAdditionalFields());
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
