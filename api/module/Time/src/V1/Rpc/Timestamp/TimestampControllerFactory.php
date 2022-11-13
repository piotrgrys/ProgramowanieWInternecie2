<?php
namespace Time\V1\Rpc\Timestamp;

class TimestampControllerFactory
{
    public function __invoke($controllers)
    {
        return new TimestampController();
    }
}
