<?php
namespace common\components;

use Yii;
use yii\base\InvalidConfigException;

/**
 * To use redis Cache as the cache application component, configure the application as follows,
 *
 * ~~~
 * [
 *     'components' => [
 *         'cache' => [
 *             'class' => 'common\components\RedisCache',
 *             'redis' => [
 *                 'host' => 'localhost',
 *                 'port' => 6379,
 *                 'database' => 0,
 *             ]
 *         ],
 *     ],
 * ]
 * ~~~
 *
 * Or if you have configured the redis [[Connection]] as an application component, the following is sufficient:
 *
 * ~~~
 * [
 *     'components' => [
 *         'cache' => [
 *             'class' => 'common\components\RedisCache',
 *             // 'redis' => 'redis' // id of the connection application component
 *         ],
 *     ],
 * ]
 * ~~~
 */
class RedisCache extends \yii\caching\Cache
{
    /**
     * @var Connection|string|array the Redis [[Connection]] object or the application component ID of the Redis [[Connection]].
     * This can also be an array that is used to create a redis [[Connection]] instance in case you do not want do configure
     * redis connection as an application component.
     * After the Cache object is created, if you want to change this property, you should only assign it
     * with a Redis [[Connection]] object.
     */
    public $redis = 'redis';


    /**
     * Initializes the redis Cache component.
     * This method will initialize the [[redis]] property to make sure it refers to a valid redis connection.
     * @throws InvalidConfigException if [[redis]] is invalid.
     */
    public function init()
    {
        parent::init();
        if (is_string($this->redis)) {
            $this->redis = Yii::$app->get($this->redis);
        } elseif (is_array($this->redis)) {
            if (!isset($this->redis['class'])) {
                $this->redis['class'] = RedisConnection::className();
            }
            $this->redis = Yii::createObject($this->redis);
        }
        if (!$this->redis instanceof RedisConnection) {
            throw new InvalidConfigException("Cache::redis must be either a RedisConnection instance or the application component ID of a RedisConnection.");
        }
    }

    /**
     * Checks whether a specified key exists in the cache.
     * This can be faster than getting the value from the cache if the data is big.
     * Note that this method does not check whether the dependency associated
     * with the cached data, if there is any, has changed. So a call to [[get]]
     * may return false while exists returns true.
     * @param mixed $key a key identifying the cached value. This can be a simple string or
     * a complex data structure consisting of factors representing the key.
     * @return boolean true if a value exists in cache, false if the value is not in the cache or expired.
     */
    public function exists($key)
    {
        // return (bool) $this->redis->exists([$this->buildKey($key)]);
        return (bool) $this->redis->exists($this->buildKey($key));
    }


    /**
     * @inheritdoc
     */
    protected function getValue($key)
    {
        return $this->redis->get($key);
    }

    /**
     * @inheritdoc
     */
    protected function getValues($keys)
    {
        $response = $this->redis->mGet($keys);
        $result = [];
        $i = 0;
        foreach ($keys as $key) {
            $result[$key] = $response[$i++];
        }
        return $result;
    }

    /**
     * @inheritdoc
     */
    protected function setValue($key, $value, $expire)
    {
        if ($expire == 0) {
            return (bool) $this->redis->set($key, $value);
        } else {
            $expire = (int) ($expire * 1000);
            return (bool) $this->redis->set($key, $value, ['px' => $expire]);
        }
    }

    /**
     * @inheritdoc
     */
    protected function setValues($data, $expire)
    {
        $failedKeys = [];
        if ($expire == 0) {
            $this->redis->mSet($data);
        } else {
            $expire = (int) ($expire * 1000);
            $trans = $this->redis->multi();
            $trans->mSet('MSET', $data);
            $index = [];
            foreach ($data as $key => $value) {
                $this->redis->pexpire($key, $expire);
                $index[] = $key;
            }
            $result = $this->redis->exec();
            array_shift($result);
            foreach ($result as $i => $r) {
                if ($r != 1) {
                    $failedKeys[] = $index[$i];
                }
            }
        }
        return $failedKeys;
    }

    /**
     * @inheritdoc
     */
    protected function addValue($key, $value, $expire)
    {
        if ($expire == 0) {
            return (bool) $this->redis->setnx($key, $value);
        } else {
            return (bool) $this->redis->set($key, $value, ['nx','px'=>intval($expire * 1000)]);
        }
    }

    /**
     * @inheritdoc
     */
    protected function deleteValue($key)
    {
        return (bool) $this->redis->delete($key);
    }

    /**
     * @inheritdoc
     */
    protected function flushValues()
    {
        return true;
        //return $this->redis->flushdb();
    }

    public function buildKey($key)
    {
        if (!is_string($key)) {
            $key = json_encode($key);
        }
        // return $this->keyPrefix . $key;
        return $key;
    }

    /**
     * 这里默认所有score都为0
     */
    public function zAdd($key, $value_or_list, $score=1)
    {
        if (is_array($value_or_list))
        {
            $params = [$key];
            foreach ($value_or_list as $key => $value) {
                $params[] = $key;
                $params[] = $value;
            }
            call_user_func_array([$this->redis, 'zAdd'], $params);
        }
        else
        {
            $this->redis->zAdd($key, $score, $value_or_list);
        }
    }

    public function lPush($key, $value_or_list)
    {
        if (is_array($value_or_list))
        {
            array_unshift($value_or_list, $key);
            $result = call_user_func_array([$this->redis, 'lPush'], $value_or_list);
        }
        else
        {
            $this->redis->lPush($key, $value_or_list);
        }
    }

    /**
     *
     * @param string $name
     * @param array $params
     * @return mixed
     */
    public function __call($name, $params)
    {
        if (is_callable([$this->redis, $name], true))
        {
            return call_user_func_array([$this->redis, $name], $params);
        }
    }
}
