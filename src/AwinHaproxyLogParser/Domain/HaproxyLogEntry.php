<?php
namespace AwinHaproxyLogParser\Domain;

class HaproxyLogEntry
{
    public function __construct($matches)
    {
        for ($i=0; $i<count($matches); $i++) {
            $this->{$this->fields[$i]} = $matches[$i];
        }
    }
}
