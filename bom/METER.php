<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of METER
 *
 * @author Administrator
 */
class METER {
    private $id;
    private $meter_date;
    private $meter_time;
    private $frequency;
    private $voltage1;
    private $voltage2;
    private $voltage3;
    private $voltageAve;
    private $voltageAb;
    private $voltageBc;
    private $voltageCa;
    private $voltageABCAve;
    private $currentIa;
    private $currentIb;
    private $currentIc;
    private $currentAve;
    private $neutralCurrent;
    private $powerPA;
    private $powerPB;
    private $powerPC;
    private $powerPSum;
    private $powerQA;
    private $powerQB;
    private $powerQC;
    private $powerQSum;
    private $powerSA;
    private $powerSB;
    private $powerSC;
    private $powerSSum;
    private $powerFactorPFA;
    private $powerFactorPFB;
    private $powerFactorPFC;
    private $powerFactorPFSum;
    private $voltageFactor;
    private $currentFactor;
    private $loadChar;
    private $powerDemand;
    private $reactivePowerDemand;
    private $apparentPowerDemand;
    private $energyIMP;
    private $energyEXP;
    private $reactiveEnergyIMP;
    private $reactiveEnergyEXP;
    private $energyTotal;
    private $energyNET;
    
    function __construct($id, $meter_date, $meter_time, $frequency, $voltage1, $voltage2, $voltage3, $voltageAve, $voltageAb, $voltageBc, $voltageCa, $voltageABCAve, $currentIa, $currentIb, $currentIc, $currentAve, $neutralCurrent, $powerPA, $powerPB, $powerPC, $powerPSum, $powerQA, $powerQB, $powerQC, $powerQSum, $powerSA, $powerSB, $powerSC, $powerSSum, $powerFactorPFA, $powerFactorPFB, $powerFactorPFC, $powerFactorPFSum, $voltageFactor, $currentFactor, $loadChar, $powerDemand, $reactivePowerDemand, $apparentPowerDemand, $energyIMP, $energyEXP, $reactiveEnergyIMP, $reactiveEnergyEXP, $energyTotal, $energyNET) {
        $this->id = $id;
        $this->meter_date = $meter_date;
        $this->meter_time = $meter_time;
        $this->frequency = $frequency;
        $this->voltage1 = $voltage1;
        $this->voltage2 = $voltage2;
        $this->voltage3 = $voltage3;
        $this->voltageAve = $voltageAve;
        $this->voltageAb = $voltageAb;
        $this->voltageBc = $voltageBc;
        $this->voltageCa = $voltageCa;
        $this->voltageABCAve = $voltageABCAve;
        $this->currentIa = $currentIa;
        $this->currentIb = $currentIb;
        $this->currentIc = $currentIc;
        $this->currentAve = $currentAve;
        $this->neutralCurrent = $neutralCurrent;
        $this->powerPA = $powerPA;
        $this->powerPB = $powerPB;
        $this->powerPC = $powerPC;
        $this->powerPSum = $powerPSum;
        $this->powerQA = $powerQA;
        $this->powerQB = $powerQB;
        $this->powerQC = $powerQC;
        $this->powerQSum = $powerQSum;
        $this->powerSA = $powerSA;
        $this->powerSB = $powerSB;
        $this->powerSC = $powerSC;
        $this->powerSSum = $powerSSum;
        $this->powerFactorPFA = $powerFactorPFA;
        $this->powerFactorPFB = $powerFactorPFB;
        $this->powerFactorPFC = $powerFactorPFC;
        $this->powerFactorPFSum = $powerFactorPFSum;
        $this->voltageFactor = $voltageFactor;
        $this->currentFactor = $currentFactor;
        $this->loadChar = $loadChar;
        $this->powerDemand = $powerDemand;
        $this->reactivePowerDemand = $reactivePowerDemand;
        $this->apparentPowerDemand = $apparentPowerDemand;
        $this->energyIMP = $energyIMP;
        $this->energyEXP = $energyEXP;
        $this->reactiveEnergyIMP = $reactiveEnergyIMP;
        $this->reactiveEnergyEXP = $reactiveEnergyEXP;
        $this->energyTotal = $energyTotal;
        $this->energyNET = $energyNET;
    }

    
    function getId() {
        return $this->id;
    }

