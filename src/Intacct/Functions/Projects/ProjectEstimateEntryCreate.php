<?php

/**
 * Copyright 2021 Sage Intacct, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"). You may not
 * use this file except in compliance with the License. You may obtain a copy
 * of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * or in the "LICENSE" file accompanying this file. This file is distributed on
 * an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace Intacct\Functions\Projects;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * Create a new project record
 */
class ProjectCreate extends AbstractProjectEstimateEntry
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
        $xml->startElement('PJESTIMATEENTRY');

        // Project ID is not required if auto-numbering is configured in module
        $xml->writeElement('PJESTIMATEID', $this->getProjectEstimateId());

        $xml->writeElement('EUOM', $this->getExternalUnitOfMeasure());
        $xml->writeElement('QTY', $this->getQuantity());
        $xml->writeElement('UNITCOST', $this->getUnitCost());
        $xml->writeElement('AMOUNT', $this->getAmount());
        $xml->writeElement('MEMO', $this->getMemo());
        $xml->writeElement('WFTYPE', $this->getWorkflowType(), "original");
        $xml->writeElement('PRODUCTIONUNITS', $this->getProductionUnits());
        $xml->writeElement('ACCOUNTNO', $this->getAccountNumber());
        $xml->writeElement('DEPARTMENTID', $this->getDepartmentId());
        $xml->writeElement('CUSTOMERID', $this->getCustomerId());
        $xml->writeElement('EMPLOYEEID', $this->getExmployeeId());
        $xml->writeElement('ITEMID', $this->getItemId());
        $xml->writeElement('CONTRACTID', $this->getContractId());
        $xml->writeElement('TASKID', $this->getTaskId());
        $xml->writeElement('COSTTYPEID', $this->getCostTypeId());
        $xml->writeElement('VENDORID', $this->getVendorId());
        $xml->writeElement('CLASSID', $this->getClassId());

        if ($this->getEstimateDate()) {
            $xml->startElement('ESTIMATEDATE');
            $xml->writeDateSplitElements($this->getEstimateDate(), true);
            $xml->endElement(); //ESTIMATEDATE
        }
        

        $this->writeXmlImplicitCustomFields($xml);

        $xml->endElement(); //PROJECT
        $xml->endElement(); //create

        $xml->endElement(); //function
    }
}
