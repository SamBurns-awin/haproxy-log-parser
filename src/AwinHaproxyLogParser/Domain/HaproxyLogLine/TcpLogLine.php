<?php
namespace AwinHaproxyLogParser\Domain\HaproxyLogLine;

class TcpLogLine extends AbstractLogLine implements LogLine
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
            'Tw',
            'Tc',
            'Tt',
            'bytes_read',
            'termination_state',
            'actconn',
            'feconn',
            'beconn',
            'srv_conn',
            'retries',
            'srv_queue',
            'backend_queue'
        );
    }

    /**
     * @return string
     */
    public function getDocLabel()
    {
        return 'tcp';
    }
}
