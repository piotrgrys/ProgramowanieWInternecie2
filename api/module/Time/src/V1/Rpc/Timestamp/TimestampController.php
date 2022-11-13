<?php

namespace Time\V1\Rpc\Timestamp;

use Laminas\Mvc\Controller\AbstractActionController;

class TimestampController extends AbstractActionController
{
    public function timestampAction()
    {
        return ['timestamp' => time()];
    }
}
