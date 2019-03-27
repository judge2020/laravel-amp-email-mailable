## AMPHTML email for Laravel Mailable

NOTE: do not use this in production! This will not be maintained.

This impliments the text/x-amp-html multipart part required to use AMPHTML email.

I recommend waiting for this to be implemented in upstream Laravel. Feel free to [visit my feature request](https://github.com/laravel/ideas/issues/1578).

#### usage

After installing, you should change your Mailable classes to extend `AmpMailable` instead.

before:
```php

...
use Illuminate\Mail\Mailable;

class <class> extends Mailable
{
```

after:

```php
use AmpEmail\AmpMailable;

class <class> extends AmpMailable;
```

Now, in your `build` function, chain the `amp` function. This takes the same arguments as `view` and `text`.

```php
    public function build()
    {
        return $this->subject("EmailSubject")
            ->view('mail.emailview')
            ->text('mail.emailview_plain')
            ->amp('mail.emailview_amp');
            
    }
```
(Amp view names do not need to be suffixed by `_amp`, but it is recommended)