    function getMeter_date() {
        return $this->meter_date;
    }

    function getMeter_time() {
        return $this->meter_time;
    }

    function getFrequency() {
        return $this->frequency;
    }

    function getVoltage1() {
        return $this->voltage1;
    }

    function getVoltage2() {
        return $this->voltage2;
    }

    function getVoltage3() {
        return $this->voltage3;
    }

    function getVoltageAve() {
        return $this->voltageAve;
    }

    function getVoltageAb() {
        return $this->voltageAb;
    }

    function getVoltageBc() {
        return $this->voltageBc;
    }

    function getVoltageCa() {
        return $this->voltageCa;
    }

    function getVoltageABCAve() {
        return $this->voltageABCAve;
    }

    function getCurrentIa() {
        return $this->currentIa;
    }

    function getCurrentIb() {
        return $this->currentIb;
    }

    function getCurrentIc() {
        return $this->currentIc;
    }

    function getCurrentAve() {
        return $this->currentAve;
    }

    function getNeutralCurrent() {
        return $this->neutralCurrent;
    }

    function getPowerPA() {
        return $this->powerPA;
    }

    function getPowerPB() {
        return $this->powerPB;
    }

    function getPowerPC() {
        return $this->powerPC;
    }

    function getPowerPSum() {
        return $this->powerPSum;
    }

    function getPowerQA() {
        return $this->powerQA;
    }

    function getPowerQB() {
        return $this->powerQB;
    }

    function getPowerQC() {
        return $this->powerQC;
    }

    function getPowerQSum() {
        return $this->powerQSum;
    }

    function getPowerSA() {
        return $this->powerSA;
    }

    function getPowerSB() {
        return $this->powerSB;
    }

    function getPowerSC() {
        return $this->powerSC;
    }

    function getPowerSSum() {
        return $this->powerSSum;
    }

    function getPowerFactorPFA() {
        return $this->powerFactorPFA;
    }

    function getPowerFactorPFB() {
        return $this->powerFactorPFB;
    }

    function getPowerFactorPFC() {
        return $this->powerFactorPFC;
    }

    function getPowerFactorPFSum() {
        return $this->powerFactorPFSum;
    }

    function getVoltageFactor() {
        return $this->voltageFactor;
    }

    function getCurrentFactor() {
        return $this->currentFactor;
    }

    function getLoadChar() {
        return $this->loadChar;
    }

    function getPowerDemand() {
        return $this->powerDemand;
    }

    function getReactivePowerDemand() {
        return $this->reactivePowerDemand;
    }

    function getApparentPowerDemand() {
        return $this->apparentPowerDemand;
    }

    function getEnergyIMP() {
        return $this->energyIMP;
    }

    function getEnergyEXP() {
        return $this->energyEXP;
    }

    function getReactiveEnergyIMP() {
        return $this->reactiveEnergyIMP;
    }

    function getReactiveEnergyEXP() {
        return $this->reactiveEnergyEXP;
    }

    function getEnergyTotal() {
        return $this->energyTotal;
    }

