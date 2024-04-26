<?php
declare(strict_types=1);

// phpcs:disable SlevomatCodingStandard.Namespaces.RequireOneNamespaceInFile.MoreNamespacesInFile
// phpcs:disable Squiz.Classes.ClassFileName.NoMatch
// phpcs:disable PSR1.Classes.ClassDeclaration.MultipleClasses

namespace CustomQueryType\My\Test\Extension\Domain\Repository;

use function PHPStan\Testing\assertType;

class MyPlainRepository
{
	public function findBySomething()
	{
		return [];
	}
}

$repo = new MyPlainRepository();

$result = $repo->findBySomething();
assertType('array', $result);
