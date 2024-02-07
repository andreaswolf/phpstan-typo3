<?php declare(strict_types = 1);

namespace SaschaEgerer\PhpstanTypo3\Reflection;

use PHPStan\Reflection\ParameterReflection;
use PHPStan\Reflection\PassedByReference;
use PHPStan\Type\IntegerType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;

class RepositoryFindByParameterReflection implements ParameterReflection
{

	private string $name;

	private Type $type;

	public function __construct(string $name, Type $type)
	{
		$this->name = $name;
		$this->type = $type;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function isOptional(): bool
	{
		return false;
	}

	public function getType(): Type
	{
		return TypeCombinator::union(
			$this->type,
			// it is possible to pass an integer that is used as uid instead of
			// the object where the uid is fetched from
			new IntegerType()
		);
	}

	public function isVariadic(): bool
	{
		return false;
	}

	public function passedByReference(): PassedByReference
	{
		return PassedByReference::createNo();
	}

	public function getDefaultValue(): ?Type
	{
		return null;
	}

}
