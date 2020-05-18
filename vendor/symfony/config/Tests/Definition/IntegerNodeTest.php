<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5ea00cc67502b\Symfony\Component\Config\Tests\Definition;

use _PhpScoper5ea00cc67502b\PHPUnit\Framework\TestCase;
use _PhpScoper5ea00cc67502b\Symfony\Component\Config\Definition\IntegerNode;
class IntegerNodeTest extends \_PhpScoper5ea00cc67502b\PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getValidValues
     */
    public function testNormalize($value)
    {
        $node = new \_PhpScoper5ea00cc67502b\Symfony\Component\Config\Definition\IntegerNode('test');
        $this->assertSame($value, $node->normalize($value));
    }
    /**
     * @dataProvider getValidValues
     *
     * @param int $value
     */
    public function testValidNonEmptyValues($value)
    {
        $node = new \_PhpScoper5ea00cc67502b\Symfony\Component\Config\Definition\IntegerNode('test');
        $node->setAllowEmptyValue(\false);
        $this->assertSame($value, $node->finalize($value));
    }
    public function getValidValues()
    {
        return [[1798], [-678], [0]];
    }
    /**
     * @dataProvider getInvalidValues
     */
    public function testNormalizeThrowsExceptionOnInvalidValues($value)
    {
        $this->expectException('_PhpScoper5ea00cc67502b\\Symfony\\Component\\Config\\Definition\\Exception\\InvalidTypeException');
        $node = new \_PhpScoper5ea00cc67502b\Symfony\Component\Config\Definition\IntegerNode('test');
        $node->normalize($value);
    }
    public function getInvalidValues()
    {
        return [[null], [''], ['foo'], [\true], [\false], [0.0], [0.1], [[]], [['foo' => 'bar']], [new \stdClass()]];
    }
}
