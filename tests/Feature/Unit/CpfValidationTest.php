<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Traits\CpfValidator;

class CpfValidationTest extends TestCase
{
    use CpfValidator;

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_validates_a_correct_cpf()
    {
        $this->assertTrue($this->isValidCpf('11144477735'));
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_rejects_an_invalid_cpf()
    {
        $this->assertFalse($this->isValidCpf('12345678900'));
    }
}
