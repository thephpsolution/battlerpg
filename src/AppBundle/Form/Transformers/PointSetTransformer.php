<?php
/**
 * Created by PhpStorm.
 * User: jmac
 * Date: 12/28/15
 * Time: 2:26 PM
 */

namespace AppBundle\Form\Transformers;

use AppBundle\Entity\Issue;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class IssueToNumberTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (set) to a string (number).
     *
     * @param  Issue|null $set
     * @return string
     */
    public function transform($set)
    {
        if (null === $set) {
            return '';
        }

        return implode(',', $set);
    }

    /**
     * Transforms a string (number) to an object (set).
     *
     * @param  string $setNumber
     * @return Issue|null
     * @throws TransformationFailedException if object (set) is not found.
     */
    public function reverseTransform($setNumber)
    {
        // no set number? It's optional, so that's ok
        if (!$setNumber) {
            return;
        }

        return explode(',', $setNumber);
    }
}