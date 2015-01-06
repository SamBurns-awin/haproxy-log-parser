<?php
namespace AwinHaproxyLogParser\Domain\HaproxyLogLine;

class HttpLogLine implements LogLine
{
    /** @var string[] */
    private $fieldNames = array(
        'process_name',
        'pid',
        'client_ip',
        'client_port',
        'accept_date',
        'frontend_name',
        'backend_name',
        'server_name',
        'Tq',
        'Tw',
        'Tc',
        'Tr',
        'Tt',
        'status_code',
        'bytes_read',
        'captured_request_cookie',
        'captured_response_cookie',
        'termination_state',
        'actconn',
        'feconn',
        'beconn',
        'srv_conn',
        'retries',
        'srv_queue',
        'backend_queue',
        'captured_request_headers',
        'captured_response_headers',
        'http_request'
    );

    /** @var string */
    private $logLineAssocArray = array();

    /**
     * @param string[] $logLineAsNumericalArray
     */
    public function __construct($logLineAsNumericalArray)
    {
        $logLineArrayKeys = $this->fieldNames;

        foreach ($logLineAsNumericalArray as $logLineField) {
            $this->logLineAssocArray[array_shift($logLineArrayKeys)] = $logLineField;
        }
    }

    /**
     * @param string $fieldName
     */
    public function getFieldByName($fieldName)
    {
        return $this->logLineAssocArray[$fieldName];
    }
}
