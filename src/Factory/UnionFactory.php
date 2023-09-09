<?php

namespace App\Factory;

use App\Entity\Union;
use App\Repository\UnionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Union>
 *
 * @method        Union|Proxy                     create(array|callable $attributes = [])
 * @method static Union|Proxy                     createOne(array $attributes = [])
 * @method static Union|Proxy                     find(object|array|mixed $criteria)
 * @method static Union|Proxy                     findOrCreate(array $attributes)
 * @method static Union|Proxy                     first(string $sortedField = 'id')
 * @method static Union|Proxy                     last(string $sortedField = 'id')
 * @method static Union|Proxy                     random(array $attributes = [])
 * @method static Union|Proxy                     randomOrCreate(array $attributes = [])
 * @method static UnionRepository|RepositoryProxy repository()
 * @method static Union[]|Proxy[]                 all()
 * @method static Union[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Union[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Union[]|Proxy[]                 findBy(array $attributes)
 * @method static Union[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Union[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class UnionFactory extends ModelFactory
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
            'name' => self::faker()->text(24),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Union $union): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Union::class;
    }
}
