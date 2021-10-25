<?php declare(strict_types = 1);

namespace SaschaEgerer\PhpstanTypo3\Type;

use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;

class ContextDynamicReturnTypeExtension implements DynamicMethodReturnTypeExtension
{

	public function getClass(): string
	{
		return \TYPO3\CMS\Core\Context\Context::class;
	}

	public function isMethodSupported(
		MethodReflection $methodReflection
	): bool
	{
		return $methodReflection->getName() === 'getAspect';
	}

	public function getTypeFromMethodCall(
		MethodReflection $methodReflection,
		MethodCall $methodCall,
		Scope $scope
	): Type
	{
		$argument = $methodCall->getArgs()[0] ?? null;

		if ($argument === null) {
			return ParametersAcceptorSelector::selectSingle($methodReflection->getVariants())->getReturnType();
		}

		$argumentValue = $argument->value;

		if (!($argumentValue instanceof \PhpParser\Node\Scalar\String_)) {
			return ParametersAcceptorSelector::selectSingle($methodReflection->getVariants())->getReturnType();
		}

		switch ($argumentValue->value) {
			case 'date':
				return new ObjectType(\TYPO3\CMS\Core\Context\DateTimeAspect::class);
			case 'visibility':
				return new ObjectType(\TYPO3\CMS\Core\Context\VisibilityAspect::class);
			case 'backend.user':
			case 'frontend.user':
				return new ObjectType(\TYPO3\CMS\Core\Context\UserAspect::class);
			case 'workspace':
				return new ObjectType(\TYPO3\CMS\Core\Context\WorkspaceAspect::class);
			case 'language':
				return new ObjectType(\TYPO3\CMS\Core\Context\LanguageAspect::class);
			case 'typoscript':
				return new ObjectType(\TYPO3\CMS\Core\Context\TypoScriptAspect::class);
			default:
				return ParametersAcceptorSelector::selectSingle($methodReflection->getVariants())->getReturnType();
		}
	}

}
