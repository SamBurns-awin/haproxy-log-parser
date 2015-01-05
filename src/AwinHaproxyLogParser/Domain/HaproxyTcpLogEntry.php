<?php
namespace AwinHaproxyLogParser\Domain;

class HaproxyTcpLogEntry extends HaproxyLogEntry
{
    public static $docLabel = 'tcp';
    public static $regexp = '/(\S+)\[(\d+)\]: ([\d\.]+):(\d+) \[(\S+)\] (\S+) (\S+)\/(\S+) (\d+)\/(\d+)\/(\d+) (\d+) (\S{2}) (\d+)\/(\d+)\/(\d+)\/(\d+)\/(\d+) (\d+)\/(\d+)$/';
    protected $fields = array(
        'process_name', 'pid',
        'client_ip', 'client_port',
        'accept_date',
        'frontend_name',
        'backend_name', 'server_name',
        'Tw', 'Tc', 'Tt',
        'bytes_read',
        'termination_state',
        'actconn', 'feconn', 'beconn', 'srv_conn', 'retries',
        'srv_queue', 'backend_queue');
}
