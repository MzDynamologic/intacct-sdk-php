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
class ProjectEstimateCreate extends AbstractProjectEstimate
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
        $xml->startElement('PJESTIMATE');

        // Project ID is not required if auto-numbering is configured in module
        $xml->writeElement('PROJECTID', $this->getProjectId());

        if (!$this->getProjectEstimateId()) {
            throw new InvalidArgumentException('Project Estimate Id is required for create');
        }
        $xml->writeElement('PJESTIMATEID', $this->getProjectEstimateId(), true);

        $xml->writeElement('DESCRIPTION', $this->getDescription());
        $xml->writeElement('ISPRIMARY', $this->getIsPrimary(), true);
        $xml->writeElement('POSTED', $this->getPosted(), false);
        $xml->writeElement('PJESTIMATETYPENAME', $this->getProjectEstimateTypeName());
        $xml->writeElement('GLBUDGETID', $this->getIGlBudgetId());

        if ($this->getEstimateDate()) {
            $xml->startElement('ESTIMATEDATE');
            $xml->writeDateSplitElements($this->getEstimateDate(), true);
            $xml->endElement(); //ESTIMATEDATE
        }

        $xml->writeElement('POSTTO', $this->getPostTo(), "First period");
        $xml->writeElement('PROJECTID', $this->getProjectId());
        $xml->writeElement('STATUS', $this->getStatus());

        $xml->startElement('projectestimateentries');
        if (count($this->getEntries()) > 0) {
            foreach ($this->getEntries() as $entry) {
                $entry->writeXml($xml);
            }
        } else {
            throw new InvalidArgumentException('Project Estimate must have at least 1 entry');
        }
        $xml->endElement(); //projectestimateentry

        $this->writeXmlExplicitCustomFields($xml);

        $xml->endElement(); //PROJECTESTIMATE
        $xml->endElement(); //create

        $xml->endElement(); //function
    }
}
