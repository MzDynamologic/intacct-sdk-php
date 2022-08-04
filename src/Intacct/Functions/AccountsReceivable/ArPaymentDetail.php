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

class ArPaymentDetail
{

    /** @var string|int */
    private $recordKey;

    /** @var string|int */
    private $entryKey;

    /** @var string|int */
    private $posAdjKey;

    /** @var string|int */
    private $posAdjEntryKey;

    /** @var string|int */
    private $trxPaymentAmount;

    /** @var string|int */
    private $adjustmentKey;

    /** @var string|int */
    private $adjustmentEntryKey;

    /** @var string|int */
    private $trxAdjustmentAmount;

    /** @var string|int */
    private $inlineKey;

    /** @var string|int */
    private $inlineEntryKey;

    /** @var string|int */
    private $trxInlineAmount;

    /** @var string|int */
    private $advanceKey;

    /** @var string|int */
    private $advanceEntryKey;

    /** @var string|int */
    private $trxPostedAdvanceAmount;

    /** @var string|int */
    private $overpaymentKey;

    /** @var string|int */
    private $overpaymentEntryKey;

    /** @var string|int */
    private $trxPostedOverpaymentAmount;

    /** @var string|int */
    private $negativeInvoiceKey;

    /** @var string|int */
    private $negativeInvoiceEntryKey;

    /** @var string|int */
    private $trxNegativeInvoiceAmount;

    /** @var \DateTime */
    private $discountDate;

    /**
     * @return int|string
     */
    public function getRecordKey()
    {
        return $this->recordKey;
    }

    /**
     * @param int|string $recordKey
     */
    public function setRecordKey($recordKey)
    {
        $this->recordKey = $recordKey;
    }

    /**
     * @return int|string
     */
    public function getEntryKey()
    {
        return $this->entryKey;
    }

    /**
     * @param int|string $entryKey
     */
    public function setEntryKey($entryKey)
    {
        $this->entryKey = $entryKey;
    }

    /**
     * @return int|string
     */
    public function getPosAdjKey()
    {
        return $this->posAdjKey;
    }

    /**
     * @param int|string $posAdjKey
     */
    public function setPosAdjKey($posAdjKey)
    {
        $this->posAdjKey = $posAdjKey;
    }

    /**
     * @return int|string
     */
    public function getPosAdjEntryKey()
    {
        return $this->posAdjEntryKey;
    }

    /**
     * @param int|string $posAdjEntryKey
     */
    public function setPosAdjEntryKey($posAdjEntryKey)
    {
        $this->posAdjEntryKey = $posAdjEntryKey;
    }

    /**
     * @return int|string
     */
    public function getTrxPaymentAmount()
    {
        return $this->trxPaymentAmount;
    }

    /**
     * @param int|string $trxPaymentAmount
     */
    public function setTrxPaymentAmount($trxPaymentAmount)
    {
        $this->trxPaymentAmount = $trxPaymentAmount;
    }

    /**
     * @return int|string
     */
    public function getAdjustmentKey()
    {
        return $this->adjustmentKey;
    }

    /**
     * @param int|string $adjustmentKey
     */
    public function setAdjustmentKey($adjustmentKey)
    {
        $this->adjustmentKey = $adjustmentKey;
    }

    /**
     * @return int|string
     */
    public function getAdjustmentEntryKey()
    {
        return $this->adjustmentEntryKey;
    }

    /**
     * @param int|string $adjustmentEntryKey
     */
    public function setAdjustmentEntryKey($adjustmentEntryKey)
    {
        $this->adjustmentEntryKey = $adjustmentEntryKey;
    }

    /**
     * @return int|string
     */
    public function getTrxAdjustmentAmount()
    {
        return $this->trxAdjustmentAmount;
    }

    /**
     * @param int|string $trxAdjustmentAmount
     */
    public function setTrxAdjustmentAmount($trxAdjustmentAmount)
    {
        $this->trxAdjustmentAmount = $trxAdjustmentAmount;
    }

    /**
     * @return int|string
     */
    public function getInlineKey()
    {
        return $this->inlineKey;
    }

    /**
     * @param int|string $inlineKey
     */
    public function setInlineKey($inlineKey)
    {
        $this->inlineKey = $inlineKey;
    }

    /**
     * @return int|string
     */
    public function getInlineEntryKey()
    {
        return $this->inlineEntryKey;
    }

    /**
     * @param int|string $inlineEntryKey
     */
    public function setInlineEntryKey($inlineEntryKey)
    {
        $this->inlineEntryKey = $inlineEntryKey;
    }

    /**
     * @return int|string
     */
    public function getTrxInlineAmount()
    {
        return $this->trxInlineAmount;
    }

    /**
     * @param int|string $trxInlineAmount
     */
    public function setTrxInlineAmount($trxInlineAmount)
    {
        $this->trxInlineAmount = $trxInlineAmount;
    }

    /**
     * @return int|string
     */
    public function getAdvanceKey()
    {
        return $this->advanceKey;
    }

    /**
     * @param int|string $advanceKey
     */
    public function setAdvanceKey($advanceKey)
    {
        $this->advanceKey = $advanceKey;
    }

    /**
     * @return int|string
     */
    public function getAdvanceEntryKey()
    {
        return $this->advanceEntryKey;
    }

    /**
     * @param int|string $advanceEntryKey
     */
    public function setAdvanceEntryKey($advanceEntryKey)
    {
        $this->advanceEntryKey = $advanceEntryKey;
    }

