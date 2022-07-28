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

abstract class AbstractProjectEstimate extends AbstractFunction
{

    use CustomFieldsTrait;

    /** @var string */
    protected $projectEstimateId;

    /** @var string */
    protected $description;

    /** @var bool */
    protected $isPrimary;

    /** @var bool */
    protected $posted;

    /** @var string */
    protected $projectEstimateTypeName;

    /** @var string */
    protected $glBudgetId;

    /** @var \DateTime */
    protected $estimateDate;

    /** @var bool */
    protected $postTo;

    /** @var string */
    protected $projectId;

    /** @var string */
    protected $status;

    /** @var AbstractProjectEstimateEntry[] */
    protected $entries = [];

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    /**
     * @param bool $isPrimary
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;
    }

    /**
     * @return bool
     */
    public function getPosted()
    {
        return $this->posted;
    }

    /**
     * @param bool $posted
     */
    public function setPosted($posted)
    {
        $this->posted = $posted;
    }

    /**
     * @return string
     */
    public function getProjectEstimateTypeName()
    {
        return $this->projectEstimateTypeName;
    }

    /**
     * @param string $projectEstimateTypeName
     */
    public function setProjectEstimateTypeName($projectEstimateTypeName)
    {
        $this->projectEstimateTypeName = $projectEstimateTypeName;
    }

    /**
     * @return string
     */
    public function getIGlBudgetId()
    {
        return $this->glBudgetId;
    }

    /**
     * @param string $glBudgetId
     */
    public function setGlBudgetId($glBudgetId)
    {
        $this->glBudgetId = $glBudgetId;
    }

    /**
     * @return \DateTime
     */
    public function getEstimateDate()
    {
        return $this->estimateDate;
    }

    /**
     * @param \DateTime $estimateDate
     */
    public function setEstimateDate($estimateDate)
    {
        $this->estimateDate = $estimateDate;
    }

    /**
     * @return bool
     */
    public function getPostTo()
    {
        return $this->postTo;
    }

    /**
     * @param bool $postTo
     */
    public function setPostTo($postTo)
    {
        $this->postTo = $postTo;
    }

    /**
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @param string $projectId
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return AbstractProjectEstimateEntry[]
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * @param AbstractProjectEstimateEntry[] $entries
     */
    public function setEntries($entries)
    {
        $this->entries = $entries;
    }

}
