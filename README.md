# NotifierBundle #

NotifierBundle implements the most essential and basic functionalities of [Swift_Mailer](http://swiftmailer.org). The best way, is to sent a Html mail with [Twig templating engine](http://twig.sensiolabs.org/). You can also add many attachments at the mail.


## Contact ##

    Nick: aways
    IRC: irc.freenode.net - #sf-grenoble


## Install ##

  1. Download with composer
  1. Enable
  1. Configure
  1. Use it

### Download ###

Add NotifierBundle in your project's `composer.json`

```json
{
    "require": {
        "imag/notifier-bundle": "1.0.*@stable"
    }
}
```

### Enable ###

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new IMAG\NotifierBundle\IMAGNotifierBundle(),
    );
}
```

### Configure ###

**All next parameters are a default value.**

```yaml
#config.yml
imag_notifier:
    default_from: fqdn@d.tld
    default_subject: Defaul subject
    subject_prefix: "[Application][Tag] " #Default ''(empty string)
```

### Use it ###

#### Html mail ####

```php
$notifier = $this->get('imag_notifier.provider');

$html = $notifier->createHtmlMessage();

$attach = $notifier->createAttachment();
$attach
    ->loadFile('/tmp/toto')
    ->setFilename('toto.txt')
    ->setMimeType('application/txt')
    ;
$html->addAttachment($attach);

$attach = $notifier->createAttachment();
$attach->setData('Your content');
$html->addAttachment($attach);

$html
    ->addTo('foo@d.tld')
    ->addCc('foo@d.tld')
    ->setBcc(array(
        'foo@d1.tld',
    ))
    ->addBcc('foo@d2.tld')
    ->setSubject('Foo')
    ->setTemplate('IMAGYourBundle:Mail:contact.html.twig', array(
        'name' => 'toto',
        'subject' => 'subject',
        'date' => new \Datetime(),
        'body' => 'body',
    ))
    ;

$notifier->send($html);
```

#### Create basic mail ####
```php
$notifier = $this->get('imag_notifier.provider');

$html = $notifier->createMessage();
```
