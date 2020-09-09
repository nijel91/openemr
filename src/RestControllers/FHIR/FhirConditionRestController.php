<?php

/**
 * FhirConditionRestController
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Yash Bothra <yashrajbothra786@gmail.com>
 * @copyright Copyright (c) 2020 Yash Bothra <yashrajbothra786@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\RestControllers\FHIR;

use OpenEMR\Services\FHIR\FhirConditionService;
use OpenEMR\Services\FHIR\FhirResourcesService;
use OpenEMR\RestControllers\RestControllerHelper;
use OpenEMR\FHIR\R4\FHIRResource\FHIRBundle\FHIRBundleEntry;

class FhirConditionRestController
{
    private $fhirConditionService;
    private $fhirService;

    public function __construct()
    {
        $this->fhirConditionService = new FhirConditionService();
        $this->fhirService = new FhirResourcesService();
    }

    /**
     * Queries for a single FHIR condition resource by FHIR id
     * @param $fhirId The FHIR condition resource id (uuid)
     * @returns 200 if the operation completes successfully
     */
    public function getOne($fhirId)
    {
        $processingResult = $this->fhirConditionService->getOne($fhirId);
        return RestControllerHelper::handleProcessingResult($processingResult, 200);
    }

    /**
     * Queries for FHIR condition resources using various search parameters.
     * Search parameters include:
     * - patient (puuid)
     * @return FHIR bundle with query results, if found
     */
    public function getAll($searchParams)
    {
        $processingResult = $this->fhirConditionService->getAll($searchParams);
        $bundleEntries = array();
        foreach ($processingResult->getData() as $index => $searchResult) {
            $bundleEntry = [
                'fullUrl' =>  \RestConfig::$REST_FULL_URL . '/' . $searchResult->getId(),
                'resource' => $searchResult
            ];
            $fhirBundleEntry = new FHIRBundleEntry($bundleEntry);
            array_push($bundleEntries, $fhirBundleEntry);
        }
        $bundleSearchResult = $this->fhirService->createBundle('Condition', $bundleEntries, false);
        $searchResponseBody = RestControllerHelper::responseHandler($bundleSearchResult, null, 200);
        return $searchResponseBody;
    }
}
