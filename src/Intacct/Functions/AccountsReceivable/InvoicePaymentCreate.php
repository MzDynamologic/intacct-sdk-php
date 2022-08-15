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

namespace Intacct\Functions\AccountsReceivable;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * Create a new accounts receivable payment record
 */
class InvoicePaymentCreate extends AbstractInvoicePayment
{

    /**
     *
     * @param XMLWriter $xml
     */
    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('function');

        $xml->writeAttribute('controlid', $this->getControlId());

        $xml->startElement('create');

        $xml->startElement('arpymt');

        if (!$this->getFinancialEntity()) {
            throw new InvalidArgumentException('Financial Entity is required for create');
        }
        $xml->writeElement('financialentity', $this->getFinancialEntity(), true);

        if (!$this->getPaymentMethod()) {
            throw new InvalidArgumentException('Payment Method is required for create');
        }
        $xml->writeElement('paymentmethod', $this->getPaymentMethod(), true);

        if (!$this->getCustomerId()) {
            throw new InvalidArgumentException('Customer ID is required for create');
        }
        $xml->writeElement('customerid', $this->getCustomerId(), true);

        $xml->writeElement('docnumber', $this->getDocumentNumber(), true);
        $xml->writeElement('description', $this->getDescription(), true);

        if ($this->getExchangeRateTypeId()){
            $xml->writeElement('exch_rate_type_id', $this->getExchangeRateTypeId(), true);
        } else if ($this->getExchangeRate()){
            $xml->writeElement('exchange_rate', $this->getExchangeRate(), true);
        } else {
            $xml->writeElement('exch_rate_type_id', "", true);
        }

        if (!$this->getReceiptDate()) {
            throw new InvalidArgumentException('Receipt Date is required for create');
        }
        $xml->writeElement('receiptdate', $this->getReceiptDate(), true);

        $xml->writeElement('paymentdate', $this->getPaymentDate());

        $xml->writeElement('amounttopay', $this->getAmountToPay(), true);
        $xml->writeElement('trx_amounttopay', $this->getTrxAmountToPay(), true);

        if (!$this->getFinancialEntity() && !$this->getPrBatch() && !$this->getUndepositedAccountNumber()){
            throw new InvalidArgumentException('Summary (Pr Batch) is required if Financial Entity and Undeposited Account Number are not provided');
        }
        $xml->writeElement('prbatch', $this->getPrBatch(), true);

        if ($this->getWhenPaid()){
            $xml->startElement('whenpaid');
            $xml->writeDateSplitElements($this->getWhenPaid(), true);
            $xml->endElement(); //whenpaid
        }

        if (!$this->getCurrency()){
            throw new InvalidArgumentException('Currency is required for create');
        }
        $xml->writeElement('currency', $this->getCurrency(), true);
        $xml->writeElement('basecurr', $this->getBaseCurrency(), true);
        $xml->writeElement('undepositedaccountnumber', $this->getUndepositedAccountNumber(), true);

        $xml->writeElement('overpaymentamount', $this->getOverpaymentAmount(), true);
        $xml->writeElement('overpaymentlocationid', $this->getOverpaymentLocationId(), true);
        $xml->writeElement('overpaymentdepartmentid', $this->getOverpaymentDepartmentId(), true);

        $xml->writeElement('billtopayname', $this->getBillToPayName(), true);

        $xml->startElement('ARPYMTDETAILS');
        if (count($this->getPaymentDetails()) > 0) {
            foreach ($this->getPaymentDetails() as $paymentDetail) {
                $paymentDetail->writeXml($xml);
            }
        } else {
            throw new InvalidArgumentException('Invoice payments must have at least 1 payment detail.');
        }
        $xml->endElement(); //ARPYMTDETAILS

        //TODO online payment methods

        $xml->endElement(); //arpymt

        $xml->endElement(); //create

        $xml->endElement(); //function
    }
}
