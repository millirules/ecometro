<?php

namespace App\Factory;

use App\Entity\MetricType;
use App\Repository\MetricTypeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<MetricType>
 *
 * @method        MetricType|Proxy create(array|callable $attributes = [])
 * @method static MetricType|Proxy createOne(array $attributes = [])
 * @method static MetricType|Proxy find(object|array|mixed $criteria)
 * @method static MetricType|Proxy findOrCreate(array $attributes)
 * @method static MetricType|Proxy first(string $sortedField = 'id')
 * @method static MetricType|Proxy last(string $sortedField = 'id')
 * @method static MetricType|Proxy random(array $attributes = [])
 * @method static MetricType|Proxy randomOrCreate(array $attributes = [])
 * @method static MetricTypeRepository|RepositoryProxy repository()
 * @method static MetricType[]|Proxy[] all()
 * @method static MetricType[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static MetricType[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static MetricType[]|Proxy[] findBy(array $attributes)
 * @method static MetricType[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static MetricType[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class MetricTypeFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(MetricType $metricType): void {})
        ;
    }

    protected static function getClass(): string
    {
        return MetricType::class;
    }
}
