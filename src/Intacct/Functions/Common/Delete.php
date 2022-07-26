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

namespace Intacct\Functions\Common;

use Intacct\Functions\AbstractFunction;
use Intacct\Xml\XMLWriter;

class Delete extends AbstractFunction
{
    /** @var string */
    protected $objectname;

    /**
     * @return string
     */
    public function getObjectname(): string
    {
        return $this->objectname;
    }

    /**
     * @param string $objectname
     */
    public function setObjectname(string $objectname): void
    {
        $this->objectname = $objectname;
    }

    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('function');
        $xml->writeAttribute('controlid', $this->controlId, true);
        $xml->startElement('delete');
        $xml->writeElement('object', $this->getObjectname());
        if ($this->getRecordNo()) {
            $xml->writeElement('keys', $this->getRecordNo());
        } else {
            throw new InvalidArgumentException('Record No or Key is required for delete');
        }
        $xml->endElement(); //delete
        $xml->endElement(); // function
    }
}