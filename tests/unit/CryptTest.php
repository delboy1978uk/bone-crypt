<?php

namespace BoneTest;

use Bone\Crypt\Crypt;
use Codeception\TestCase\Test;

class CryptTest extends Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Crypt
     */
    protected $crypt;

    protected function _before()
    {
        $this->crypt = new Crypt();
    }

    protected function _after()
    {
        unset($this->crypt);
    }

    /**
     * Check tests are working
     */
    public function testEncryptAndDecrypt()
    {
        $encrypted = $this->crypt->encrypt('Ready to start building tests');
        $key = $encrypted['key'];
        unset($encrypted['key']);
        $json = \json_encode($encrypted);
        $result = $this->crypt->decrypt($json, $key);

        $this->assertEquals('Ready to start building tests', $result);
    }
}
