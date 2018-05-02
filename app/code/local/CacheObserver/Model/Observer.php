<?php

require_once __DIR__.'/../vendor/autoload.php';

use Illuminate\Cache\CacheManager;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Redis\Database;

class CacheObserver_Model_Observer {

    public function __construct(){

        $this->container = new Container;
        $this->container['config'] = [
            'cache.default' => 'redis',
            'cache.stores.redis' => [
                'driver' => 'redis',
                'connection' => 'default'
            ],
            'cache.prefix' => 'ahoom',
            'database.redis' => [
                'cluster' => false,
                'default' => [
                    'host' => 'redis',
                    'port' => 6379,
                    'database' => 0,
                ],
            ]
        ];

        $this->container['redis'] = new Database($this->container['config']['database.redis']);

        $this->cacheManager = new CacheManager($this->container);

        $this->cache = $this->cacheManager->store();

        return $this;

    }

    private function getKey(string $key) {

        return "product:".$key;

    }
    
    public function reload($observer) {

        try{

            $product = $observer->getEvent()->getProduct();
            // var_dump($product);

            $key = $this->getKey($product->getId());

            if ($this->cache->has($key)) {

                Mage::log("Flushing key ". $key, null, 'cache_observer.log', true);

                $this->cache->forget($key);

            }

        } catch(Exception $e){

            // var_dump($e);

            Mage::log($e->getMessage(), null, 'cache_observer.log', true);

        }
    }

}