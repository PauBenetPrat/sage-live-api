<?php

namespace Tests\Unit;

use RevoSystems\SageLiveApi\SageApi;
use RevoSystems\SageLiveApi\SObjects\SageProduct;

class SageLiveProductsTest extends SageLiveBaseTest {

    /** @test */
    public function can_create_sage_product() {
        $this->sageLogin();
        $clientResource = (new SageProduct($this->sageApi));
        $products_count = $clientResource->count();

        $this->object = (new SageProduct($this->sageApi, [
            "Name"      => "Nike Nuce",
            "IsActive"  => 1,
        ]))->create();

        $this->assertNotNull( $this->object->Id );
        $this->assertNotEmpty( $this->object->tags );
        $this->assertEquals( $products_count + 1, $clientResource->count());
    }

    /** @test */
    public function can_get_sage_products() {
        $this->sageLogin();

        $this->object = (new SageProduct($this->sageApi, [
            "Name"      => "Nike Tomal",
            "IsActive"  => 1,
        ]))->create();

        $this->assertGreaterThanOrEqual(1, (new SageProduct($this->sageApi))->count());
    }

    /** @test */
    public function can_see_a_sage_product() {
        $this->sageLogin();
        $this->object = (new SageProduct($this->sageApi, [
            "Name"      => "Nike Tomaleos",
            "IsActive"  => 1,
        ]))->create();

        $productRetrieved = (new SageProduct($this->sageApi))->find($this->object->Id);
        $this->assertEquals($this->object->Id,    $productRetrieved->Id);
        $this->assertEquals('Nike Tomaleos', $productRetrieved->Name);
    }

    /** @test */
    public function can_delete_sage_product() {
        $this->sageLogin();
        $this->object = (new SageProduct($this->sageApi, [
            "Name"      => "Nike Tomaleos",
            "IsActive"  => 1,
        ]))->create();
        $sageResource = (new SageProduct($this->sageApi));
        $products_count = $sageResource->count();

        $this->object->destroy();
        $actual_products_count =  $sageResource->count();

        $this->assertEquals( $products_count - 1, $actual_products_count);
    }

}
