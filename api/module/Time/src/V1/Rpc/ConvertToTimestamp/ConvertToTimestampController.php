<?php

namespace Time\V1\Rpc\ConvertToTimestamp;

use Laminas\Mvc\Controller\AbstractActionController;

class ConvertToTimestampController extends AbstractActionController
{
    public function convertToTimestampAction()
    {
        return [
            'timestamp' => strtotime($this->getInputFilter()->get('date')->getValue())
        ];
    }
}
