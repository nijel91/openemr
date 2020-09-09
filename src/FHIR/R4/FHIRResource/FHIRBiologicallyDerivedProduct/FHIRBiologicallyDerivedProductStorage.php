<?php

namespace OpenEMR\FHIR\R4\FHIRResource\FHIRBiologicallyDerivedProduct;

/*!
 * This class was generated with the PHPFHIR library (https://github.com/dcarbone/php-fhir) using
 * class definitions from HL7 FHIR (https://www.hl7.org/fhir/)
 *
 * Class creation date: June 14th, 2019
 *
 * PHPFHIR Copyright:
 *
 * Copyright 2016-2017 Daniel Carbone (daniel.p.carbone@gmail.com)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *        http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 *
 * FHIR Copyright Notice:
 *
 *   Copyright (c) 2011+, HL7, Inc.
 *   All rights reserved.
 *
 *   Redistribution and use in source and binary forms, with or without modification,
 *   are permitted provided that the following conditions are met:
 *
 *    * Redistributions of source code must retain the above copyright notice, this
 *      list of conditions and the following disclaimer.
 *    * Redistributions in binary form must reproduce the above copyright notice,
 *      this list of conditions and the following disclaimer in the documentation
 *      and/or other materials provided with the distribution.
 *    * Neither the name of HL7 nor the names of its contributors may be used to
 *      endorse or promote products derived from this software without specific
 *      prior written permission.
 *
 *   THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 *   ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 *   WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 *   IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT,
 *   INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT
 *   NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 *   PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 *   WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 *   ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 *   POSSIBILITY OF SUCH DAMAGE.
 *
 *
 *   Generated on Thu, Dec 27, 2018 22:37+1100 for FHIR v4.0.0
 *
 *   Note: the schemas & schematrons do not contain all of the rules about what makes resources
 *   valid. Implementers will still need to be familiar with the content of the specification and with
 *   any profiles that apply to the resources in order to make a conformant implementation.
 *
 */

use OpenEMR\FHIR\R4\FHIRElement\FHIRBackboneElement;

/**
 * A material substance originating from a biological entity intended to be transplanted or infused
into another (possibly the same) biological entity.
 */
class FHIRBiologicallyDerivedProductStorage extends FHIRBackboneElement implements \JsonSerializable
{
    /**
     * Description of storage.
     * @var \OpenEMR\FHIR\R4\FHIRElement\FHIRString
     */
    public $description = null;

    /**
     * Storage temperature.
     * @var \OpenEMR\FHIR\R4\FHIRElement\FHIRDecimal
     */
    public $temperature = null;

    /**
     * Temperature scale used.
     * @var \OpenEMR\FHIR\R4\FHIRElement\FHIRBiologicallyDerivedProductStorageScale
     */
    public $scale = null;

    /**
     * Storage timeperiod.
     * @var \OpenEMR\FHIR\R4\FHIRElement\FHIRPeriod
     */
    public $duration = null;

    /**
     * @var string
     */
    private $_fhirElementName = 'BiologicallyDerivedProduct.Storage';

    /**
     * Description of storage.
     * @return \OpenEMR\FHIR\R4\FHIRElement\FHIRString
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Description of storage.
     * @param \OpenEMR\FHIR\R4\FHIRElement\FHIRString $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Storage temperature.
     * @return \OpenEMR\FHIR\R4\FHIRElement\FHIRDecimal
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Storage temperature.
     * @param \OpenEMR\FHIR\R4\FHIRElement\FHIRDecimal $temperature
     * @return $this
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
        return $this;
    }

    /**
     * Temperature scale used.
     * @return \OpenEMR\FHIR\R4\FHIRElement\FHIRBiologicallyDerivedProductStorageScale
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Temperature scale used.
     * @param \OpenEMR\FHIR\R4\FHIRElement\FHIRBiologicallyDerivedProductStorageScale $scale
     * @return $this
     */
    public function setScale($scale)
    {
        $this->scale = $scale;
        return $this;
    }

    /**
     * Storage timeperiod.
     * @return \OpenEMR\FHIR\R4\FHIRElement\FHIRPeriod
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Storage timeperiod.
     * @param \OpenEMR\FHIR\R4\FHIRElement\FHIRPeriod $duration
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return string
     */
    public function get_fhirElementName()
    {
        return $this->_fhirElementName;
    }

    /**
     * @param mixed $data
     */
    public function __construct($data = [])
    {
        if (is_array($data)) {
            if (isset($data['description'])) {
                $this->setDescription($data['description']);
            }
            if (isset($data['temperature'])) {
                $this->setTemperature($data['temperature']);
            }
            if (isset($data['scale'])) {
                $this->setScale($data['scale']);
            }
            if (isset($data['duration'])) {
                $this->setDuration($data['duration']);
            }
        } elseif (null !== $data) {
            throw new \InvalidArgumentException('$data expected to be array of values, saw "' . gettype($data) . '"');
        }
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->get_fhirElementName();
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $json = parent::jsonSerialize();
        if (isset($this->description)) {
            $json['description'] = $this->description;
        }
        if (isset($this->temperature)) {
            $json['temperature'] = $this->temperature;
        }
        if (isset($this->scale)) {
            $json['scale'] = $this->scale;
        }
        if (isset($this->duration)) {
            $json['duration'] = $this->duration;
        }
        return $json;
    }

    /**
     * @param boolean $returnSXE
     * @param \SimpleXMLElement $sxe
     * @return string|\SimpleXMLElement
     */
    public function xmlSerialize($returnSXE = false, $sxe = null)
    {
        if (null === $sxe) {
            $sxe = new \SimpleXMLElement('<BiologicallyDerivedProductStorage xmlns="http://hl7.org/fhir"></BiologicallyDerivedProductStorage>');
        }
        parent::xmlSerialize(true, $sxe);
        if (isset($this->description)) {
            $this->description->xmlSerialize(true, $sxe->addChild('description'));
        }
        if (isset($this->temperature)) {
            $this->temperature->xmlSerialize(true, $sxe->addChild('temperature'));
        }
        if (isset($this->scale)) {
            $this->scale->xmlSerialize(true, $sxe->addChild('scale'));
        }
        if (isset($this->duration)) {
            $this->duration->xmlSerialize(true, $sxe->addChild('duration'));
        }
        if ($returnSXE) {
            return $sxe;
        }
        return $sxe->saveXML();
    }
}
