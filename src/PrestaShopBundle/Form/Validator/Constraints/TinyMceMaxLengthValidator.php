<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace PrestaShopBundle\Form\Validator\Constraints;

use PrestaShop\PrestaShop\Adapter\LegacyContext;
use PrestaShop\PrestaShop\Adapter\Validate;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TinyMceMaxLengthValidator extends ConstraintValidator
{
    private $validateAdapter;

    public function __construct()
    {
        $this->validateAdapter = new Validate();
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof TinyMceMaxLength) {
            throw new UnexpectedTypeException($constraint, TinyMceMaxLength::class);
        }

        if (!$this->validateAdapter->isUnsignedInt($constraint->max)) {
            throw new \InvalidArgumentException('Max must be int. Input was: ' . \gettype($constraint->max));
        }

        $replaceArray = [
            "\n",
            "\r",
            "\n\r",
        ];
        $str = str_replace($replaceArray, [''], strip_tags($value));

        if (iconv_strlen($str) > $constraint->max) {
            $translator = (new LegacyContext())->getContext()->getTranslator();

            $message = $constraint->message ?? $translator->trans(
                'This value is too long. It should have %limit% characters or less.',
                ['%limit%' => $constraint->max],
                'Admin.Catalog.Notification'
            );

            $this->context->buildViolation($message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setCode(TinyMceMaxLength::TOO_LONG_ERROR_CODE)
                ->addViolation()
            ;
        }
    }
}
