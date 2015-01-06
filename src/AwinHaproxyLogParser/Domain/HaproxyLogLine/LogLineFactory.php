<?php
namespace AwinHaproxyLogParser\Domain\HaproxyLogLine;

class LogLineFactory
{
    /**
     * @param $lineAsText
     * @return LogLine
     */
    public function createLogLine($lineAsText)
    {
        $noOfTextFields = $this->countTextFields($lineAsText);

        switch ($noOfTextFields) {
            case 18:
                return new HttpLogLine();
            case 10:
                return new TcpLogLine();
            default:
                throw new \InvalidArgumentException('Don\'t know what to do with text lines of ' . $noOfTextFields . ' fields');
        }
    }

    /**
     * @param string $lineAsText
     * @return int
     */
    private function countTextFields($lineAsText)
    {
        return count(explode(' ', $lineAsText));
    }
}
