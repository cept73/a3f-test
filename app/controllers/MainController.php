<?php

namespace app\controllers;

use app\core\exceptions\InputNotFoundException;
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
     */
    public function actionParse(): ?string
    {
        if (null === ($url = RequestService::getUrl())) {
            throw new InputNotFoundException("Url is not specified");
        }

        if (null === ($pageContent = UrlService::get($url))) {
            throw new InputNotFoundException("File $url is not found");
        }

        $tagsList = HtmlParser::parse($pageContent);

        return ArrayView::render('parseTemplate', ['tags' => $tagsList]);
    }
}
