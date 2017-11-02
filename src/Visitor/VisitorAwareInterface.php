<?php

namespace CodesWholesale\Visitor;

/**
 * Interface VisitorAwareInterface
 */
interface VisitorAwareInterface
{
    public function accept(VisitorInterface $visitor);
}