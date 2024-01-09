<?php

namespace App\Factory;

use App\Entity\EnvirometalMetric;
use App\Repository\EnvirometalMetricRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<EnvirometalMetric>
 *
 * @method        EnvirometalMetric|Proxy create(array|callable $attributes = [])
 * @method static EnvirometalMetric|Proxy createOne(array $attributes = [])
 * @method static EnvirometalMetric|Proxy find(object|array|mixed $criteria)
 * @method static EnvirometalMetric|Proxy findOrCreate(array $attributes)
 * @method static EnvirometalMetric|Proxy first(string $sortedField = 'id')
 * @method static EnvirometalMetric|Proxy last(string $sortedField = 'id')
 * @method static EnvirometalMetric|Proxy random(array $attributes = [])
 * @method static EnvirometalMetric|Proxy randomOrCreate(array $attributes = [])
 * @method static EnvirometalMetricRepository|RepositoryProxy repository()
 * @method static EnvirometalMetric[]|Proxy[] all()
 * @method static EnvirometalMetric[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static EnvirometalMetric[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static EnvirometalMetric[]|Proxy[] findBy(array $attributes)
 * @method static EnvirometalMetric[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static EnvirometalMetric[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class EnvirometalMetricFactory extends ModelFactory
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
            'value' => self::faker()->randomFloat(),
            'metric_type' => MetricTypeFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(EnvirometalMetric $envirometalMetric): void {})
        ;
    }

    protected static function getClass(): string
    {
        return EnvirometalMetric::class;
    }
}
