
$('.editor-mode').change(function() {
    if (editor.dirty) {
        if (!window.confirm('There are unsaved changes.Discard?')) {
            return;
        }
    }
    editor.mode = $(this).val();
    editor.reset();
});

$('.editor-cancel').click(function() {
    editor.reset();
});

$('.editor-finish').click(function() {
    editor.finish();
});

$(document).ready(function() {
    $('#button-Mountain').click(function() {
        app.editor.mode = 'Mountain';
    });


    window.setTimeout(function() {
        editor.reset();
    }, 500);
});