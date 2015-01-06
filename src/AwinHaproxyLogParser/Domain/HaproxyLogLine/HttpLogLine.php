<?php
namespace AwinHaproxyLogParser\Domain\HaproxyLogLine;

class HttpLogLine extends AbstractLogLine implements LogLine
{
    /**
     * @return string[]
     */
    protected function getFieldNames()
    {
        return array(
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
    }

    /**
     * @return string
     */
    public function getDocLabel()
    {
        return 'http';
    }
}
