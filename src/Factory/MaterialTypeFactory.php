<?php

namespace App\Factory;

use App\Entity\MaterialType;
use App\Repository\MaterialTypeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<MaterialType>
 *
 * @method        MaterialType|Proxy create(array|callable $attributes = [])
 * @method static MaterialType|Proxy createOne(array $attributes = [])
 * @method static MaterialType|Proxy find(object|array|mixed $criteria)
 * @method static MaterialType|Proxy findOrCreate(array $attributes)
 * @method static MaterialType|Proxy first(string $sortedField = 'id')
 * @method static MaterialType|Proxy last(string $sortedField = 'id')
 * @method static MaterialType|Proxy random(array $attributes = [])
 * @method static MaterialType|Proxy randomOrCreate(array $attributes = [])
 * @method static MaterialTypeRepository|RepositoryProxy repository()
 * @method static MaterialType[]|Proxy[] all()
 * @method static MaterialType[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static MaterialType[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static MaterialType[]|Proxy[] findBy(array $attributes)
 * @method static MaterialType[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static MaterialType[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class MaterialTypeFactory extends ModelFactory
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
            // ->afterInstantiate(function(MaterialType $materialType): void {})
        ;
    }

    protected static function getClass(): string
    {
        return MaterialType::class;
    }
}
