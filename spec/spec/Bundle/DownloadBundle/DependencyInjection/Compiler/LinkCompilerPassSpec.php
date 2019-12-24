<?php

declare(strict_types = 1);

namespace spec\App\Bundle\DownloadBundle\DependencyInjection\Compiler;

use App\Bundle\DownloadBundle\DependencyInjection\Compiler\LinkCompilerPass;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class LinkCompilerPassSpec extends ObjectBehavior
{
    private const DEFINITION = 'App\Bundle\DownloadBundle\Link\LinkContext';
    private const TAGS = 'link_strategy';
    private const DEFINITION_ID = 'definition_id';

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(LinkCompilerPass::class);
    }

    public function it_should_not_add_method_call_when_definition_is_found(
        ContainerBuilder $containerBuilder,
        Definition $definition
    ): void
    {
        $containerBuilder->findDefinition(self::DEFINITION)->willReturn($definition);
        $containerBuilder->findTaggedServiceIds(self::TAGS)->willReturn([self::DEFINITION_ID => []]);
        $definition->addMethodCall('addStrategy', [new Reference(self::DEFINITION_ID)])->shouldBeCalled();

        $this->process($containerBuilder);
    }

    public function it_should_not_add_method_call_when_definition_not_found(
        ContainerBuilder $containerBuilder,
        Definition $definition
    ): void
    {
        $containerBuilder->findDefinition(self::DEFINITION)->willReturn(null);
        $containerBuilder->findTaggedServiceIds(self::TAGS)->willReturn([]);
        $definition->addMethodCall('addStrategy', [new Reference(self::DEFINITION_ID)])->shouldNotBeCalled();

        $this->process($containerBuilder);
    }
}
