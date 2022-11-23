<?php

namespace app\controllers;

use app\core\exceptions\InputNotFoundException;
use app\core\exceptions\UnknownActionException;
use app\core\parser\HtmlParser;
use app\core\request\RequestService;
use app\core\source\UrlService;
use app\core\view\ArrayView;
// use app\core\view\TemplateView;

class MainController extends BaseController
{
    /**
     * @return string|null
     * @throws InputNotFoundException
     * @throws UnknownActionException
     */
    public function actionParse(): ?string
    {
        if (($url = RequestService::getUrl()) === null) {
            throw new InputNotFoundException("Url is not specified");
        }
        if (($pageContent = UrlService::get($url)) === null) {
            throw new InputNotFoundException("File $url is not found");
        }

        $tagsList = HtmlParser::parse($pageContent);

        return $this->renderContentTags($tagsList);
    }

    /**
     * @param $tagsList
     * @return string|null
     */
    public function renderContentTags($tagsList): ?string
    {
        return ArrayView::render('parseTemplate', ['tags' => $tagsList]);
    }
}
