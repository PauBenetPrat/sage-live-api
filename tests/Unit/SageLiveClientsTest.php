<?php

namespace Tests\Unit;

use RevoSystems\SageLiveApi\SObjects\SageClient;

class SageLiveClientsTest extends SageLiveBaseTest {

    /** @test */
    public function can_create_sage_client() {
        $this->sageLogin();
        $clientResource = (new SageClient($this->sageApi));
        $clients_count = $clientResource->count();

        $this->object = (new SageClient($this->sageApi, [
            "Name" => "Jordi",
        ]))->create();

        $this->assertNotFalse( $this->object->id );
        $this->assertNotEmpty( $this->object->tags );
        $this->assertEquals( $clients_count + 1, $clientResource->count());
    }

    /** @test */
    public function can_get_sage_clients() {
        $this->sageLogin();

        $this->object = (new SageClient($this->sageApi, [
            "Name" => "Jordi",
        ]))->create();

        $this->assertGreaterThanOrEqual(1, (new SageClient($this->sageApi))->count());

    }

    /** @test */
    public function can_see_a_sage_client() {
        $this->sageLogin();
        $this->object = (new SageClient($this->sageApi, [
            "Name" => "Jordi",
        ]))->create();

        $client = (new SageClient($this->sageApi))->find($this->object->Id);
        $this->assertEquals($this->object->Id,   $client->Id);
        $this->assertEquals('Jordi',             $client->Name);
    }

    /** @test */
    public function can_delete_sage_client() {
        $this->sageLogin();
        $this->object = (new SageClient($this->sageApi, [
            "Name" => "Jordi",
        ]))->create();
        $clients_count = (new SageClient($this->sageApi))->count();

        $this->object->destroy();
        $actual_clients_count =  (new SageClient($this->sageApi))->count();

        $this->assertEquals( $clients_count - 1, $actual_clients_count);
    }
}