    function getEnergyNET() {
        return $this->energyNET;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setMeter_date($meter_date) {
        $this->meter_date = $meter_date;
    }

    function setMeter_time($meter_time) {
        $this->meter_time = $meter_time;
    }

    function setFrequency($frequency) {
        $this->frequency = $frequency;
    }

    function setVoltage1($voltage1) {
        $this->voltage1 = $voltage1;
    }

    function setVoltage2($voltage2) {
        $this->voltage2 = $voltage2;
    }

    function setVoltage3($voltage3) {
        $this->voltage3 = $voltage3;
    }

    function setVoltageAve($voltageAve) {
        $this->voltageAve = $voltageAve;
    }

    function setVoltageAb($voltageAb) {
        $this->voltageAb = $voltageAb;
    }

    function setVoltageBc($voltageBc) {
        $this->voltageBc = $voltageBc;
    }

    function setVoltageCa($voltageCa) {
        $this->voltageCa = $voltageCa;
    }

    function setVoltageABCAve($voltageABCAve) {
        $this->voltageABCAve = $voltageABCAve;
    }

    function setCurrentIa($currentIa) {
        $this->currentIa = $currentIa;
    }

    function setCurrentIb($currentIb) {
        $this->currentIb = $currentIb;
    }

    function setCurrentIc($currentIc) {
        $this->currentIc = $currentIc;
    }

    function setCurrentAve($currentAve) {
        $this->currentAve = $currentAve;
    }

    function setNeutralCurrent($neutralCurrent) {
        $this->neutralCurrent = $neutralCurrent;
    }

    function setPowerPA($powerPA) {
        $this->powerPA = $powerPA;
    }

    function setPowerPB($powerPB) {
        $this->powerPB = $powerPB;
    }

    function setPowerPC($powerPC) {
        $this->powerPC = $powerPC;
    }

    function setPowerPSum($powerPSum) {
        $this->powerPSum = $powerPSum;
    }

    function setPowerQA($powerQA) {
        $this->powerQA = $powerQA;
    }

    function setPowerQB($powerQB) {
        $this->powerQB = $powerQB;
    }

    function setPowerQC($powerQC) {
        $this->powerQC = $powerQC;
    }

    function setPowerQSum($powerQSum) {
        $this->powerQSum = $powerQSum;
    }

    function setPowerSA($powerSA) {
        $this->powerSA = $powerSA;
    }

    function setPowerSB($powerSB) {
        $this->powerSB = $powerSB;
    }

    function setPowerSC($powerSC) {
        $this->powerSC = $powerSC;
    }

    function setPowerSSum($powerSSum) {
        $this->powerSSum = $powerSSum;
    }

    function setPowerFactorPFA($powerFactorPFA) {
        $this->powerFactorPFA = $powerFactorPFA;
    }

    function setPowerFactorPFB($powerFactorPFB) {
        $this->powerFactorPFB = $powerFactorPFB;
    }

    function setPowerFactorPFC($powerFactorPFC) {
        $this->powerFactorPFC = $powerFactorPFC;
    }

    function setPowerFactorPFSum($powerFactorPFSum) {
        $this->powerFactorPFSum = $powerFactorPFSum;
    }

    function setVoltageFactor($voltageFactor) {
        $this->voltageFactor = $voltageFactor;
    }

    function setCurrentFactor($currentFactor) {
        $this->currentFactor = $currentFactor;
    }

    function setLoadChar($loadChar) {
        $this->loadChar = $loadChar;
    }

    function setPowerDemand($powerDemand) {
        $this->powerDemand = $powerDemand;
    }

    function setReactivePowerDemand($reactivePowerDemand) {
        $this->reactivePowerDemand = $reactivePowerDemand;
    }

    function setApparentPowerDemand($apparentPowerDemand) {
        $this->apparentPowerDemand = $apparentPowerDemand;
    }

    function setEnergyIMP($energyIMP) {
        $this->energyIMP = $energyIMP;
    }

    function setEnergyEXP($energyEXP) {
        $this->energyEXP = $energyEXP;
    }

    function setReactiveEnergyIMP($reactiveEnergyIMP) {
        $this->reactiveEnergyIMP = $reactiveEnergyIMP;
    }

    function setReactiveEnergyEXP($reactiveEnergyEXP) {
        $this->reactiveEnergyEXP = $reactiveEnergyEXP;
    }

    function setEnergyTotal($energyTotal) {
        $this->energyTotal = $energyTotal;
    }

    function setEnergyNET($energyNET) {
        $this->energyNET = $energyNET;
    }



    
    
}
