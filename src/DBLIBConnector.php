<?php
namespace PhpDbLib\Database;

use Illuminate\Database\Connectors\Connector as BaseConnector;
use Illuminate\Database\Connectors\ConnectorInterface;

class DBLIBConnector extends BaseConnector implements ConnectorInterface
{
    /**
     * @throws \Exception
     */
    public function connect(array $config)
    {
        $options = $this->getOptions($config);
        $dsn = $this->getDsn($config);
        return $this->createConnection($dsn, $config, $options);
    }

    protected function getDsn(array $params): string
    {
        $dsn = "dblib:";
        if (isset($params['host'])) {
            $dsn .= 'host='.$params['host'];
        }
        if (isset($params['port']) && '' !== $params['port']) {
            $dsn .= ';port='.$params['port'];
        }

        if (isset($params['dbname'])) {
            $dsn .= ';dbname='.$params['dbname'];
        }

        return $dsn;
    }
}
