<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
    * Default preparation for each test
    */
    public function setUp()
    {
        parent::setUp();

        $this->prepare();
    }

    /**
     * Default depreparation of tests
     */
    public function tearDown()
    {
        parent::tearDown();

        $this->rollBack();
    }
    
    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;
        $testEnvironment = "testing";

        return require __DIR__."/../../bootstrap/start.php";
    }
    
    /**
    * Prepare for testing
    */
    private function prepare()
    {
        Artisan::call('migrate');
        Mail::pretend(true);
    }
    
    /**
    * Rollback after testing
    */
    private function rollBack()
    {
        Artisan::call('migrate:reset');
        Mail::pretend(false);
    }
}
