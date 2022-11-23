<?php

namespace app\core\view;

use app\core\exceptions\TemplateNotFoundException;
use app\core\helpers\StringHelper;

class TemplateView extends BaseView
{
    /**
     * @throws TemplateNotFoundException
     */
    public static function render(string $templateName, array $data): string
    {
        $pageContent = @file_get_contents("view/$templateName.html");
        if ($pageContent === false) {
            throw new TemplateNotFoundException("Template $templateName not found");
        }

        return self::renderStringWithData($pageContent, $data);
    }

    public static function renderStringWithData(string $pageContent, array $data): string
    {
        foreach ($data as $paramName => $paramValue) {
            if (self::isValidParam($paramName)) {
                $paramValueSerialized = self::getSerializedValue($paramValue);
                print '{{' . $paramName . '}}' . '->' . $paramValueSerialized . "\n";
                $pageContent = str_replace('{{' . $paramName . '}}', $paramValueSerialized, $pageContent);
            }
        }

        return $pageContent;
    }

    public static function getSerializedValue($paramValue): string
    {
        return match (true) {
            is_string($paramValue)  => $paramValue,
            is_array($paramValue)   => var_export($paramValue, true),
            default                 => json_encode($paramValue),
        };
    }

    public static function isValidParam($paramName): bool
    {
        if (empty($paramName)) {
            return false;
        }

        if (!StringHelper::isAlphaNumeric($paramName)) {
            return false;
        }

        return true;
    }
}
