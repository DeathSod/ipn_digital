<?php

namespace Google\AdsApi\Dfp\v201708;


/**
 * This file was generated from WSDL. DO NOT EDIT.
 */
class updateReconciliationReportsResponse
{

    /**
     * @var \Google\AdsApi\Dfp\v201708\ReconciliationReport[] $rval
     */
    protected $rval = null;

    /**
     * @param \Google\AdsApi\Dfp\v201708\ReconciliationReport[] $rval
     */
    public function __construct(array $rval = null)
    {
      $this->rval = $rval;
    }

    /**
     * @return \Google\AdsApi\Dfp\v201708\ReconciliationReport[]
     */
    public function getRval()
    {
      return $this->rval;
    }

    /**
     * @param \Google\AdsApi\Dfp\v201708\ReconciliationReport[] $rval
     * @return \Google\AdsApi\Dfp\v201708\updateReconciliationReportsResponse
     */
    public function setRval(array $rval)
    {
      $this->rval = $rval;
      return $this;
    }

}
