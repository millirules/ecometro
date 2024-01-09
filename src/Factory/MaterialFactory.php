<?php

namespace App\Factory;

use App\Entity\Material;
use App\Repository\MaterialRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Material>
 *
 * @method        Material|Proxy create(array|callable $attributes = [])
 * @method static Material|Proxy createOne(array $attributes = [])
 * @method static Material|Proxy find(object|array|mixed $criteria)
 * @method static Material|Proxy findOrCreate(array $attributes)
 * @method static Material|Proxy first(string $sortedField = 'id')
 * @method static Material|Proxy last(string $sortedField = 'id')
 * @method static Material|Proxy random(array $attributes = [])
 * @method static Material|Proxy randomOrCreate(array $attributes = [])
 * @method static MaterialRepository|RepositoryProxy repository()
 * @method static Material[]|Proxy[] all()
 * @method static Material[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Material[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Material[]|Proxy[] findBy(array $attributes)
 * @method static Material[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Material[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class MaterialFactory extends ModelFactory
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
            'cost' => self::faker()->randomFloat(),
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'material_type' => MaterialTypeFactory::new(),
            'name' => self::faker()->text(255),
            'updatedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'supplier' => [SupplierFactory::new()],
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Material $material): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Material::class;
    }
}
