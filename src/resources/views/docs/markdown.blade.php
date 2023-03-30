@extends('sales-management::layouts.app')

@section('title', 'Markdown Guide')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="mx-auto col-lg-10 col-xl-8">
                <h1 class="h3">Markdown Guide</h1>
                <hr class="my-4">

                <div class="alert alert-primary mb-5" role="alert">
                    <div class="alert-message">
                        <strong>Note:</strong> In our application, we use Markdown for writing emails. This guide will help you understand the basics of Markdown and how to use it effectively for creating well-formatted emails.
                    </div>
                </div>

                <div id="introduction" class="mb-5">
                    <h3>Introduction</h3>
                    <p class="text-lg">
                        Markdown is a lightweight markup language with plain-text-formatting syntax. It is designed for easy reading and writing. This guide will provide you with the basics of Markdown and how to use it in your projects.
                    </p>
                </div>

                <div id="headings" class="mb-5">
                    <h3>Headings</h3>
                    <p class="text-lg">
                        To create a heading, add one to six # symbols before your heading text. The number of # symbols you use should correspond to the heading level. For example:
                    </p>
                    <pre><code># Heading 1
## Heading 2
### Heading 3
#### Heading 4
##### Heading 5
###### Heading 6
</code></pre>
                </div>

                <div id="paragraphs" class="mb-5">
                    <h3>Paragraphs</h3>
                    <p class="text-lg">
                        Paragraphs in Markdown are just one or more lines of consecutive text followed by one or more blank lines. For example:
                    </p>
                    <pre><code>This is a paragraph.

This is another paragraph.
</code></pre>
                </div>

                <div id="bold-italic" class="mb-5">
                    <h3>Bold and Italic Text</h3>
                    <p class="text-lg">
                        You can make the text bold or italic by enclosing it in asterisks (*) or underscores (_). For example:
                    </p>
                    <pre><code>*This text is italicized*
**This text is bold**
***This text is bold and italicized***
</code></pre>
                </div>

                <div id="lists" class="mb-5">
                    <h3>Lists</h3>
                    <p class="text-lg">
                        You can create ordered and unordered lists using numbers, asterisks, or hyphens. For example:
                    </p>
                    <pre><code>1. First item
2. Second item
3. Third item

* Unordered item
* Another unordered item
* And one more
</code></pre>
                </div>

                <div id="links" class="mb-5">
                    <h3>Links</h3>
                    <p class="text-lg">
                        To create a link, enclose the link text in brackets and the URL in parentheses. For example:
                    </p>
                    <pre><code>[Visit Google](https://www.google.com)
</code></pre>
                </div>

                <div id="images" class="mb-5">
                    <h3>Images</h3>
                    <p class="text-lg">
                        To include an image, use an exclamation mark followed by the alt text in brackets, and the image URL in parentheses. For example:
                    </p>
                    <pre><code>![Alt text](https://via.placeholder.com/150)
</code></pre>
                </div>

                <div id="code" class="mb-5">
                    <h3>Code</h3>
                    <p class="text-lg">
                        To display code, you can use backticks (`) for inline code or triple backticks for multiline code blocks. For example:
                    </p>
                    <pre><code>`This is inline code`
</code></pre>
                </div>

                <div id="tables" class="mb-5">
                    <h3>Tables</h3>
                    <p class="text-lg">
                        You can create tables using pipes (|) and hyphens (-). For example:
                    </p>
                    <pre><code>| Column 1 | Column 2 | Column 3 |
| -------- | -------- | -------- |
| Row 1    | Data     | Data     |
| Row 2    | Data     | Data     |
</code></pre>
                </div>

                <div id="blockquotes" class="mb-5">
                    <h3>Blockquotes</h3>
                    <p class="text-lg">
                        To create a blockquote, add a greater than symbol (>) followed by a space before the text. For example:
                    </p>
                    <pre><code>> This is a blockquote
</code></pre>
                </div>

                <div id="horizontal-rules" class="mb-5">
                    <h3>Horizontal Rules</h3>
                    <p class="text-lg">
                        To create a horizontal rule, use three or more asterisks, hyphens, or underscores on a line by themselves. For example:
                    </p>
                    <pre><code>***
---
___
</code></pre>
                </div>

            </div>
        </div>
    </div>
</main>
@stop




