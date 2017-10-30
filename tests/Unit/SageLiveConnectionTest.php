<?php

namespace Tests\Unit;

class SageLiveConnectionTest extends SageLiveBaseTest
{
    /** @test */
    public function can_get_oauth_access_token_from_sage_live()
    {
        $this->sageApi->loginBasic(getenv('TEST_SAGE_USERNAME'), getenv('TEST_SAGE_PASSWORD'), getenv('TEST_SAGE_SECURITY_TOKEN'));
        $this->assertNotNull($this->sageApi->access_token);
    }
}
