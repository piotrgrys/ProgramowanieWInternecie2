<?php

namespace Maps\Model;

use Laminas\Db\Adapter as DbAdapter;
use Laminas\Db\Sql\Sql;

class Mapmarker implements DbAdapter\AdapterAwareInterface
{
    use DbAdapter\AdapterAwareTrait;

    public function pobierzWszystko()
    {
        $dbAdapter = $this->adapter;
        $sql = new Sql($dbAdapter);
        $select = $sql->select('mapmarkers');
        $selectString = $sql->buildSqlString($select);

        return $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
    }
}
