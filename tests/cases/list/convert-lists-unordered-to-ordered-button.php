<!doctype html>
<html>
<head>
    <script type="text/javascript" src="../../js/case.js"></script>
    <?php $uri = '../../../src/'; include '../../../src/include.php'; ?>
</head>
<body class="simple">
    <script type="text/javascript">
        rangy.init();
    </script>
    <div class="test-1">
        <h1>Ordered List 1: Convert an ordered list from an unordered list using a group of words</h1>
        <div class="test-input">
            <div class="editible">
                 <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas
                    convallis 
                </p>
                <ul>
                    <li>{dui id erat pellentesque et rhoncus}</li>
                </ul>
                <p>
                    nunc semper. Suspendisse
                    malesuada hendrerit velit nec tristique. Aliquam gravida mauris at
                    ligula venenatis rhoncus. Suspendisse interdum, nisi nec consectetur
                    pulvinar, lorem augue ornare felis, vel lacinia erat nibh in velit.
                </p>
            </div>
        </div>
        <div class="test-expected">
            <div class="editible">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas
                    convallis 
                </p>
                <ol>
                    <li>{dui id erat pellentesque et rhoncus}</li>
                </ol>
                <p>
                    nunc semper. Suspendisse
                    malesuada hendrerit velit nec tristique. Aliquam gravida mauris at
                    ligula venenatis rhoncus. Suspendisse interdum, nisi nec consectetur
                    pulvinar, lorem augue ornare felis, vel lacinia erat nibh in velit.
                </p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        testEditor('.test-1', function(input) {
            input.find('.editible').data('raptor').getLayout().getElement().find('.raptor-ui-list-ordered').trigger('click');
            rangesToTokens(rangy.getSelection().getAllRanges());
        });
    </script>
    
    <div class="test-2">
        <h1>Ordered List 2: Create an ordered list from an unordered list using single word</h1>
        <div class="test-input">
            <div class="editible">
                <p>
                   Lorem ipsum dolor sit amet,  
                </p>
                <ul>
                    <li>{consectetur}</li>
                </ul>
                <p>
                    adipiscing elit. Maecenas
                    convallis dui id erat pellentesque et rhoncus nunc semper. Suspendisse
                    malesuada hendrerit velit nec tristique. Aliquam gravida mauris at
                    ligula venenatis rhoncus. Suspendisse interdum, nisi nec consectetur
                    pulvinar, lorem augue ornare felis, vel lacinia erat nibh in velit.
                </p>
            </div>
        </div>
        <div class="test-expected">
            <div class="editible">
                <p>
                   Lorem ipsum dolor sit amet,  
                </p>
                <ol>
                    <li>{consectetur}</li>
                </ol>
                <p>
                    adipiscing elit. Maecenas
                    convallis dui id erat pellentesque et rhoncus nunc semper. Suspendisse
                    malesuada hendrerit velit nec tristique. Aliquam gravida mauris at
                    ligula venenatis rhoncus. Suspendisse interdum, nisi nec consectetur
                    pulvinar, lorem augue ornare felis, vel lacinia erat nibh in velit.
                </p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        testEditor('.test-2', function(input) {
            input.find('.editible').data('raptor').getLayout().getElement().find('.raptor-ui-list-ordered').trigger('click');
            rangesToTokens(rangy.getSelection().getAllRanges());
        });
    </script>
    
    
    <div class="test-3">
        <h1>Ordered List 3: Create an ordered list from an unordered list using empty selection before a word</h1>
        <div class="test-input">
            <div class="editible">
                <p>
                   Lorem ipsum dolor sit amet,  
                </p>
                <ul>
                    <li>{consectetur}</li>
                </ul>
                <p>
                    adipiscing elit. Maecenas
                    convallis dui id erat pellentesque et rhoncus nunc semper. Suspendisse
                    malesuada hendrerit velit nec tristique. Aliquam gravida mauris at
                    ligula venenatis rhoncus. Suspendisse interdum, nisi nec consectetur
                    pulvinar, lorem augue ornare felis, vel lacinia erat nibh in velit.
                </p>
            </div>
        </div>
        <div class="test-expected">
            <div class="editible">
                <ol>
                    <li>Lorem ipsum dolor sit amet, {}consectetur adipiscing elit. Maecenas
                    convallis dui id erat pellentesque et rhoncus nunc semper. Suspendisse
                    malesuada hendrerit velit nec tristique. Aliquam gravida mauris at
                    ligula venenatis rhoncus. Suspendisse interdum, nisi nec consectetur
                    pulvinar, lorem augue ornare felis, vel lacinia erat nibh in velit.</li>
                </ol>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        testEditor('.test-3', function(input) {
            input.find('.editible').data('raptor').getLayout().getElement().find('.raptor-ui-list-ordered').trigger('click');
            rangesToTokens(rangy.getSelection().getAllRanges());
        });
    </script>
    
    <div class="test-4">
        <h1>Ordered List 4: Create an ordered list from an unordered list using empty selection inside a word</h1>
        <div class="test-input">
            <div class="editible">
                <ul>
                    <li> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas
                    convallis dui id erat pellentesque et rhoncus nunc semper. Suspendisse
                    malesuada hendr{}erit velit nec tristique. Aliquam gravida mauris at
                    ligula venenatis rhoncus. Suspendisse interdum, nisi nec consectetur
                    pulvinar, lorem augue ornare felis, vel lacinia erat nibh in velit.</li>
                </ul>
            </div>
        </div>
        <div class="test-expected">
            <div class="editible">
                <ol>
                    <li> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas
                    convallis dui id erat pellentesque et rhoncus nunc semper. Suspendisse
                    malesuada hendr{}erit velit nec tristique. Aliquam gravida mauris at
                    ligula venenatis rhoncus. Suspendisse interdum, nisi nec consectetur
                    pulvinar, lorem augue ornare felis, vel lacinia erat nibh in velit.</li>
                </ol>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        testEditor('.test-4', function(input) {
            input.find('.editible').data('raptor').getLayout().getElement().find('.raptor-ui-list-ordered').trigger('click');
            rangesToTokens(rangy.getSelection().getAllRanges());
        });
    </script>
    
    <div class="test-5">
       <h1>Ordered List 5: Create an ordered list with multiple items selection from an unordered list using part word to part word</h1>
        <div class="test-input">
            <div class="editible">
                  <p>Lor</p>
                <ul>
                    <li>{em ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    <li>Maecenas convallis dui id erat pellentesque et rhoncus nunc semper.</li>
                    <li>Suspendisse malesuada hendrerit velit nec tristique.</li>
                    <li>Aliquam gravida mauris at ligula venenatis rhonc}</li>
                </ul>
                <p>us.</p>
            </div>
        </div>
        <div class="test-expected">
            <div class="editible">
                <p>Lor</p>
                <ol>
                    <li>{em ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    <li>Maecenas convallis dui id erat pellentesque et rhoncus nunc semper.</li>
                    <li>Suspendisse malesuada hendrerit velit nec tristique.</li>
                    <li>Aliquam gravida mauris at ligula venenatis rhonc}</li>
                </ol>
                <p>us.</p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        testEditor('.test-5', function(input) {
            input.find('.editible').data('raptor').getLayout().getElement().find('.raptor-ui-list-ordered').trigger('click');
            rangesToTokens(rangy.getSelection().getAllRanges());
        });
    </script>
    
    <div class="test-6">
        <h1>Ordered List 6: Create an ordered list with multiple items from an unordered list</h1>
        <div class="test-input">
            <div class="editible">
                 <ul>{
                    <li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3</li>
                    <li>Item 4</li>
                    }
                </ul>
            </div>
        </div>
        <div class="test-expected">
            <div class="editible">
                <ol>{
                    <li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3</li>
                    <li>Item 4</li>
                    }
                </ol>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        testEditor('.test-6', function(input) {
            input.find('.editible').data('raptor').getLayout().getElement().find('.raptor-ui-list-ordered').trigger('click');
            rangesToTokens(rangy.getSelection().getAllRanges());
        });
    </script>
    
    <div class="test-7">
        <h1>Ordered List 7: Create an ordered list with multiple heading items from an unordered list</h1>
        <div class="test-input">
            <div class="editible">
                 <ul>{
                    <li><h3>Item 1</h3></li>
                    <li><h2>Item 2</h2></li>
                    <li><h1>Item 3</h1></li>
                    <li><h4>Item 4</h4></li>
                    }
                </ul>
            </div>
        </div>
        <div class="test-expected">
            <div class="editible">
                <ol>{
                    <li><h3>Item 1</h3></li>
                    <li><h2>Item 2</h2></li>
                    <li><h1>Item 3</h1></li>
                    <li><h4>Item 4</h4></li>
                    }
                </ol>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        testEditor('.test-7', function(input) {
            input.find('.editible').data('raptor').getLayout().getElement().find('.raptor-ui-list-ordered').trigger('click');
            rangesToTokens(rangy.getSelection().getAllRanges());
        });
    </script>
</body>
</html>