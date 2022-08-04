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

use Intacct\Functions\AbstractFunction;
use InvalidArgumentException;

abstract class AbstractInvoicePayment extends AbstractFunction
{

    /** @var string */
    const PAYMENT_METHOD_CHECK = 'Printed Check';

    /** @var string */
    const PAYMENT_METHOD_CASH = 'Cash';

    /** @var string */
    const PAYMENT_METHOD_RECORD_TRANSFER = 'EFT';

    /** @var string */
    const PAYMENT_METHOD_CREDIT_CARD = 'Credit Card';

    /** @var string */
    const PAYMENT_METHOD_ONLINE = 'Online';

    /** @var string */
    const PAYMENT_METHOD_ONLINE_CREDIT_CARD = 'Online Charge Card';

    /** @var string */
    const PAYMENT_METHOD_ONLINE_ACH_DEBIT = 'Online ACH Debit';

    /** @var array */
    const PAYMENT_METHODS = [
        'Printed Check',
        'Cash',
        'EFT',
        'Credit Card',
        'Online',
        //'Online Charge Card',
        //'Online ACH Debit',
    ];

    /** @var null|string */
    protected $financialEntity;

    /** @var null|string */
    protected $paymentMethod;

    /** @var int|string */
    protected $customerId;

    /** @var int|string */
    protected $documentNumber;

    /** @var null|string */
    protected $description;

    /** @var int|string */
    protected $exchangeRateTypeId;

    /** @var null|\DateTime */
    protected $exchangeRate;

    /** @var null|\DateTime */
    protected $receiptDate;

    /** @var null|\DateTime */
    protected $paymentDate;

    /** @var int|string */
    protected $amountToPay;

    /** @var int|string */
    protected $trxAmountToPay;

    /** @var int|string */
    protected $prBatch;

    /** @var null|\DateTime */
    protected $whenPaid;

    /** @var null|string */
    protected $currency;

    /** @var null|string */
    protected $baseCurrency;

    /** @var int|string */
    protected $undepositedAccountNumber;

    /** @var int|string */
    protected $overpaymentAmount;

    /** @var int|string */
    protected $overpaymentLocationId;

    /** @var int|string */
    protected $overpaymentDepartmentId;

    /** @var null|string */
    protected $billToPayName;

    /** @var ArPaymentDetail[] */
    protected $paymentDetails = [];

    /** @var null|string */
    protected $onlineCardPayment;

    /**
     * @return string|null
     */
    public function getFinancialEntity(): ?string
    {
        return $this->financialEntity;
    }

