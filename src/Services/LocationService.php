<?php

/**
 * LocationService
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Yash Bothra <yashrajbothra786gmail.com>
 * @copyright Copyright (c) 2020 Yash Bothra <yashrajbothra786gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Services;

use OpenEMR\Common\Uuid\UuidRegistry;
use OpenEMR\Common\Uuid\UuidMapping;
use OpenEMR\Validators\BaseValidator;
use OpenEMR\Validators\ProcessingResult;

class LocationService extends BaseService
{
    private const PATIENT_TABLE = "patient_data";
    private const PRACTITIONER_TABLE = "users";
    private const FACILITY_TABLE = "facility";
    private $uuidMapping;

    /**
     * Default constructor.
     */
    public function __construct()
    {
        $this->uuidMapping = new UuidMapping();
        (new UuidRegistry(['table_name' => self::PATIENT_TABLE]))->createMissingUuids();
        $this->uuidMapping->createMissingResourceUuids("Location", self::PATIENT_TABLE);
        (new UuidRegistry(['table_name' => self::PRACTITIONER_TABLE]))->createMissingUuids();
        $this->uuidMapping->createMissingResourceUuids("Location", self::PRACTITIONER_TABLE);
        (new UuidRegistry(['table_name' => self::FACILITY_TABLE]))->createMissingUuids();
        $this->uuidMapping->createMissingResourceUuids("Location", self::FACILITY_TABLE);
    }

    /**
     * Returns a list of locations matching optional search criteria.
     * Search criteria is conveyed by array where key = field/column name, value = field value.
     * If no search criteria is provided, all records are returned.
     *
     * @param  $search search array parameters
     * @param  $isAndCondition specifies if AND condition is used for multiple criteria. Defaults to true.
     * @return ProcessingResult which contains validation messages, internal error messages, and the data
     * payload.
     */
    public function getAll($search = array(), $isAndCondition = true)
    {
        $sqlBindArray = array();

        $sql = 'SELECT location.*, uuid_mapping.uuid FROM 
                (SELECT
                    uuid as target_uuid,
                    CONCAT(fname,"\'s Home") as name,
                    street,
                    city,
                    postal_code,
                    state,
                    country_code,
                    phone_cell as phone,
                    null as fax,
                    null as website,
                    email from patient_data
                UNION SELECT
                    uuid as target_uuid,
                    name,
                    street,
                    city,
                    postal_code,
                    state,
                    country_code,
                    phone,
                    fax,
                    website,
                    email from facility
                UNION SELECT
                    uuid as target_uuid,
                    CONCAT(fname,"\'s Home") as name,
                    street,
                    city,
                    zip as postal_code,
                    state,
                    null as country_code,
                    phone,
                    fax,
                    url as website,
                    email from users) as location
                    LEFT JOIN uuid_mapping ON uuid_mapping.target_uuid=location.target_uuid';

        if (!empty($search)) {
            $sql .= ' WHERE ';
            $whereClauses = array();
            foreach ($search as $fieldName => $fieldValue) {
                array_push($whereClauses, $fieldName . ' = ?');
                array_push($sqlBindArray, $fieldValue);
            }
            $sqlCondition = ($isAndCondition == true) ? 'AND' : 'OR';
            $sql .= implode(' ' . $sqlCondition . ' ', $whereClauses);
        }

        $statementResults = sqlStatement($sql, $sqlBindArray);

        $processingResult = new ProcessingResult();
        while ($row = sqlFetchArray($statementResults)) {
            $row['uuid'] = UuidRegistry::uuidToString($row['uuid']);
            $processingResult->addData($row);
        }

        return $processingResult;
    }

    /**
     * Returns a single location record by id.
     * @param $uuid - The location uuid identifier in string format.
     * @return ProcessingResult which contains validation messages, internal error messages, and the data
     * payload.
     */
    public function getOne($uuid)
    {
        $processingResult = new ProcessingResult();

        $isValid = BaseValidator::validateId(
            "uuid",
            "uuid_mapping",
            $uuid,
            true
        );

        if ($isValid !== true) {
            $validationMessages = [
                'uuid' => ["invalid or nonexisting value" => " value " . $uuid]
            ];
            $processingResult->setValidationMessages($validationMessages);
            return $processingResult;
        }

        $sql = 'SELECT location.*, uuid_mapping.uuid FROM 
                (SELECT
                    uuid as target_uuid,
                    CONCAT(fname,"\'s Home") as name,
                    street,
                    city,
                    postal_code,
                    state,
                    country_code,
                    phone_cell as phone,
                    null as fax,
                    null as website,
                    email from patient_data
                UNION SELECT
                    uuid as target_uuid,
                    name,
                    street,
                    city,
                    postal_code,
                    state,
                    country_code,
                    phone,
                    fax,
                    website,
                    email from facility
                UNION SELECT
                    uuid as target_uuid,
                    CONCAT(fname,"\'s Home") as name,
                    street,
                    city,
                    zip as postal_code,
                    state,
                    null as country_code,
                    phone,
                    fax,
                    url as website,
                    email from users) as location
                    LEFT JOIN uuid_mapping ON uuid_mapping.target_uuid=location.target_uuid
                    WHERE uuid_mapping.uuid=?';

        $uuidBinary = UuidRegistry::uuidToBytes($uuid);
        $sqlResult = sqlQuery($sql, [$uuidBinary]);
        $sqlResult['uuid'] = UuidRegistry::uuidToString($sqlResult['uuid']);
        $processingResult->addData($sqlResult);
        return $processingResult;
    }
}
