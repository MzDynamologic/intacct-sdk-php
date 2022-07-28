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

use Intacct\Functions\AbstractFunction;
use Intacct\Functions\Traits\CustomFieldsTrait;

abstract class AbstractProjectEstimateEntry extends AbstractFunction
{

    use CustomFieldsTrait;

    /** @var string */
    protected $projectEstimateId;

    /** @var string */
    protected $externalUnitOfMeasure;

    /** @var float|int|string */
    protected $quantity;

    /** @var float|string */
    protected $unitCost;

    /** @var float|string */
    protected $amount;

    /** @var string */
    protected $memo;

    /** @var string */
    protected $workflowType;

    /** @var float|int|string */
    protected $productionUnits;

    /** @var string */
    protected $accountNumber;

    /** @var string */
    protected $departmentId;

    /** @var string */
    protected $customerId;

    /** @var string */
    protected $employeeId;

    /** @var string */
    protected $itemId;

    /** @var string */
    protected $contractId;

    /** @var bool */
    protected $taskId;

    /** @var string */
    protected $costTypeId;

    /** @var string */
    protected $vendorId;

    /** @var string */
    protected $classId;

    /** @var \DateTime */
    protected $effectiveDate;

    /**
     * @return string
     */
    public function getProjectEstimateId()
    {
        return $this->projectEstimateId;
    }

    /**
     * @param string $projectEstimateId
     */
    public function setProjectEstimateId($projectEstimateId)
    {
        $this->projectEstimateId = $projectEstimateId;
    }

    /**
     * @return string
     */
    public function getExternalUnitOfMeasure()
    {
        return $this->externalUnitOfMeasure;
    }

    /**
     * @param string $externalUnitOfMeasure
     */
    public function setExternalUnitOfMeasure($externalUnitOfMeasure)
    {
        $this->externalUnitOfMeasure = $externalUnitOfMeasure;
    }

    /**
     * @return float|int|string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param float|int|string $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float|string
     */
    public function getUnitCost()
    {
        return $this->unitCost;
    }

    /**
     * @param float|string $unitCost
     */
    public function setUnitCost($unitCost)
    {
        $this->unitCost = $unitCost;
    }

    /**
     * @return float|string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float|string $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * @param string $memo
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;
    }

    /**
     * @return string
     */
    public function getWorkflowType()
    {
        return $this->workflowType;
    }

    /**
     * @param string $workflowType
     */
    public function setWorkflowType($workflowType)
    {
        $this->workflowType = $workflowType;
    }

    /**
     * @return float|int|string
     */
    public function getProductionUnits()
    {
        return $this->productionUnits;
    }

    /**
     * @param float|int|string $productionUnits
     */
    public function setProductionUnits($productionUnits)
    {
        $this->productionUnits = $productionUnits;
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @param string $accountNumber
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    /**
     * @return string
     */
    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    /**
     * @param string $departmentId
     */
    public function setDepartmentId($departmentId)
    {
        $this->departmentId = $departmentId;
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param string $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return string
     */
    public function getExmployeeId()
    {
        return $this->employeeId;
    }

    /**
     * @param string $employeeId
     */
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;
    }

    /**
     * @return string
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param string $itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * @return string
     */
    public function getContractId()
    {
        return $this->contractId;
    }

    /**
     * @param string $contractId
     */
    public function setContractId($contractId)
    {
        $this->contractId = $contractId;
    }

    /**
     * @return string
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * @param string $taskId
     */
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
    }

    /**
     * @return string
     */
    public function getCostTypeId()
    {
        return $this->costTypeId;
    }

    /**
     * @param string $costTypeId
     */
    public function setCostTypeId($costTypeId)
    {
        $this->costTypeId = $costTypeId;
    }

    /**
     * @return string
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     * @param string $vendorId
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    /**
     * @return string
     */
    public function getClassId()
    {
        return $this->classId;
    }

    /**
     * @param string $classId
     */
    public function setClassId($classId)
    {
        $this->classId = $classId;
    }

    /**
     * @return \DateTime
     */
    public function getEffectiveDate()
    {
        return $this->effectiveDate;
    }

    /**
     * @param \DateTime $effectiveDate
     */
    public function setEffectiveDate($effectiveDate)
    {
        $this->effectiveDate = $effectiveDate;
    }

}
