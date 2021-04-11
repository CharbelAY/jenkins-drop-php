<?php

namespace app\unit_test;
use PHPUnit\Framework\TestCase;


class CounterClass
{
    private $counter;

    /**
     * @return mixed
     */
    public function getCounter()
    {
        return $this->counter;
    }

    /**
     * @param mixed $counter
     */
    public function setCounter($counter)
    {
        $this->counter = $counter;
    }

    public function decrementCounter($amount){
        $this->counter-=$amount;
    }

    /**
     * CounterClass constructor.
     * @param $counter
     */
    public function __construct($counter)
    {
        $this->counter = $counter;
    }





}


class CounterTest extends TestCase
{

    private CounterClass $counterClass;

    protected function setUp(): void
    {
        $this->counterClass=new CounterClass(100);
    }

    public function testCanBeDecrementedCorrectly():void{
        $this->counterClass->decrementCounter(1);
        $this->assertEquals(99,$this->counterClass->getCounter(),"Counter was not decremented successfully");
    }

    public function testCanBeSetCorrectly():void{
        $this->counterClass->setCounter(45);
        $this->assertEquals(45,$this->counterClass->getCounter(),"Counter was not set correctly");
    }
}