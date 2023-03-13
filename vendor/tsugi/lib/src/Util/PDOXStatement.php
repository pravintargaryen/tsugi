<?php

namespace Tsugi\Util;

use \Tsugi\Util\PS;

/**
 * This is our "improved" version of PDOStatement
 *
     * If the prepare() fails, we fake up a stdClass() with a few
     * fields that mimic a simple failed execute().
     *
     *     $stmt->errorCode
     *     $stmt->errorInfo
     *
     * We also augment the real or fake PDOStatement with these fields:
     *
     *     $stmt->success
     *     $stmt->ellapsed_time
     *     $stmt->errorImplode
     *
     * <var>$stmt->success</var> is TRUE/FALSE based on the success of the operation
     * to simplify error checking
     *
     * <var>$stmt->ellapsed_time</var> includes the length of time the query took
     *
     * <var>$stmt->errorImplode</var> an imploded version of errorInfo suitable for
     * dropping into a log.
 */
// https://www.php.net/manual/en/pdo.setattribute.php
// https://www.php.net/manual/en/class.pdostatement.php
class PDOXStatement extends \PDOStatement {

    public $success;
    public $ellapsed_time;
    public $errorImplode;
    public $sqlQuery;
    public $sqlOriginalQuery;

    public $errorCodeOverride = null;
    public $errorInfoOverride = null;

    protected function __construct() {
        error_log("In PDOXStatement constructor");
    }
    #[\ReturnTypeWillChange]
    public function errorCode() {
        error_log("In PDOXStatement errorCode");
        if ( $this->errorCodeOverride != null ) return $errorCodeOverride;
        return parent::errorCode();
    }
    #[\ReturnTypeWillChange]
    public function errorInfo() {
        error_log("In PDOXStatement errorInfo");
        if ( $this->errorInfoOverride != null ) return $errorInfoOverride;
        return parent::errorInfo();
    }
}