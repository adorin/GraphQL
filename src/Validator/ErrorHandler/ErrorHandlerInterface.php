<?php
/**
 * This file is a part of GraphQL project.
 *
 * @author Alexandr Viniychuk <a@viniychuk.com>
 * created: 7/4/17 11:36 PM
 */

namespace Youshido\GraphQL\Validator\ErrorHandler;

use Youshido\GraphQL\Execution\Context\ExecutionContextInterface;

interface ErrorHandlerInterface
{
    /**
     * @param                           $error
     * @param ExecutionContextInterface $executionContext
     *
     * @return mixed
     */
    public function handle($error, ExecutionContextInterface $executionContext);
}