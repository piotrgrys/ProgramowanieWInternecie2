<?php
namespace Time\V1\Rpc\ConvertToTimestamp;

class ConvertToTimestampControllerFactory
{
    public function __invoke($controllers)
    {
        return new ConvertToTimestampController();
    }
}
