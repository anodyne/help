<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateAnodyneArticles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$articles = [
			['title' => "Markdown Guide", 'slug' => "markdown-guide", 'summary' => "There are many places through Anodyne's products and services where Markdown is used for lightweight styling. Learn about Markdown and its syntax to use it throughout Anodyne's products and services.", 'content' => "Markdown is a plain-text formatting syntax that's converted into HTML. In several places throughout our products and services, we allow using Markdown to quickly and easily style your content instead of using straight HTML. Markdown will also be prevalent in future products from Anodyne Productions as well. This guide should give you the basics for how to use Markdown.

## Typography

### Paragraphs

If you want to create a paragraph, there's nothing special you have to do. In fact, a paragraph is simply one or more consecutive lines of text, separated by one or more blank lines. (In this case, a blank line is any line that looks like a blank line - a line containing nothing but spaces or tabs.) There's no need to indent with spaces or tabs, simply type.

In the event that you do want to insert a `<br>` break tag, simply end a line with two or more spaces.

### Headers

You can create headers in Markdown by using 1-6 hash characters at the start of the line, corresponding to header levels 1-6.

<div class=\"row\">
<div class=\"col-lg-6\">

    # This is an H1
    
    ## This is an H2
    
    ### This is an H3
</div>

<div class=\"col-lg-6\">

# This is an H1

## This is an H2

### This is an H3
</div>
</div>

You can optionally \"close\" headers, but this is purely cosmetic. The closing hashes don't even need to match the number of hashes used to open the header. (The number of opening hashes is what determines the header level.)

    # This is an H1 #

    ## This is an H2 ##

    ### This is an H3 ######

### Emphasis

Markdown treats asterisks (\*) and underscores (\_) as indicators of emphasis, either italics or bold. Using a single emphasis character on either side of a word/s will italicize it while using double emphasis characters on either side of a word/s will bold the text.

<div class=\"row\">
<div class=\"col-lg-6\">

    *Italicized text*  
    _Italicized text_
    
    **Bolded text**  
    __Bolded text__
</div>

<div class=\"col-lg-6\">

*Italicized text*  
_Italicized text_

**Bolded text**  
__Bolded text__
</div>
</div>

You can use either asterisks or underscores, but you __must__ close with the same character you opened with.

In some cases, you may not want asterisks or underscores used in this manner. You can escape these characters with a leading backslash (\) before the character.

<div class=\"row\">
<div class=\"col-lg-6\">

    nova\_users
</div>

<div class=\"col-lg-6\">

nova\_users
</div>
</div>

## Links

To create a link in Markdown, the link text is delimited by square brackets and the URL is placed inside regular parentheses immediately after. You can provide an _optional_ title for the link, enclosed in quotes, after the URL if you want, but is not required. If you want to link to a local page, you can use a relative path for the URL.

<div class=\"row\">
<div class=\"col-lg-6\">

    This is [an example](http://example.com \"Title\") inline link.
    
    [This link](http://example.com) has no title attribute.
    
    See my [about page](/about) for details.
</div>

<div class=\"col-lg-6\">

This is [an example](http://example.com \"Title\") inline link.

[This link](http://example.com) has no title attribute.

See my [about page](/about) for details.
</div>
</div>

## Lists

Markdown supports both ordered (numbered) and unordered (bulleted) lists.

Unordered lists use asterisks (\*), pluses (+), and hyphens (-) - interchangably - as list markers.

<div class=\"row\">
<div class=\"col-lg-6\">

    * Red
    * Green
    * Blue
    
    + Red
    + Green
    + Blue
    
    - Red
    - Green
    - Blue
</div>

<div class=\"col-lg-6\">

* Red
* Green
* Blue

+ Red
+ Green
+ Blue

- Red
- Green
- Blue
</div>
</div>

Ordered lists use numbers followed by periods. The actual numbers you use to mark the list have no effect on the HTML output Markdown produces.

<div class=\"row\">
<div class=\"col-lg-6\">

    1. Red
    2. Green
    3. Blue
    
    1. Red
    893. Green
    1163. Blue
</div>

<div class=\"col-lg-6\">

1. Red
2. Green
3. Blue


1. Red
893. Green
1163. Blue
</div>
</div>

You can also nest lists inside lists by indenting each level with 4 spaces.

<div class=\"row\">
<div class=\"col-lg-6\">

    * Red
        * Crimson
        * Scarlet
    * Green
        * Emerald
    * Blue
        1. Cerulean
        2. Cornflower
        3. Royal
</div>

<div class=\"col-lg-6\">

* Red
    * Crimson
    * Scarlet
* Green
    * Emerald
* Blue
    1. Cerulean
    2. Cornflower
    3. Royal
</div>
</div>

## Blockquotes

Markdown uses email-style `>` characters for blockquoting.

<div class=\"row\">
<div class=\"col-lg-6\">

    > This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet,
    > consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus.
    > Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.
    > 
    > Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse
    > id sem consectetuer libero luctus adipiscing.
</div>

<div class=\"col-lg-6\">

> This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet,
> consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus.
> Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.
> 
> Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse
> id sem consectetuer libero luctus adipiscing.
</div>
</div>

Markdown also allows only putting the `>` before the first line of a hard-wrapped paragraph:

<div class=\"row\">
<div class=\"col-lg-6\">

    > This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus. Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.

    > Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse id sem consectetuer libero luctus adipiscing.
</div>

<div class=\"col-lg-6\">

> This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus. Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.

> Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse id sem consectetuer libero luctus adipiscing.
</div>
</div>

Blockquotes can be nested (i.e. a blockquote-in-a-blockquote) by adding additional levels of `>`:

<div class=\"row\">
<div class=\"col-lg-6\">

    > This is the first level of quoting.
    >
    > > This is nested blockquote.
    >
    > Back to the first level.
</div>

<div class=\"col-lg-6\">

> This is the first level of quoting.
>
> > This is nested blockquote.
>
> Back to the first level.
</div>
</div>

Blockquotes can contain other Markdown elements, including headers, lists, and code blocks:

<div class=\"row\">
<div class=\"col-lg-6\">

    > ## This is a header.
    > 
    > 1.   This is the first list item.
    > 2.   This is the second list item.
    > 
    > Here's some example code:
    > 
    >     return shell_exec(\"echo \$input | \$markdown_script\");
</div>

<div class=\"col-lg-6\">

> ## This is a header.
> 
> 1.   This is the first list item.
> 2.   This is the second list item.
> 
> Here's some example code:
> 
>     return shell_exec(\"echo \$input | \$markdown_script\");
</div>
</div>

## Using HTML

With Markdown, you can use any HTML you want as well and it will not be parsed as Markdown. The only caveat is that once you use HTML on a line, the parser will ignore any Markdown in the line, so you cannot mix Markdown and HTML on the same line.", 'keywords' => 'markdown, html', 'featured' => 1, 'tags' => [2,5]],
		];

		foreach ($articles as $article)
		{
			$article['product_id'] = 6;
			$article['user_id'] = 1;
            $article['published'] = (int) true;

			$tags = (array_key_exists('tags', $article)) ? $article['tags'] : null;
			unset($article['tags']);

			$item = Article::create($article);

			if ($tags)
			{
				$item->tags()->sync($tags);
			}
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Article::where('product_id', 6)->delete();
	}

}