    /**
     * @return int|string
     */
    public function getTrxPostedAdvanceAmount()
    {
        return $this->trxPostedAdvanceAmount;
    }

    /**
     * @param int|string $trxPostedAdvanceAmount
     */
    public function setTrxPostedAdvanceAmount($trxPostedAdvanceAmount)
    {
        $this->trxPostedAdvanceAmount = $trxPostedAdvanceAmount;
    }

    /**
     * @return int|string
     */
    public function getOverpaymentKey()
    {
        return $this->overpaymentKey;
    }

    /**
     * @param int|string $overpaymentKey
     */
    public function setOverpaymentKey($overpaymentKey)
    {
        $this->overpaymentKey = $overpaymentKey;
    }

    /**
     * @return int|string
     */
    public function getOverpaymentEntryKey()
    {
        return $this->overpaymentEntryKey;
    }

    /**
     * @param int|string $overpaymentEntryKey
     */
    public function setOverpaymentEntryKey($overpaymentEntryKey)
    {
        $this->overpaymentEntryKey = $overpaymentEntryKey;
    }

    /**
     * @return int|string
     */
    public function getTrxPostedOverpaymentAmount()
    {
        return $this->trxPostedOverpaymentAmount;
    }

    /**
     * @param int|string $trxPostedOverpaymentAmount
     */
    public function setTrxPostedOverpaymentAmount($trxPostedOverpaymentAmount)
    {
        $this->trxPostedOverpaymentAmount = $trxPostedOverpaymentAmount;
    }

    /**
     * @return int|string
     */
    public function getNegativeInvoiceKey()
    {
        return $this->negativeInvoiceKey;
    }

    /**
     * @param int|string $negativeInvoiceKey
     */
    public function setNegativeInvoiceKey($negativeInvoiceKey)
    {
        $this->negativeInvoiceKey = $negativeInvoiceKey;
    }

    /**
     * @return int|string
     */
    public function getNegativeInvoiceEntryKey()
    {
        return $this->negativeInvoiceEntryKey;
    }

    /**
     * @param int|string $negativeInvoiceEntryKey
     */
    public function setNegativeInvoiceEntryKey($negativeInvoiceEntryKey)
    {
        $this->negativeInvoiceEntryKey = $negativeInvoiceEntryKey;
    }

    /**
     * @return int|string
     */
    public function getTrxNegativeInvoiceAmount()
    {
        return $this->trxNegativeInvoiceAmount;
    }

    /**
     * @param int|string $trxNegativeInvoiceAmount
     */
    public function setTrxNegativeInvoiceAmount($trxNegativeInvoiceAmount)
    {
        $this->trxNegativeInvoiceAmount = $trxNegativeInvoiceAmount;
    }

    /**
     * @return \DateTime
     */
    public function getDiscountDate()
    {
        return $this->discountDate;
    }

    /**
     * @param \DateTime $discountDate
     */
    public function setDiscountDate($discountDate)
    {
        $this->discountDate = $discountDate;
    }

    /**
     * Write the arpaymentdetail block XML
     *
     * @param XMLWriter $xml
     */
    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('ARPYMTDETAIL');

        $xml->writeElement('RECORDKEY', $this->getRecordKey(), true);
        $xml->writeElement('ENTRYKEY', $this->getEntryKey(), true);
        $xml->writeElement('POSADJKEY', $this->getPosAdjKey(), true);
        $xml->writeElement('POSADJENTRYKEY', $this->getPosAdjEntryKey(), true);
        $xml->writeElement('TRX_PAYMENTAMOUNT', $this->getTrxPaymentAmount(), true);
        $xml->writeElement('ADJUSTMENTKEY', $this->getAdjustmentKey(), true);
        $xml->writeElement('ADJUSTMENTENTRYKEY', $this->getAdjustmentEntryKey(), true);
        $xml->writeElement('TRX_ADJUSTMENTAMOUNT', $this->getTrxAdjustmentAmount(), true);
        $xml->writeElement('INLINEKEY', $this->getInlineKey(), true);
        $xml->writeElement('INLINEENTRYKEY', $this->getInlineEntryKey(), true);
        $xml->writeElement('TRX_INLINEAMOUNT', $this->getTrxInlineAmount(), true);
        $xml->writeElement('ADVANCEKEY', $this->getAdvanceKey(), true);
        $xml->writeElement('ADVANCEENTRYKEY', $this->getAdvanceEntryKey(), true);
        $xml->writeElement('TRX_POSTEDADVANCEAMOUNT', $this->getTrxPostedAdvanceAmount(), true);
        $xml->writeElement('OVERPAYMENTKEY', $this->getOverpaymentKey(), true);
        $xml->writeElement('OVERPAYMENTENTRYKEY', $this->getOverpaymentEntryKey(), true);
        $xml->writeElement('TRX_POSTEDOVERPAYMENTAMOUNT', $this->getTrxPostedOverpaymentAmount(), true);
        $xml->writeElement('NEGATIVEINVOICEKEY', $this->getNegativeInvoiceKey(), true);
        $xml->writeElement('NEGATIVEINVOICEENTRYKEY', $this->getNegativeInvoiceEntryKey(), true);
        $xml->writeElement('TRX_NEGATIVEINVOICEAMOUNT', $this->getTrxNegativeInvoiceAmount(), true);
        if ($this->getDiscountDate()){
            $xml->startElement('DISCOUNTDATE');
            $xml->writeDateSplitElements($this->getDiscountDate(), true);
            $xml->endElement(); //DISCOUNTDATE
        }

        $xml->endElement(); //arpaymentdetail
    }
}
