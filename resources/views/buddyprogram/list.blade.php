<!DOCTYPE HTML>
<html>
<head>
    <!-- jquery library -->
    <script
            src="https://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
            crossorigin="anonymous"></script>

    <!-- jPList Core -->
    <script src="{{ URL::asset('js/jplist.core.min.js') }}"></script>
    <link href="{{ URL::asset('css/jplist.core.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- jPList Sort Bundle -->
    <script src="{{ URL::asset('js/jplist.sort-bundle.min.js') }}"></script>

    <!-- jPList Pagination Bundle -->
    <script src="{{ URL::asset('js/jplist.pagination-bundle.min.js') }}"></script>

    <!-- Textbox Filter Control -->
    <script src="{{ URL::asset('js/jplist.textbox-filter.min.js') }}"></script>
    <link href="{{ URL::asset('css/jplist.textbox-filter.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Other bundles or controls... -->

    <!-- Initialization -->
    <script>
        $('document').ready(function(){

            console.log("jmmm");

            //check all jPList javascript options here
            $('#demo').jplist({
                itemsBox: '.list',
                itemPath: '.list-item',
                panelPath: '.jplist-panel'
            });

        });
    </script>
</head>
<body>
<!-- demo -->
<div id="demo">

    <!-- panel -->
    <div class="jplist-panel">

        <!-- add here jPList controls and bundles -->

    </div>

    <!-- HTML data -->
    <div class="list">

        <!-- item 1 -->
        <div class="list-item">
            agssdf
        </div>

        <!-- item 2 -->
        <div class="list-item">
           afsg
        </div>

        <!-- any number of items ... -->

    </div>

    <!-- no results found -->
    <div class="jplist-no-results">
        <p>No results found</p>
    </div>

</div>
</body>
</html>