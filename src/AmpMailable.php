<?php

namespace AmpEmail;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\View;

/**
 * Delete this folder and have fun
 * creating your package.
 */
class AmpMailable extends Mailable
{

    /**
     * The amp view to use for the message.
     *
     * @var string
     */
    public $ampView;

    protected function renderView($view, $data)
    {
        return $view instanceof Htmlable
            ? $view->toHtml()
            : View::make($view, $data);
    }

    /**
     * Set the amp html message.
     *
     * @param  string $ampView
     * @param  array $data
     * @return $this
     */
    public function amp($ampView, array $data = [])
    {
        $this->ampView = $ampView;
        $this->viewData = array_merge($this->viewData, $data);
        // local viewData variable
        $cThis = $this;

        // We need to set the callback here since adding another part is not a first-party feature
        $this->withSwiftMessage(function (\Swift_Message $message) use (&$cThis) {
            $message->addPart($cThis->renderView($cThis->ampView, $cThis->buildViewData()), 'text/x-amp-html');
        });

        return $this;
    }
}
