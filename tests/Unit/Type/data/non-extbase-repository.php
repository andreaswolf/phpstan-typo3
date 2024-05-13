<?php
declare(strict_types=1);

// phpcs:disable SlevomatCodingStandard.Namespaces.RequireOneNamespaceInFile.MoreNamespacesInFile
// phpcs:disable Squiz.Classes.ClassFileName.NoMatch
// phpcs:disable PSR1.Classes.ClassDeclaration.MultipleClasses

namespace CustomQueryType\My\Test\Extension\Domain\Model;

class MyPlainModel {
}

namespace CustomQueryType\My\Test\Extension\Domain\Repository;

use CustomQueryType\My\Test\Extension\Domain\Model\MyPlainModel;
use function PHPStan\Testing\assertType;

class SomeClass
{

	public function findFooBySomething()
	{
		return new MyPlainModel();
	}

}

$repo = new SomeClass();

$result = $repo->findFooBySomething();
assertType(MyPlainModel::class, $result);
