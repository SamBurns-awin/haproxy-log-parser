<?php
namespace AwinHaproxyLogParser\Domain;

class HaproxyHttpLogEntry extends HaproxyLogEntry
{
    public static $docLabel = "http";
    public static $regexp = '/(\S+)\[(\d+)\]: ([\d\.]+):(\d+) \[(\S+)\] (\S+) (\S+)\/(\S+) (\d+)\/(\d+)\/(\d+)\/(\d+)\/(\d+) (\d+) (\d+) (\S) (\S) (\S{4}) (\d+)\/(\d+)\/(\d+)\/(\d+)\/(\d+) (\d+)\/(\d+) {(.*?)} {(.*?)} "(.*?)"$/';
    protected $fields = array(
        'process_name', 'pid',
        'client_ip', 'client_port',
        'accept_date',
        'frontend_name',
        'backend_name', 'server_name',
        'Tq', 'Tw', 'Tc', 'Tr', 'Tt',
        'status_code', 'bytes_read',
        'captured_request_cookie', 'captured_response_cookie',
        'termination_state',
        'actconn', 'feconn', 'beconn', 'srv_conn', 'retries',
        'srv_queue', 'backend_queue',
        'captured_request_headers', 'captured_response_headers',
        'http_request');
}