    /**
     * @param string|null $financialEntity
     */
    public function setFinancialEntity(?string $financialEntity): void
    {
        $this->financialEntity = $financialEntity;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string|null $paymentMethod
     */
    public function setPaymentMethod(?string $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return int|string
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param int|string $customerId
     */
    public function setCustomerId($customerId): void
    {
        $this->customerId = $customerId;
    }

    /**
     * @return int|string
     */
    public function getDocumentNumber()
    {
        return $this->documentNumber;
    }

    /**
     * @param int|string $documentNumber
     */
    public function setDocumentNumber($documentNumber): void
    {
        $this->documentNumber = $documentNumber;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int|string
     */
    public function getExchangeRateTypeId()
    {
        return $this->exchangeRateTypeId;
    }

    /**
     * @param int|string $exchangeRateTypeId
     */
    public function setExchangeRateTypeId($exchangeRateTypeId): void
    {
        $this->exchangeRateTypeId = $exchangeRateTypeId;
    }

    /**
     * @return \DateTime|null
     */
    public function getExchangeRate(): ?\DateTime
    {
        return $this->exchangeRate;
    }

    /**
     * @param \DateTime|null $exchangeRate
     */
    public function setExchangeRate(?\DateTime $exchangeRate): void
    {
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * @return \DateTime|null
     */
    public function getReceiptDate(): ?\DateTime
    {
        return $this->receiptDate;
    }

    /**
     * @param \DateTime|null $receiptDate
     */
    public function setReceiptDate(?\DateTime $receiptDate): void
    {
        $this->receiptDate = $receiptDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getPaymentDate(): ?\DateTime
    {
        return $this->paymentDate;
    }

    /**
     * @param \DateTime|null $paymentDate
     */
    public function setPaymentDate(?\DateTime $paymentDate): void
    {
        $this->paymentDate = $paymentDate;
    }

    /**
     * @return int|string
     */
    public function getAmountToPay()
    {
        return $this->amountToPay;
    }

    /**
     * @param int|string $amountToPay
     */
    public function setAmountToPay($amountToPay): void
    {
        $this->amountToPay = $amountToPay;
    }

    /**
     * @return int|string
     */
    public function getTrxAmountToPay()
    {
        return $this->trxAmountToPay;
    }

    /**
     * @param int|string $trxAmountToPay
     */
    public function setTrxAmountToPay($trxAmountToPay): void
    {
        $this->trxAmountToPay = $trxAmountToPay;
    }

    /**
     * @return int|string
     */
    public function getPrBatch()
    {
        return $this->prBatch;
    }

    /**
     * @param int|string $prBatch
     */
    public function setPrBatch($prBatch): void
    {
        $this->prBatch = $prBatch;
    }

    /**
     * @return \DateTime|null
     */
    public function getWhenPaid(): ?\DateTime
    {
        return $this->whenPaid;
    }

    /**
     * @param \DateTime|null $whenPaid
     */
    public function setWhenPaid(?\DateTime $whenPaid): void
    {
        $this->whenPaid = $whenPaid;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     */
    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string|null
     */
    public function getBaseCurrency(): ?string
    {
        return $this->baseCurrency;
    }

    /**
     * @param string|null $baseCurrency
     */
    public function setBaseCurrency(?string $baseCurrency): void
    {
        $this->baseCurrency = $baseCurrency;
    }

    /**
     * @return int|string
     */
    public function getUndepositedAccountNumber()
    {
        return $this->undepositedAccountNumber;
    }

    /**
     * @param int|string $undepositedAccountNumber
     */
    public function setUndepositedAccountNumber($undepositedAccountNumber): void
    {
        $this->undepositedAccountNumber = $undepositedAccountNumber;
    }

    /**
     * @return int|string
     */
    public function getOverpaymentAmount()
    {
        return $this->overpaymentAmount;
    }

    /**
     * @param int|string $overpaymentAmount
     */
    public function setOverpaymentAmount($overpaymentAmount): void
    {
        $this->overpaymentAmount = $overpaymentAmount;
    }

    /**
     * @return int|string
     */
    public function getOverpaymentLocationId()
    {
        return $this->overpaymentLocationId;
    }

    /**
     * @param int|string $overpaymentLocationId
     */
    public function setOverpaymentLocationId($overpaymentLocationId): void
    {
        $this->overpaymentLocationId = $overpaymentLocationId;
    }

    /**
     * @return int|string
     */
    public function getOverpaymentDepartmentId()
    {
        return $this->overpaymentDepartmentId;
    }

    /**
     * @param int|string $overpaymentDepartmentId
     */
    public function setOverpaymentDepartmentId($overpaymentDepartmentId): void
    {
        $this->overpaymentDepartmentId = $overpaymentDepartmentId;
    }

    /**
     * @return string|null
     */
    public function getBillToPayName(): ?string
    {
        return $this->billToPayName;
    }

    /**
     * @param string|null $billToPayName
     */
    public function setBillToPayName(?string $billToPayName): void
    {
        $this->billToPayName = $billToPayName;
    }

    /**
     * Get payment details
     *
     * @return ArPaymentDetail[]
     */
    public function getPaymentDetails()
    {
        return $this->paymentDetails;
    }

    /**
     * Set payment details
     *
     * @param ArPaymentDetail[] $paymentDetails
     */
    public function setPaymentDetails($paymentDetails)
    {
        $this->paymentDetails = $paymentDetails;
    }

    /**
     * @return string|null
     */
    public function getOnlineCardPayment(): ?string
    {
        return $this->onlineCardPayment;
    }

    /**
     * @param string|null $onlineCardPayment
     */
    public function setOnlineCardPayment(?string $onlineCardPayment): void
    {
        $this->onlineCardPayment = $onlineCardPayment;
    }
}
