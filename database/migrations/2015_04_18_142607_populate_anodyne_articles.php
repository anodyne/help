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
			['title' => "Markdown Guide", 'slug' => "markdown-guide", 'summary' => "There are many places through Anodyne's products and services where Markdown is used for lightweight styling. Learn about Markdown and its syntax to use it throughout Anodyne's products and services.", 'content' => "Markdown is a plain-text formatting syntax that's converted into HTML. In several places throughout our products and services, we allow using Markdown to quickly and easily style your content instead of using HTML.

## Paragraphs and Line Breaks

A paragraph is simply one or more consecutive lines of text, separated by one or more blank lines. (A blank line is any line that looks like a blank line - a line containing nothing but spaces or tabs is considered blank.) Normal paragraphs should not be indented with spaces or tabs.

When you do want to insert a `<br />` break tag using Markdown, simply end a line with two or more spaces.

## Headers

Headers can be created in Markdown by using 1-6 hash characters at the start of the line, corresponding to header levels 1-6. For example:

    # This is an H1

    ## This is an H2

    ###### This is an H6

You can optionally "close" headers, but this is purely cosmetic. The closing hashes don't even need to match the number of hashes used to open the header. (The number of opening hashes determines the header level.)

    # This is an H1 #

    ## This is an H2 ##

    ### This is an H3 ######

## Blockquotes

Markdown uses email-style `>` characters for blockquoting. If you're familiar with quoting passages of text in an email message, then you know how to create a blockquote in Markdown.

    > This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet,
    > consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus.
    > Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.
    > 
    > Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse
    > id sem consectetuer libero luctus adipiscing.

Markdown also allows only putting the `>` before the first line of a hard-wrapped paragraph:

    > This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus. Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.

    > Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse id sem consectetuer libero luctus adipiscing.
    
Blockquotes can be nested (i.e. a blockquote-in-a-blockquote) by adding additional levels of `>`:

    > This is the first level of quoting.
    >
    > > This is nested blockquote.
    >
    > Back to the first level.

Blockquotes can contain other Markdown elements, including headers, lists, and code blocks:

    > ## This is a header.
    > 
    > 1.   This is the first list item.
    > 2.   This is the second list item.
    > 
    > Here's some example code:
    > 
    >     return shell_exec("echo $input | $markdown_script");

## Lists

Markdown supports both ordered (numbered) and unordered (bulleted) lists.

Unordered lists use asterisks, pluses, and hyphens - interchangably - as list markers:

    *   Red
    *   Green
    *   Blue

is equivalent to:

    +   Red
    +   Green
    +   Blue

and:

    -   Red
    -   Green
    -   Blue

Ordered lists use numbers followed by periods:

    1.  Bird
    2.  McHale
    3.  Parish
    
<p class="alert alert-info"><strong>Please Note:</strong> The actual numbers you use to mark the list have no effect on the HTML output Markdown produces.</p>

The HTML Markdown produces from the above list is:

    <ol>
    <li>Bird</li>
    <li>McHale</li>
    <li>Parish</li>
    </ol>

If you instead wrote the list in Markdown like this:

    1.  Bird
    1.  McHale
    1.  Parish

or even:

    3. Bird
    1. McHale
    8. Parish

you'd get the exact same HTML output. The point is, if you want to, you can use ordinal numbers in your ordered Markdown lists, so that the numbers in your source match the numbers in your published HTML. But if you want to be lazy, you don't have to. If you do use lazy list numbering, however, you should still start the list with the number 1.

List markers typically start at the left margin, but may be indented by up to three spaces. List markers must be followed by one or more spaces or a tab.", 'keywords' => 'markdown, html', 'featured' => 1, 'tags' => [2,5]],
		];

		foreach ($articles as $article)
		{
			$article['product_id'] = 6;
			$article['user_id'] = 1;

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
