# Platypus Documentation
> Version 1.0.1

## Introduction

Platypus is a very simple templating engine for PHP. It has been designed to be elegent and simple. The focus of Platypus is to try to separate HTML and PHP code as much as possible.

## Syntax

Template files are normal HTML files with the .html extension. Any content needed to be templated is enclosed in:

```
[[: Tag :]]
```

**Tag** is replaced when Platypus prints the html out to the screen.

## Methods

Platypus has a small set of methods for performing templating. These methods hopefully encompass most, if not all, needs.

### Platypus::__construct

```php
$perry = new Platypus('index.html');
```

Platypus objects are initialized with the template being passed as the pargument to the constructor.

### Platypus::set

```php
$perry->set($tag, $content);
```

The *set* method will replace $tag with $content in the templated HTML code.

### Platypus::setIf

```php
$perry->setIf($tag, $content, $condition);
```

Platypus will only replace $tag with $content if $condition is true. Otherwise $tag is deleted from the output.

### Platypus::setFor

```php
$perry->setFor($tag, $template, $tagArray, $contentArray);
```

In *setFor* $tag is the tag inside the current Platypus object you are replace. Essentially, ($template, $tagArray, $contentArray) is the $content which will be replace $tag. $tagArray is an array of tags located inside $template. The $tagArray will be iterated over count($contentArray) times. This will create an iteration of $template count($contentArray) times and produce HTML code which is used to replace $tag in the calling Platypus object.

### Platypus::setForIf

```php
$perry->setForIf($tag, $template, $tagArray, $contentArray, $condition);
```

Similar to *setFor* except will only replace $tag if $condition is true. Otherwise $tag is deleted from output.
