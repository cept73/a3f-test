<?php /** @noinspection PhpUnused */

namespace app\core\view;

class ArrayView extends BaseView
{
    public static function render(string $templateName, array $data): string
    {
        return var_export(['template' => $templateName, 'data' => $data], true);
    }
}
