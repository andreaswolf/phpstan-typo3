<?php
declare(strict_types=1);

namespace SaschaEgerer\PhpstanTypo3\Service;

final class ServiceDefinition
{
	private string $id;
	private ?string $class;
	private bool $public;
	private bool $synthetic;
	private ?string $alias;

	public function __construct(
		string $id,
		?string $class,
		bool $public,
		bool $synthetic,
		?string $alias
	)
	{

		$this->id = $id;
		$this->class = $class;
		$this->public = $public;
		$this->synthetic = $synthetic;
		$this->alias = $alias;
	}

	public function getId(): string
	{
		return $this->id;
	}

	public function getClass(): ?string
	{
		return $this->class;
	}

	public function isPublic(): bool
	{
		return $this->public;
	}

	public function isSynthetic(): bool
	{
		return $this->synthetic;
	}

	public function getAlias(): ?string
	{
		return $this->alias;
	}
}
