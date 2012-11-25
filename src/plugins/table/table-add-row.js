Raptor.registerUi('tableAddRow', new Button({
    name: 'addRow',
    action: function() {
        selectionEachRange(function(range) {
            var cell = range.commonAncestorContainer.parentNode;
            if (cell.tagName === 'TD' ||
                    cell.tagName === 'TH') {
                var index = tableGetCellIndex(cell);
                tableInsertRow(cell.parentNode.parentNode.parentNode, index.y, {
                    placeHolder: '&nbsp;'
                });
            }
        });
    }
}));