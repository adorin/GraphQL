<?php
/*
* This file is a part of graphql-youshido project.
*
* @author Alexandr Viniychuk <a@viniychuk.com>
* created: 11/28/15 6:07 PM
*/

namespace Youshido\GraphQL\Validator\Rules;


use Youshido\GraphQL\Type\Object\ObjectType;
use Youshido\GraphQL\Type\TypeMap;

class TypeValidationRule implements ValidationRuleInterface
{

    public function validate($data, $ruleInfo)
    {
        if (is_object($ruleInfo)) {
            $className = get_class($data);
            $className = substr($className, strrpos($className, '\\') + 1, -4);

            return ($className == $ruleInfo);
        } elseif (is_string($ruleInfo)) {
            /** @todo need to be completely rewritten */
            $ruleInfo = strtolower($ruleInfo);

            switch ($ruleInfo) {
                case TypeMap::TYPE_ANY:
                    return true;
                    break;

                case TypeMap::TYPE_ANY_OBJECT:
                    return is_object($data);
                    break;

                case TypeMap::TYPE_OBJECT_TYPE:
                    return $data instanceof ObjectType;
                    break;

                case TypeMap::TYPE_FUNCTION:
                    return is_callable($data);
                    break;

                case TypeMap::TYPE_BOOLEAN:
                    return is_bool($data);
                    break;

                case TypeMap::TYPE_ARRAY:
                    return is_array($data);
                    break;

                case TypeMap::TYPE_ANY_INPUT:
                    return TypeMap::isInputType($data);
                    break;

                default:
                    if (TypeMap::isScalarType($ruleInfo)) {
                        return TypeMap::getScalarTypeObject($ruleInfo)->isValidValue($data);
                    }
                    break;
            }
        } else {
            return false;
        }
    }

}