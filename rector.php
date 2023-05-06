<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Assign\CombinedAssignRector;
use Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector;
use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\CodeQuality\Rector\ClassConstFetch\ConvertStaticPrivateConstantToSelfRector;
use Rector\CodeQuality\Rector\For_\ForRepeatedCountToOwnVariableRector;
use Rector\CodeQuality\Rector\For_\ForToForeachRector;
use Rector\CodeQuality\Rector\FuncCall\AddPregQuoteDelimiterRector;
use Rector\CodeQuality\Rector\FuncCall\ArrayKeysAndInArrayToArrayKeyExistsRector;
use Rector\CodeQuality\Rector\FuncCall\ArrayMergeOfNonArraysToSimpleArrayRector;
use Rector\CodeQuality\Rector\FuncCall\ChangeArrayPushToArrayAssignRector;
use Rector\CodeQuality\Rector\FuncCall\FloatvalToTypeCastRector;
use Rector\CodeQuality\Rector\Identical\BooleanNotIdenticalToNotIdenticalRector;
use Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector;
use Rector\CodeQuality\Rector\If_\CombineIfRector;
use Rector\CodeQuality\Rector\If_\ConsecutiveNullCompareReturnsToNullCoalesceQueueRector;
use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;
use Rector\CodeQuality\Rector\LogicalAnd\AndAssignsToSeparateLinesRector;
use Rector\CodeQuality\Rector\NotEqual\CommonNotEqualRector;
use Rector\CodeQuality\Rector\Ternary\ArrayKeyExistsTernaryThenValueToCoalescingRector;
use Rector\Config\RectorConfig;
use Rector\Php82\Rector\Class_\ReadOnlyClassRector;
use Rector\Php82\Rector\FuncCall\Utf8DecodeEncodeToMbConvertEncodingRector;
use Rector\Privatization\Rector\Class_\ChangeGlobalVariablesToPropertiesRector;
use Rector\Privatization\Rector\Property\ChangeReadOnlyPropertyWithDefaultValueToConstantRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__.'/src',
    ]);

    $rectorConfig->rules([
        InlineConstructorDefaultToPropertyRector::class,
        ChangeArrayPushToArrayAssignRector::class,
        CombineIfRector::class,
        CommonNotEqualRector::class,
        CombinedAssignRector::class,
        CompleteDynamicPropertiesRector::class,
        ConsecutiveNullCompareReturnsToNullCoalesceQueueRector::class,
        ConvertStaticPrivateConstantToSelfRector::class,
        ExplicitBoolCompareRector::class,
        FlipTypeControlToUseExclusiveTypeRector::class,
        FloatvalToTypeCastRector::class,
        ForRepeatedCountToOwnVariableRector::class,
        ForToForeachRector::class,
        AddPregQuoteDelimiterRector::class,
        AndAssignsToSeparateLinesRector::class,
        ArrayKeyExistsTernaryThenValueToCoalescingRector::class,
        ArrayKeysAndInArrayToArrayKeyExistsRector::class,
        ArrayMergeOfNonArraysToSimpleArrayRector::class,
        BooleanNotIdenticalToNotIdenticalRector::class,
        ReadOnlyClassRector::class,
        Utf8DecodeEncodeToMbConvertEncodingRector::class,
        ChangeGlobalVariablesToPropertiesRector::class,
        ChangeReadOnlyPropertyWithDefaultValueToConstantRector::class,
    ]);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_82,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::EARLY_RETURN,
        SetList::TYPE_DECLARATION,
        SetList::PRIVATIZATION,
        SetList::CODING_STYLE,
        SetList::NAMING,
    ]);
};
