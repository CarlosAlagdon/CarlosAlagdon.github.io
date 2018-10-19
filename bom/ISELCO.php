<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ISELCO
 *
 * @author MDC DCIM
 */
class ISELCO {
    private $id;
    private $date;
    private $time;
    private $Vab;
    private $Vbc;
    private $Vca;
    private $Ia;
    private $Ib;
    private $Ic;
    private $mwt;
    private $pf;
    private $tempOil;
    private $tempWndg;
    private $tapSet;
    private $wCond;
    
    function __construct($id, $date, $time, $Vab, $Vbc, $Vca, $Ia, $Ib, $Ic, $mwt, $pf, $tempOil, $tempWndg, $tapSet, $wCond) {
        $this->id = $id;
        $this->date = $date;
        $this->time = $time;
        $this->Vab = $Vab;
        $this->Vbc = $Vbc;
        $this->Vca = $Vca;
        $this->Ia = $Ia;
        $this->Ib = $Ib;
        $this->Ic = $Ic;
        $this->mwt = $mwt;
        $this->pf = $pf;
        $this->tempOil = $tempOil;
        $this->tempWndg = $tempWndg;
        $this->tapSet = $tapSet;
        $this->wCond = $wCond;
    }

    function getId() {
        return $this->id;
    }

    function getDate() {
        return $this->date;
    }

    function getTime() {
        return $this->time;
    }

    function getVab() {
        return $this->Vab;
    }

    function getVbc() {
        return $this->Vbc;
    }

    function getVca() {
        return $this->Vca;
    }

    function getIa() {
        return $this->Ia = $Ia;
    }

    function getIb() {
        return $this->Ib = $Ib;
    }

    function getIc() {
        return $this->Ic = $Ic;
    }

    function getMwt() {
        return $this->mwt = $mwt;
    }

    function getPf() {
        return $this->pf = $pf;
    }

    function getTempOil() {
        return $this->tempOil;
    }

    function getTempWndg() {
        return $this->tempWndg;
    }

    function getTapSet() {
        return $this->tapSet;
    }

    function getWCond() {
        return $this->wCond;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setTime($time) {
        $this->time = $time;
    }

    function setVab($Vab) {
        $this->Vab = $Vab;
    }

    function setVbc($Vbc) {
        $this->Vbc = $Vbc;
    }

    function setVca($Vca) {
        $this->Vca = $Vca;
    }

    function setIa($Ia) {
        $this->Ia = $Ia;
    }

    function setIb($Ib) {
        $this->Ib = $Ib;
    }

    function setIc($Ic) {
        $this->Ic = $Ic;
    }

    function setMwt($mwt) {
        $this->mwt = $mwt;
    }

    function setPf($pf) {
        $this->pf = $pf;
    }

    function setTempOil($tempOil) {
        $this->tempOil = $tempOil;
    }

    function setTempWndg($tempWndg) {
        $this->tempWndg = $tempWndg;
    }

    function setTapSet($tapSet) {
        $this->tapSet = $tapSet;
    }

    function setWCond($wCond) {
        $this->wCond = $wCond;
    }


}
