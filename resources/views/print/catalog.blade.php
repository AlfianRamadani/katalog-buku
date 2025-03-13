<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Catalog</title>
    <style>
        @page {
            size: 125mm 75mm;
            /* 7.5 cm x 12.5 cm */
            margin: 4mm;
        }

        body {
            font-family: Arial, sans-serif;
            width: 125mm;
            height: 75mm;
            font-size: 9px;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            overflow: hidden;
        }

        .left {
            width: 10%;
            text-align: left;
        }

        .right {
            width: 80%;
            padding-left: 10px;
        }

        .title {
            font-weight: bold;
        }

        .underline {
            text-decoration: underline;
        }

        @media print {
            body {
                page-break-after: avoid;
            }
        }
    </style>
</head>

<body>
    <div class="left">
        <p>{{ $book->deweyDecimal->code ?? '' }}</p>
        <p>{{ strtoupper(substr($book->title, 0, 3)) }}</p>
        <p>p</p>
    </div>
    <div class="right">
        <p class="title">{{ $book->title }}</p>
        <p><span class="underline">{{ $book->title }}</span> / {{ $book->author ?? 'Unknown Author' }}.</p>
        <p>-- cet.1 -- {{ $book->city_publisher }}: <span
                class="underline">{{ $book->publisher ?? 'Unknown Publisher' }}</span>, {{ $book->publication_year }}.
        </p>
        <p>{{ $book->total_page }} hlm.; 21 cm.</p>
        <p>ISBN {{ $book->isbn_number }}</p>
        <p>1. {{ $book->deweyDecimal->category }} – {{ $book->deweyDecimal->description }} <span style="float:right">I.
                Judul</span></p>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
