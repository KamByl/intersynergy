<?php

namespace App\Factory;

use App\Entity\Osoby;
use Zenstruck\Foundry\Proxy;
use App\Repository\OsobyRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\RepositoryProxy;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @extends ModelFactory<Osoby>
 *
 * @method static Osoby|Proxy createOne(array $attributes = [])
 * @method static Osoby[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Osoby[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Osoby|Proxy find(object|array|mixed $criteria)
 * @method static Osoby|Proxy findOrCreate(array $attributes)
 * @method static Osoby|Proxy first(string $sortedField = 'id')
 * @method static Osoby|Proxy last(string $sortedField = 'id')
 * @method static Osoby|Proxy random(array $attributes = [])
 * @method static Osoby|Proxy randomOrCreate(array $attributes = [])
 * @method static Osoby[]|Proxy[] all()
 * @method static Osoby[]|Proxy[] findBy(array $attributes)
 * @method static Osoby[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Osoby[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static OsobyRepository|RepositoryProxy repository()
 * @method Osoby|Proxy create(array|callable $attributes = [])
 */
final class OsobyFactory extends ModelFactory
{
    private $passwordHasher;

    public function __construct( UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->passwordHasher = $passwordHasher;

    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'Imie' => self::faker()->firstName(),
            'nazwisko' => self::faker()->lastName(),
            'pesel' => self::faker()->numerify("#########"),
            'email' => self::faker()->email(),
            'data_urodzenia' => self::faker()->dateTime(),
            'data_rejestracji' => self::faker()->dateTime(),
            'data_aktualizacji_wpisu' => self::faker()->dateTime(),
            'ocena' => self::faker()->numberBetween(1, 10),
            'plainPassword' => 'tada'
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            ->afterInstantiate(function(Osoby $osoby) {
                if ($osoby->getPlainPassword()) {
                    $osoby->setPassword(
                        $this->passwordHasher->hashPassword($osoby, $osoby->getPlainPassword())
                    );
                };
            });
    }

    protected static function getClass(): string
    {
        return Osoby::class;
    }
}
